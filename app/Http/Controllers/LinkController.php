<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLinkRequest;
use App\Models\Link;
use App\Repositories\LinkRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LinkController extends Controller
{
    public function store(StoreLinkRequest $request)
    {
        $this->rateLimiter();

        $link = LinkRepository::store($request->validated());

        return redirect()
            ->route('index')
            ->with('generatedLink', url($link->slug));
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

    private function rateLimiter(): void
    {
        $key = 'create-link:' . request()->ip();
        $maxAttempts = 30;

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'original_url' => ["Too many attempts. Please try again in {$seconds} seconds."],
            ]);
        }

        RateLimiter::hit($key);
    }
}
