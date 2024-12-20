<?php

namespace App\Repositories;

use App\Models\Link;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

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

            $expiresAt = null;

            if (isset($data['expires_in'])) {
                if ($data['expires_in'] === 'default') {
                    $expiresAt = Carbon::now()->addMinutes(1);
                } elseif (is_numeric($data['expires_in'])) {
                    $expiresAt = Carbon::now()->addMinutes((int)$data['expires_in']);
                }
            }

            $selfDestruct = $data['expires_in'] !== 'never';

            return Link::create([
                'slug' => Str::random(8),
                'original_url' => $data['original_url'],
                'encrypted_url' => base64_encode($iv . $encryptedUrl),
                'secret_key' => $secretKey,
                'click_limit' => $data['click_limit'] ?? null,
                'self_destruct' => $selfDestruct,
                'expires_at' => $expiresAt,
            ]);
        });
    }

    public static function incrementClick(Link $link): void
    {
        $link->increment('clicks');
    }

    /**
     * Delete a link.
     *
     * @param Link $link
     * @return void
     */
    public static function delete(Link $link): void
    {
        $link->delete();
    }

    public static function checkIfSlugExists(string $url): bool
    {
        return Link::where('slug', $url)->exists();
    }

    /**
     * @throws \Exception
     */
    public static function decryptUrl(string $encryptedUrl, string $secretKey): string
    {
        // Decode the encrypted URL
        $decoded = base64_decode($encryptedUrl);

        // Extract the IV and encrypted data
        $ivLength = openssl_cipher_iv_length('aes-256-cbc');
        $iv = substr($decoded, 0, $ivLength);
        $encryptedData = substr($decoded, $ivLength);

        // Decrypt the data using the provided key
        $originalUrl = openssl_decrypt($encryptedData, 'aes-256-cbc', $secretKey, 0, $iv);

        if ($originalUrl === false) {
            throw new \Exception('Decryption failed. Invalid key or corrupted data.');
        }

        return $originalUrl;
    }
}
