<?php

namespace App\Http\Controllers\Backend;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Categories/CategoryIndex', [
            'categories' => Category::query()
                ->when(RequestFacade::input('search'), function ($query, $search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                })->when(RequestFacade::has('field'), function ($query) {
                    $query->orderBy(RequestFacade::input('field'), RequestFacade::input('direction'));
                })
                ->paginate(10)->withQueryString(),
            'filters' => RequestFacade::only(['search', 'field', 'direction'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Categories/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
        ]);

        $category = new Category();
        $category->name = $request->get('name');
        $category->slug = $request->get('slug');

        $category->save();

        return to_route('categories-favorites.index');
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
    public function edit(Category $category)
    {
        return Inertia::render('Categories/Edit', [
            
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Category $category, Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
        ]);

        $category->name = $request->get('name');
        $category->slug = $request->get('slug');

        $category->update();

        return to_route('categories-favorites.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category = $category->delete();

        return to_route('categories-favorites.index');
    }
}
