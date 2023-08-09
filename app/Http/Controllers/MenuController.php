<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->category) {
            $menus = Menu::with('category')->whereHas('category', function ($query) {
                $query->where('id', request()->category);
            })->get();
            $categories = Category::all();
            $categoryName = $categories->where('id', request()->category)->first()?->name;
        } else {
            $categories = Category::all();
            $menus = Menu::orderBy('created_at', 'desc')->get();
            $categoryName = 'Favourites';
        }

        return inertia::render('Menus', [
            'categories' => $categories,
            'menus' =>  $menus
                        ->map(function ($menu) {
                            return [
                                'id' => $menu->id,
                                'category_id' => $menu->category_id,
                                'name' => $menu->name,
                                'slug' => $menu->slug,
                                'description' => $menu->description,
                                'price' => $menu->price,
                                'image' => asset('/images/menus/' . $menu->image),
                            ];
                        }),
            'categoryName' => $categoryName,
        ]);
            
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        // $menu = Menu::find($id);
        // return dd($menu);

        return inertia::render('Menu', [
            'menu_item' => Menu::find($menu->id),
            'image' => asset('/images/menus/' . $menu->image),

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
