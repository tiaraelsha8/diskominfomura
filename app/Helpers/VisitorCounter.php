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
        $hash = md5($ip . $userAgent); // identifikasi unik per device + browser

        $now = time();
        $timeout = 300; // 5 menit = online timeout

        $date = date('Y-m-d');
        $totalFile = 'counter/total.txt';
        $todayFile = "counter/today-$date.txt";
        $onlineFile = 'counter/online.json';

        // Buat identitas pengunjung unik (IP + User-Agent)
        $userKey = md5($ip . '_' . request()->header('User-Agent')); // ← Gabungkan IP + User-Agent
        $logFile = 'counter/log.json';
        $log = json_decode(Storage::get($logFile) ?? '{}', true);

        // Cek apakah user ini sudah tercatat dalam 10 menit terakhir
        $visitWindow = 1800; // 10 menit
        $lastVisit = $log[$userKey] ?? 0;

        if ($now - $lastVisit > $visitWindow) {
            // Catat waktu kunjungan user
            $log[$userKey] = $now;
            Storage::put($logFile, json_encode($log));

            // Hitung total visitor
            $total = (int) Storage::get($totalFile) ?? 0;
            Storage::put($totalFile, $total + 1);

            // Hitung visitor hari ini
            $today = (int) Storage::get($todayFile) ?? 0;
            Storage::put($todayFile, $today + 1);
        }

        // Online
        $online = json_decode(Storage::get($onlineFile) ?? '{}', true);
        $online[$hash] = $now;

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
}
