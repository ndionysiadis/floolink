<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\LinkRepository;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function checkSlug(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $isSlug = LinkRepository::checkIfSlugExists($request->input('url'));

        return response()->json(['isSlug' => $isSlug]);
    }

    /**
     * Encrypt a link.
     */
    public function encrypt(Request $request)
    {
        $validatedData = $request->validate([
            'url' => 'required|url',
            'expiration' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if (!in_array($value, ['default', 'never']) && !is_numeric($value)) {
                        $fail('The selected expiration is invalid.');
                    }
                },
            ],
        ]);

        $link = LinkRepository::store([
            'original_url' => $validatedData['url'],
            'expires_in' => $validatedData['expiration'] ?? null,
        ]);

        return response()->json([
            'encrypted_url' => $link->slug,
            'secret_key' => $link->secret_key,
        ]);
    }

    /**
     * Decrypt a link.
     */
    public function decrypt(Request $request)
    {
        $validatedData = $request->validate([
            'url' => 'required|string',
            'secretKey' => 'required|string',
        ]);

        try {
            $originalUrl = LinkRepository::decryptUrl($validatedData['url'], $validatedData['secretKey']);
            return response()->json(['original_url' => $originalUrl]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
