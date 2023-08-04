<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\Address;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => auth()->check() ? auth()->user() : null,
                'is_admin' => $request->user() ? $request->user()->hasRole('admin') : false,
                // 'auth.user.roles' => fn () => $request->user()
                // ? $request->user()->getRoleNames()
                // : null,
                'address' => auth()->check() ? Address::where('user_id', auth()->user()->id)->first() : null,
            ],
            'category_menus' => Category::all(),
            'menus' => Menu::all(),
            // 'random_menus' => Menu::inRandomOrder()->limit(4)->get(),
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
        ]);
    }
}
