<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\LinkRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LinkController extends Controller
{
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
}
