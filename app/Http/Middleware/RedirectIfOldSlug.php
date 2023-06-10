<?php

namespace App\Http\Middleware;

use App\Models\Book;
use App\Models\OldSlug;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RedirectIfOldSlug
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure(Request): (Response|RedirectResponse)  $next
     * @return Application|RedirectResponse|Redirector
     */
    public function handle(Request $request, Closure $next)
    {
        $slug = $request->route('slug');

        $book = Book::query()->where('slug', $slug)->first();
        if ($book !== null) {
            return $next($request);
        }

        $oldSlug = OldSlug::query()->where('slug', $slug)->first();
        if ($oldSlug === null) {
            throw new NotFoundHttpException('Book not found!');
        }

        return redirect(route('book.show', ['slug' => $oldSlug->book->slug]));
    }
}
