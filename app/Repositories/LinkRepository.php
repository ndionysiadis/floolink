<?php

namespace App\Repositories;

use App\Enums\LinkType;
use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LinkRepository
{
    public static function store(array $data): Link
    {
        return DB::transaction(function () use ($data) {
            $secretKey = Str::random(32);
            $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));

            $encryptedUrl = openssl_encrypt(
                $data['original_url'],
                'aes-256-cbc',
                $secretKey,
                0,
                $iv
            );

            $expirationTypeValue = $data['expiration_type'] ?? 'default';
            $expirationType = match (true) {
                $expirationTypeValue === 'custom' => LinkType::CUSTOM,
                in_array($expirationTypeValue, ['5', '60', '1440', '10080']) => LinkType::TIMED,
                $expirationTypeValue === 'never' => LinkType::NEVER,
                default => LinkType::DEFAULT,
            };

            $expiresAt = match ($expirationType) {
                LinkType::CUSTOM => isset($data['customMinutes']) && is_numeric($data['customMinutes'])
                    ? now()->addMinutes((int) $data['customMinutes'])
                    : null,
                LinkType::TIMED => self::calculateExpiration($expirationTypeValue),
                LinkType::NEVER, LinkType::DEFAULT => null,
            };

            \Log::info('Resolved Expiration:', [
                'type' => $expirationType->value,
                'expires_at' => $expiresAt,
            ]);

            return Link::create([
                'slug' => Str::random(8),
                'original_url' => $data['original_url'],
                'encrypted_url' => base64_encode($iv . $encryptedUrl),
                'secret_key' => $secretKey,
                'expires_at' => $expiresAt,
                'expiration_type' => $expirationType->value,
            ]);
        });
    }

    private static function calculateExpiration(string|int $expirationValue): Carbon
    {
        return match ((string)$expirationValue) {
            '5' => now()->addMinutes(5),
            '60' => now()->addHour(),
            '1440' => now()->addDay(),
            '10080' => now()->addWeek(),
            default => null,
        };
    }

    public static function handleAccess(Link $link): bool
    {

        if ($link->expiration_type === 'default' && $link->clicks === 0) {
            self::incrementClick($link);
            $link->update(['expires_at' => now()]);
            return true;
        }

        if ($link->expiration_type === 'never') {
            self::incrementClick($link);
            return true;
        }

        if ($link->expires_at < now()) {
            return false;
        }

        self::incrementClick($link);
        return true;
    }

    public static function incrementClick(Link $link): void
    {
        $link->increment('clicks');
    }
    public static function delete(Link $link): bool
    {
        return $link->delete();
    }
}
