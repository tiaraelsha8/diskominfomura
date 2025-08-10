<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class VisitorCounter
{
    public static function count()
    {
        $host = request()->getHost();
        if ($host !== 'diskominfo.murungrayakab.go.id') {
            return [
                'total' => 0,
                'today' => 0,
                'online' => 0,
            ];
        }

        $ip = request()->ip();
        $userAgent = request()->header('User-Agent');

        // Gunakan hash device unik berdasarkan IP + bagian unik dari User-Agent (tanpa browser info)
        $deviceId = md5($ip . self::getDeviceSignature($userAgent));

        $now = time();
        $timeout = 300; // 5 menit = online timeout
        $date = date('Y-m-d');

        $totalFile = 'counter/total.txt';
        $todayFile = "counter/today-$date.txt";
        $onlineFile = 'counter/online.json';
        $logFile = 'counter/log.json';

        // Ambil log
        $log = json_decode(Storage::get($logFile) ?? '{}', true);

        // Window kunjungan: 30 menit (1800 detik)
        $visitWindow = 1800;
        $lastVisit = $log[$deviceId] ?? 0;

        if ($now - $lastVisit > $visitWindow) {
            // Simpan waktu kunjungan
            $log[$deviceId] = $now;
            Storage::put($logFile, json_encode($log));

            // Total visitor
            $total = (int) (Storage::exists($totalFile) ? Storage::get($totalFile) : 0);
            Storage::put($totalFile, $total + 1);

            // Visitor hari ini
            $today = (int) (Storage::exists($todayFile) ? Storage::get($todayFile) : 0);
            Storage::put($todayFile, $today + 1);
        }

        // Hitung online
        $online = json_decode(Storage::get($onlineFile) ?? '{}', true);
        $online[$deviceId] = $now;

        // Hapus yang timeout
        foreach ($online as $key => $lastSeen) {
            if ($now - $lastSeen > $timeout) {
                unset($online[$key]);
            }
        }

        Storage::put($onlineFile, json_encode($online));

        return [
            'total' => (int) Storage::get($totalFile),
            'today' => (int) Storage::get($todayFile),
            'online' => count($online),
        ];
    }

    // Helper dipindah ke luar function count
    private static function getDeviceSignature($userAgent)
    {
        if (preg_match('/\((.*?)\)/', $userAgent, $matches)) {
            return $matches[1];
        }
        return $userAgent;
    }
}
