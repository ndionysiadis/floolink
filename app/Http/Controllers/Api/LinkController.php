<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\LinkRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LinkController extends Controller
{
    /**
     * Encrypt a link.
     */
    public function encrypt(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'url' => ['required', 'url'],
            'expiration_type' => [
                'required',
                Rule::in(['default', 'never', 'custom', '5', '60', '1440', '10080']),
            ],
            'customMinutes' => [
                'required_if:expiration_type,custom',
                'nullable',
                'integer',
                'min:1',
                'max:525600',
            ],
        ]);

        $expirationValue = $validatedData['expiration_type'] === 'custom'
            ? (int) $validatedData['customMinutes']
            : $validatedData['expiration_type'];

        $link = LinkRepository::store([
            'original_url' => $validatedData['url'],
            'expiration_type' => $validatedData['expiration_type'],
            'customMinutes' => $validatedData['customMinutes'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'data' => [
                'slug' => $link->slug,
                'secret_key' => $link->secret_key,
                'full_url' => url($link->slug),
                'expires_at' => $link->expires_at,
            ]
        ]);
    }

    public function checkSlug(Request $request): JsonResponse
    {
        $request->validate([
            'url' => 'required|string',
        ]);

        $isSlug = LinkRepository::checkIfSlugExists($request->input('url'));

        return response()->json(['isSlug' => $isSlug]);
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
