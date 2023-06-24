<?php

namespace App\Http\Controllers\Backend;

use App\Models\Menu;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Menus/Index', [
            'menus' => Menu::orderBy('created_at', 'desc')
                            ->get()
                            ->map(function($menu) {
                                return [
                                    'id' => $menu->id,
                                    'category_id' => $menu->category_id,
                                    'name' => $menu->name,
                                    'slug' => $menu->slug,
                                    'description' => $menu->description,
                                    'price' => $menu->price,
                                    'image' => asset('storage/' . $menu->image),                        
                                ];
                            }),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Menus/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $file = $request->file('image')->store('menus', 'public');

        $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|integer|numeric',
            'image' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);

       Menu::create([
            'category_id' => $request->get('category_id'),
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'image' => $file,
        ]);

        return to_route('menus-list.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return Inertia::render('Menus/Edit', [
            
            'menu' => $menu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Menu $menu, Request $request): RedirectResponse
    {
        $image = $menu->image;

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'slug' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|integer|numeric',
        ]);

        if ($request->file('image')) {
            $request->validate(['image' => 'required|mimes:jpg,jpeg,png|max:2048',]);
            Storage::delete('public/' .$menu->image);
            $image = $request->file('image')->store('menus', 'public');
        }

        $menu->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $image,
        ]);

        return to_route('menus-list.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu): RedirectResponse
    {
        Storage::delete('public/' .$menu->image);

        $menu->delete();

        return to_route('menus-list.index');
    }
}
