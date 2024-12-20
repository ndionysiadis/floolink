<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Repositories\LinkRepository;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'original_url' => 'required|url',
            'expires_in' => 'nullable|integer|min:1',
            'click_limit' => 'nullable|integer|min:1',
            'self_destruct' => 'nullable|boolean',
        ]);

        LinkRepository::store($validatedData);

        return response()->json([
            'message' => 'Link created successfully!',
        ]);
    }

    public function redirect($slug)
    {
        $link = Link::where('slug', $slug)->first();

        if (!$link) {
            abort(404, 'Link not found.');
        }

        if ($link->expires_at && $link->expires_at->isPast()) {
            abort(404, 'This link has expired.');
        }

        if ($link->click_limit && $link->clicks >= $link->click_limit) {
            abort(404, 'This link is no longer available.');
        }

        LinkRepository::incrementClick($link);

        if ($link->self_destruct) {
            LinkRepository::delete($link);
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
