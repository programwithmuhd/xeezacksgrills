<?php

namespace App\Http\Controllers\Backend;

use App\Models\Menu;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Return_;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Menus/Index', [
            'menus' => Menu::orderBy('created_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Menus/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image_file = null;

        $menu = new Menu;

        $image_file = $request->file('image');
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = '/images/menus/';

        $extension = $image_file->getClientOriginalExtension();
        $imageName = time() . '.' . $extension;

        $menu->category_id = $request->input('category_id');
        $menu->name = $request->input('name');
        $menu->slug = $request->input('slug');
        $menu->description = $request->input('description');
        $menu->price = $request->input('price');
        $menu->image = $imagePath . $imageName;

        $image_file = $image_file->move(public_path() . $imagePath, $imageName);

        if ($menu->save()) {
            return redirect()->route('menus-list.index');
        }


        // $image_file = null;

        // $menu = new Menu;

        // $image_file = $request->file('image');
        // $request->validate(['image' => 'required|mimes:jpg,jpeg,png|max:2048']);

        // $imagePath = '/images/menus/';

        // $extension = $image_file->getClientOriginalExtension();
        // $imageName = time() . '.' . $extension;

        // $menu->category_id = $request->input('category_id');
        // $menu->name = $request->input('name');
        // $menu->slug = $request->input('slug');
        // $menu->image = $imagePath . $imageName;
        // $menu->description = $request->input('description');
        // $menu->price = $request->input('price');

        // $image_file->move(public_path() . $imagePath, $imageName);

        // if ($menu->save()) {
        //     return redirect()->route('/menus-list');
        // }
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
            'image' => asset('public' .$menu->image),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Menu $menu, Request $request)
    {
        $image = $menu->image;

        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->file('image')) {
            Storage::delete('public' .$menu->image);
            $image = $request->file('image')->store('menus', 'public');
        }

        $menu->update([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'image' => $image,
        ]);

        return redirect()->route('menus-list.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        Storage::delete('public' .$menu->image);

        $menu->delete();

        return redirect()->route('menus-list.index');
    }
}
