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

        // Step 2: Bangun struktur organisasi
        foreach ($pegawai as $p) {
            $customId = $mapPegawaiIdToCustomId[$p->id];
            $pid = null;
            $isAssistant = '';

            if ($p->jabatan_id > 1) {
                if ($p->jabatan_id == 2) {
                    // Sekretaris Dinas -> anak dari Kepala Dinas, asisten
                    $parent = $pegawai->first(fn($x) => $x->jabatan_id == 1);
                    if ($parent) {
                        $isAssistant = 'assistant';
                    }
                } elseif ($p->jabatan_id == 3) {
                    // Kepala Bidang -> langsung ke Kepala Dinas
                    $parent = $pegawai->first(fn($x) => $x->jabatan_id == 1);
                } else {
                    // Pegawai umum (staf) -> cari atasan satu tingkat, atau Sekretaris
                    $parent = $pegawai->first(function ($x) use ($p) {
                        return $x->jabatan_id == ($p->jabatan_id - 1) && $x->bidang_id == $p->bidang_id;
                    }) ??
                        $pegawai->first(fn($x) => $x->jabatan_id == 2) ?? // fallback: Sekretaris
                        $pegawai->first(fn($x) => $x->jabatan_id == ($p->jabatan_id - 1));
                }

                $pid = $parent ? $mapPegawaiIdToCustomId[$parent->id] : null;
            }

            // Tambahkan node
            $nodes[] = [
                'id' => $customId,
                'pid' => $pid,
                'tags' => $isAssistant ? [$isAssistant] : [],
                'name' => $p->nama,
                'title' => optional($p->jabatan)->nama_jabatan ?? '-',
                'desc' => $p->tupoksi,
                'bidang' => optional($p->bidang)->nama_bidang ?? '-',
                'img' => $p->foto ? asset('storage/pegawai/' . $p->foto) : asset('volt/assets/img/user.png'),
            ];
        }

        return view('frontend.pegawai.index', compact('nodes'));
    }
}
