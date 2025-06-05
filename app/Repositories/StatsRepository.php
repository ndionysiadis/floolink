<?php

namespace App\Repositories;

use App\Models\DailyClick;
use App\Models\DeviceStatistic;
use App\Models\GeographicStatistic;
use App\Models\Link;
use App\Models\LinkStatistic;
use Illuminate\Http\Request;

class StatsRepository
{
    public static function createForLink(Link $link): LinkStatistic
    {
        $stat = LinkStatistic::create([
            'slug_hash' => self::hashSlug($link->slug),
        ]);

        return $stat;
    }

    public static function recordClick(Link $link, Request $request): LinkStatistic
    {
        $hash = self::hashSlug($link->slug);

        $stats = LinkStatistic::firstOrCreate(['slug_hash' => $hash]);
        $stats->increment('clicks');
        if (!session()->has("u_{$hash}")) {
            $stats->increment('unique_clicks');
            session(["u_{$hash}" => true]);
        }
        $stats->last_clicked_at = now();
        $stats->save();

        $date = now()->toDateString();
        $daily = DailyClick::firstOrCreate([
            'slug_hash' => $hash,
            'date' => $date,
        ]);
        $daily->increment('clicks');
        if (!session()->has("u_{$hash}_{$date}")) {
            $daily->increment('unique_clicks');
            session(["u_{$hash}_{$date}" => true]);
        }

        $country = $request->header('CF-IPCountry', 'Unknown');
        $region = $request->header('CF-IPRegion');
        $geo = GeographicStatistic::firstOrCreate([
            'slug_hash' => $hash,
            'country' => $country,
            'region' => $region,
        ]);
        $geo->increment('clicks');

        $agent = $request->userAgent() ?? '';
        $deviceType = preg_match('/Mobile|Android|iPhone|iPad/i', $agent) ? 'mobile' : 'desktop';
        if (preg_match('/Tablet/i', $agent)) {
            $deviceType = 'tablet';
        }
        $browser = 'other';
        if (str_contains($agent, 'Chrome')) {
            $browser = 'Chrome';
        } elseif (str_contains($agent, 'Firefox')) {
            $browser = 'Firefox';
        } elseif (str_contains($agent, 'Safari') && !str_contains($agent, 'Chrome')) {
            $browser = 'Safari';
        }

        $device = DeviceStatistic::firstOrCreate([
            'slug_hash' => $hash,
            'device_type' => $deviceType,
            'browser' => $browser,
        ]);
        $device->increment('clicks');

        return $stats->fresh();
    }

    public static function hashSlug(string $slug): string
    {
        return hash('sha256', $slug);
    }
}
