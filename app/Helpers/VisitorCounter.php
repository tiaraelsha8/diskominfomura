<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class VisitorCounter
{
    public static function count()
    {
        $ip = request()->ip();
        $now = time();
        $timeout = 300; // 5 menit

        $date = date('Y-m-d');
        $totalFile = "counter/total.txt";
        $todayFile = "counter/today-$date.txt";
        $onlineFile = "counter/online.json";

        // === Sesi Laravel
        if (!session()->has('has_visited')) {
            session(['has_visited' => true]);

            // Total
            $total = (int)Storage::get($totalFile) ?? 0;
            Storage::put($totalFile, $total + 1);

            // Hari ini
            $today = (int)Storage::get($todayFile) ?? 0;
            Storage::put($todayFile, $today + 1);
        }

        // Online
        $online = json_decode(Storage::get($onlineFile) ?? '{}', true);
        $online[$ip] = $now;

        foreach ($online as $ipAddr => $lastSeen) {
            if ($now - $lastSeen > $timeout) {
                unset($online[$ipAddr]);
            }
        }

        Storage::put($onlineFile, json_encode($online));

        return [
            'total' => (int)Storage::get($totalFile),
            'today' => (int)Storage::get($todayFile),
            'online' => count($online)
        ];
    }
}
