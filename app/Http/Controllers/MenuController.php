<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('menus.index', [
            'menus' => Menu::filter(request(['search', 'category']))->latest()->paginate(10)->withQueryString(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('menus.create', [
            'categories' => Category::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:menus|regex:/^[\w\s-]+$/',
            'desc' => 'required',
            'category_id' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'required|image|file|max:1024',
        ]);

        $validated['image'] = $request->file('image')->store('menu-images');

        Menu::create($validated);

        session()->flash('success', 'Menu added successfully');
        return redirect(route('menus.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return view('menus.edit', [
            'categories' => Category::get(),
            'menu' => $menu
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $name_rules = $menu->name == $request->name ? 'required|string|max:255|regex:/^[\w\s-]+$/' : 'required|string|max:255|regex:/^[\w\s-]+$/|unique:menus';
        $validated = $request->validate([
            'name' => $name_rules,
            'desc' => 'required',
            'category_id' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'image|file|max:1024',
        ]);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validated['image'] = $request->file('image')->store('menu-images');
        }

        $menu->update($validated);

        session()->flash('success', 'Menu updated successfully');
        return redirect(route('menus.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu): RedirectResponse
    {
        if ($menu->image) {
            Storage::delete($menu->image);
        }
        $menu->delete();

        session()->flash('success', 'Menu deleted successfully');
        return redirect(route('menus.index'));
    }
}
