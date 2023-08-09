<?php

namespace App\Http\Controllers\Backend;

use App\Models\Menu;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
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
        return Inertia::render('Menus/MenuIndex', [
            'menus' => Menu::query()
                ->when(RequestFacade::input('search'), function ($query, $search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                })->when(RequestFacade::has('field'), function ($query) {
                    $query->orderBy(RequestFacade::input('field'), RequestFacade::input('direction'));
                })
                ->paginate(10)->withQueryString()->through(function($menu) {
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
            'filters' => RequestFacade::only(['search', 'field', 'direction'])
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
        $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|integer|numeric',
            'image' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);

        $file = time(). '.' .$request->image->extension();
        $request->image->move(public_path('images/menus'), $file);

        $menu = new Menu;
        $menu->category_id = $request->get('category_id');
        $menu->name = $request->get('name');
        $menu->slug = $request->get('slug');
        $menu->description = $request->get('description');
        $menu->price = $request->get('price');
        $menu->image = $file;

        $menu->save();

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
            'image' => asset('/images/menus/' . $menu->image),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Menu $menu, Request $request): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|integer|numeric',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        if(isset($request->image)) {
            unlink('images/menus/' .$menu->image);
            $file = time(). '.' .$request->image->extension();
            $request->image->move(public_path('images/menus'), $file);
            $menu->image = $file;
        }

        $menu->category_id = $request->get('category_id');
        $menu->name = $request->get('name');
        $menu->slug = $request->get('slug');
        $menu->description = $request->get('description');
        $menu->price = $request->get('price');

        $menu->update();

        return to_route('menus-list.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu): RedirectResponse
    {
        $menu->delete();
        unlink('images/menus/' .$menu->image);
        
        return to_route('menus-list.index');
    }
}