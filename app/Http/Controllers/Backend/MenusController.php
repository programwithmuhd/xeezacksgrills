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
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,slug'],
        ]);
        $query = Menu::query();
       
        if(request('search')) {
            $query->where('name', 'LIKE', '%'. request('search') . '%');
        } 

        if(request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }

        return Inertia::render('Menus/MenuIndex', [
            'menus' => $query->paginate(10)
                            ->through(function ($menu) {
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
            'filters' => request()->all(['search', 'field', 'direction'])
            // 'categories' => Category::all()
        ]);


        // return Inertia::render('Menus/Index', [
        //     'menus' => Menu::orderBy('created_at', 'desc')
        //                 ->get()
        //                 ->map(function ($menu) {
        //                     return [
        //                         'id' => $menu->id,
        //                         // 'category_id' => $menu->category_id,
        //                         'name' => $menu->name,
        //                         'slug' => $menu->slug,
        //                         'description' => $menu->description,
        //                         'price' => $menu->price,
        //                         'image' => asset('/images/menus/' . $menu->image),
        //                     ];
        //                 }),               
        // ]);
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
            $file = time(). '.' .$request->image->extension();
            Storage::delete('public/' .$menu->image);
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
    public function destroy(int $id): RedirectResponse
    {
        try {
            $menu = Menu::find($id);
            Storage::delete('public/' .$menu->image);
            $menu->delete();

                return to_route('menus-list.index');
        
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}