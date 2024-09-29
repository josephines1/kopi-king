<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('social-media.index', [
            'socials' => SocialMedia::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('social-media.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:social_media',
            'username' => 'required|string|max:255',
            'url' => 'required|string|max:255|url',
            'image' => 'required|image|file|max:1024|mimes:jpeg,png,jpg,gif,svg'
        ]);

        if ($request->file('image')) {
            $validated['image'] = $request->file('image')->store('social-media-images');
        }

        SocialMedia::create($validated);

        session()->flash('success', "Social media added successfully");
        return redirect(route('social-media.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(SocialMedia $socialMedia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialMedia $social_medium): View
    {
        return view('social-media.edit', [
            'social' => $social_medium
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SocialMedia $social_medium)
    {
        $name_rules = $social_medium->name == $request->name ? 'required|string|max:255' : 'required|string|max:255|unique:categories';
        $validated = $request->validate([
            'name' => $name_rules,
            'username' => 'required|string|max:255',
            'url' => 'required|string|max:255|url',
            'image' => 'image|file|max:1024|mimes:jpeg,png,jpg,gif,svg'
        ]);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validated['image'] = $request->file('image')->store('social-media-images');
        }

        $social_medium->update($validated);

        session()->flash('success', "Social media updated successfully");
        return redirect(route('social-media.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialMedia $social_medium)
    {
        if ($social_medium->image) {
            Storage::delete($social_medium->image);
        }
        $social_medium->delete();

        session()->flash('success', "Social media deleted successfully");
        return redirect(route('social-media.index'));
    }
}
