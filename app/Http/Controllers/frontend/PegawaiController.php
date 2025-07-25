<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        // Ambil semua pegawai dengan relasi bidang dan jabatan
        $pegawai = Pegawai::with('bidang', 'jabatan')->get();

        $nodes = [];
        $index = 1;
        $mapPegawaiIdToCustomId = [];

        // Step 1: Buat ID custom untuk setiap pegawai
        foreach ($pegawai as $p) {
            $mapPegawaiIdToCustomId[$p->id] = $index++;
        }

        // Step 2: Function untuk mendapatkan nama bidang yang tepat
        $getBidangName = function ($pegawai) {
            $namaJabatan = strtolower(optional($pegawai->jabatan)->nama_jabatan ?? '');
            $bidangAsli = optional($pegawai->bidang)->nama_bidang ?? '';

            // Jika Kasubag, tampilkan bidang sebagai "Sekretariat" atau sesuai struktur
            if (str_contains($namaJabatan, 'kasubag') || str_contains($namaJabatan, 'kepala sub bagian')) {
                // Opsi 1: Gunakan nama khusus untuk sekretariat
                //return 'Sekretariat';
                return $bidangAsli;

                // Opsi 2: Gunakan bidang spesifik berdasarkan jenis kasubag
                // if (str_contains($namaJabatan, 'umum')) return 'Sekretariat - Sub Bagian Umum';
                // if (str_contains($namaJabatan, 'kepegawaian')) return 'Sekretariat - Sub Bagian Kepegawaian';
                // if (str_contains($namaJabatan, 'keuangan')) return 'Sekretariat - Sub Bagian Keuangan';

                // Opsi 3: Gunakan bidang dari database jika sudah diset
                // return $bidangAsli ?: 'Sekretariat';
            }

            // Untuk jabatan lain, gunakan bidang normal
            return $bidangAsli ?: '-';
        };

        // Step 3: Definisikan level hierarki berdasarkan nama jabatan
        $getLevelJabatan = function ($namaJabatan) {
            $namaJabatan = strtolower($namaJabatan ?? '');

            if (str_contains($namaJabatan, 'kepala dinas') || str_contains($namaJabatan, 'kadis')) {
                return 1; // Level tertinggi
            } elseif (str_contains($namaJabatan, 'sekretaris') || str_contains($namaJabatan, 'sekda')) {
                return 2; // Level 2
            } elseif (str_contains($namaJabatan, 'kepala bidang') || str_contains($namaJabatan, 'kabid')) {
                return 2; // Level 2 (setara sekretaris)
            } elseif (str_contains($namaJabatan, 'kepala sub bagian') || str_contains($namaJabatan, 'kasubag') || str_contains($namaJabatan, 'kepala subbag')) {
                return 3; // Level 3 (di bawah sekretaris)
            } else {
                return 4; // Staf atau level terendah
            }
        };

        // Step 4: Bangun struktur organisasi
        foreach ($pegawai as $p) {
            $customId = $mapPegawaiIdToCustomId[$p->id];
            $pid = null;
            $isAssistant = '';

            $namaJabatan = optional($p->jabatan)->nama_jabatan ?? '';
            $levelJabatan = $getLevelJabatan($namaJabatan);

            switch ($levelJabatan) {
                case 1: // Kepala Dinas
                    $pid = null;
                    break;

                case 2: // Sekretaris atau Kepala Bidang
                    if (str_contains(strtolower($namaJabatan), 'sekretaris')) {
                        // Sekretaris langsung ke Kepala Dinas
                        $parent = $pegawai->first(function ($x) use ($getLevelJabatan) {
                            return $getLevelJabatan(optional($x->jabatan)->nama_jabatan) == 1;
                        });
                        $isAssistant = 'assistant';
                    } else {
                        // Kepala Bidang langsung ke Kepala Dinas
                        $parent = $pegawai->first(function ($x) use ($getLevelJabatan) {
                            return $getLevelJabatan(optional($x->jabatan)->nama_jabatan) == 1;
                        });
                    }

                    $pid = $parent ? $mapPegawaiIdToCustomId[$parent->id] : null;
                    break;

                case 3: // Kasubag
                    // Kasubag ke Sekretaris
                    $parent = $pegawai->first(function ($x) {
                        $jabatan = strtolower(optional($x->jabatan)->nama_jabatan ?? '');
                        return str_contains($jabatan, 'sekretaris') || str_contains($jabatan, 'sekda');
                    });

                    // Fallback ke Kepala Dinas jika tidak ada Sekretaris
                    if (!$parent) {
                        $parent = $pegawai->first(function ($x) use ($getLevelJabatan) {
                            return $getLevelJabatan(optional($x->jabatan)->nama_jabatan) == 1;
                        });
                    }

                    $pid = $parent ? $mapPegawaiIdToCustomId[$parent->id] : null;
                    break;

                default:
                    // Staf (level 4+)
                    $parent = null;

                    // Untuk staf, cek dulu apakah atasannya Kasubag
                    $namaJabatanLower = strtolower($namaJabatan);

                    // 1. Jika staf sekretariat, cari Kasubag yang sesuai
                    if (str_contains($namaJabatanLower, 'staf umum') || str_contains($namaJabatanLower, 'admin umum')) {
                        $parent = $pegawai->first(function ($x) {
                            $jabatan = strtolower(optional($x->jabatan)->nama_jabatan ?? '');
                            return str_contains($jabatan, 'kasubag') && str_contains($jabatan, 'umum');
                        });
                    } elseif (str_contains($namaJabatanLower, 'staf kepegawaian') || str_contains($namaJabatanLower, 'admin kepegawaian')) {
                        $parent = $pegawai->first(function ($x) {
                            $jabatan = strtolower(optional($x->jabatan)->nama_jabatan ?? '');
                            return str_contains($jabatan, 'kasubag') && str_contains($jabatan, 'kepegawaian');
                        });
                    } elseif (str_contains($namaJabatanLower, 'staf keuangan') || str_contains($namaJabatanLower, 'admin keuangan')) {
                        $parent = $pegawai->first(function ($x) {
                            $jabatan = strtolower(optional($x->jabatan)->nama_jabatan ?? '');
                            return str_contains($jabatan, 'kasubag') && str_contains($jabatan, 'keuangan');
                        });
                    }

                    // 2. Jika tidak ada Kasubag spesifik, cari Kasubag manapun di bidang yang sama
                    if (!$parent && $p->bidang_id) {
                        $parent = $pegawai->first(function ($x) use ($p, $getLevelJabatan) {
                            return $getLevelJabatan(optional($x->jabatan)->nama_jabatan) == 3 && $x->bidang_id == $p->bidang_id;
                        });
                    }

                    // 3. Jika tidak ada Kasubag, cari Kabid di bidang yang sama
                    if (!$parent && $p->bidang_id) {
                        $parent = $pegawai->first(function ($x) use ($p) {
                            $jabatan = strtolower(optional($x->jabatan)->nama_jabatan ?? '');
                            return (str_contains($jabatan, 'kepala bidang') || str_contains($jabatan, 'kabid')) && $x->bidang_id == $p->bidang_id;
                        });
                    }

                    // 4. Fallback ke Sekretaris
                    if (!$parent) {
                        $parent = $pegawai->first(function ($x) {
                            $jabatan = strtolower(optional($x->jabatan)->nama_jabatan ?? '');
                            return str_contains($jabatan, 'sekretaris') || str_contains($jabatan, 'sekda');
                        });
                    }

                    // 5. Ultimate fallback ke Kepala Dinas
                    if (!$parent) {
                        $parent = $pegawai->first(function ($x) use ($getLevelJabatan) {
                            return $getLevelJabatan(optional($x->jabatan)->nama_jabatan) == 1;
                        });
                    }

                    $pid = $parent ? $mapPegawaiIdToCustomId[$parent->id] : null;
                    break;
            }

            // Tambahkan node
            $nodes[] = [
                'id' => $customId,
                'pid' => $pid,
                'tags' => $isAssistant ? [$isAssistant] : [],
                'name' => $p->nama,
                'title' => (function () use ($namaJabatan, $p, $getBidangName) {
                    $lower = strtolower($namaJabatan);
                    if (str_contains($lower, 'kepala dinas') || str_contains($lower, 'kadis') || str_contains($lower, 'sekretaris') || str_contains($lower, 'sekda')) {
                        return $namaJabatan ?: '-';
                    }

                    return trim(($namaJabatan ?: '-') . ' - ' . $getBidangName($p));
                })(),
                'desc' => $p->tupoksi,
                'bidang' => $getBidangName($p), // Gunakan function untuk bidang
                'file_link' => $p->file ? route('pegawai.download', $p->id) : null,
                'img' => $p->foto ? asset('storage/pegawai/' . $p->foto) : asset('volt/assets/img/user.png'),
            ];
        }
        //dd($nodes);
        return view('frontend.pegawai.index', compact('nodes'));
    }

    public function download($id)
    {
        $dokumen = Pegawai::findOrFail($id);
        $filename = $dokumen->file;
        $path = storage_path('app/public/pegawai/dokumen/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path, $filename);
    }
}
