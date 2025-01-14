<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Repositories\LinkRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LinkController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'original_url' => 'required|url',
            'expiration_type' => [
                'required',
                Rule::in(['default', 'never', '5', '60', '1440', '10080', 'custom']),
            ],
            'customMinutes' => [
                'required_if:expiration_type,custom',
                'nullable',
                'integer',
                'min:1',
                'max:525600',
            ],
        ]);

        $expirationValue = $validatedData['expiration_type'];

        if ($validatedData['expiration_type'] === 'custom' && isset($validatedData['customMinutes'])) {
            $expirationValue = (string)$validatedData['customMinutes'];
        }

        LinkRepository::store([
            'original_url' => $validatedData['url'],
            'expires_in' => $expirationValue,
        ]);

        return response()->json(['message' => 'Link created successfully!']);
    }

    public function redirect($slug): RedirectResponse
    {
        $link = Link::where('slug', $slug)->firstOrFail();

        if (!LinkRepository::handleAccess($link)) {
            abort(404, 'This link has expired.');
        }

        return redirect($link->original_url);
    }

    public function destroy(Link $link)
    {
        LinkRepository::delete($link);

        return response()->json([
            'message' => 'Link deleted successfully!',
        ]);
    }
}
