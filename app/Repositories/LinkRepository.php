<?php

namespace App\Repositories;

use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class LinkRepository
{
    /**
     * Store a new link
     *
     * @param array $data
     * @return Link
     */
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

            $expirationData = self::processExpiration($data['expires_in'] ?? 'default');

            Log::info('Processed Expiration Data:', $expirationData);

            $link = Link::create([
                'slug' => Str::random(8),
                'original_url' => $data['original_url'],
                'encrypted_url' => base64_encode($iv . $encryptedUrl),
                'secret_key' => $secretKey,
                'click_limit' => $data['click_limit'] ?? null,
                'self_destruct' => $expirationData['self_destruct'],
                'expires_at' => $expirationData['expires_at'],
            ]);

            Log::info('Link Saved:', $link->toArray());

            return $link;
        });
    }

    private static function processExpiration(?string $expirationType): array
    {
        $selfDestruct = false;
        $expiresAt = null;

        switch ($expirationType) {
            case 'never':
                $selfDestruct = false;
                $expiresAt = null;
                break;

            case 'default':
                $selfDestruct = true;
                $expiresAt = null;
                break;

            case '5':
                $expiresAt = Carbon::now()->addMinutes(5);
                break;

            case '60':
                $expiresAt = Carbon::now()->addHour();
                break;

            case '1440':
                $expiresAt = Carbon::now()->addDay();
                break;

            case '10080':
                $expiresAt = Carbon::now()->addWeek();
                break;

            default:
                if (is_numeric($expirationType)) {
                    $expiresAt = Carbon::now()->addMinutes((int)$expirationType);
                }
                break;
        }

        $result = [
            'expires_at' => $expiresAt,
            'self_destruct' => $selfDestruct,
        ];

        Log::info('Expiration Processing Result:', $result);

        return $result;
    }

    /**
     * Check if a slug exists
     *
     * @param string $slug
     * @return bool
     */
    public static function checkIfSlugExists(string $slug): bool
    {
        return Link::query()->where('slug', '=', $slug)->exists();
    }

    /**
     * Increment click count for a link
     *
     * @param Link $link
     * @return void
     */
    public static function incrementClick(Link $link): void
    {
        $link->increment('clicks');
    }

    /**
     * Delete a link
     *
     * @param Link $link
     * @return void
     */
    public static function delete(Link $link): void
    {
        $link->delete();
    }

    /**
     * Decrypt a URL
     *
     * @param string $encryptedUrl
     * @param string $secretKey
     * @return string
     * @throws \RuntimeException
     */
    public static function decryptUrl(string $encryptedUrl, string $secretKey): string
    {
        $decoded = base64_decode($encryptedUrl);

        if ($decoded === false) {
            throw new \RuntimeException('Invalid base64 encoded data');
        }

        $ivLength = openssl_cipher_iv_length('aes-256-cbc');
        $iv = substr($decoded, 0, $ivLength);
        $encryptedData = substr($decoded, $ivLength);

        $decryptedUrl = openssl_decrypt(
            $encryptedData,
            'aes-256-cbc',
            $secretKey,
            0,
            $iv
        );

        if ($decryptedUrl === false) {
            throw new \RuntimeException('Failed to decrypt URL. Invalid key or corrupted data.');
        }

        return $decryptedUrl;
    }
}
