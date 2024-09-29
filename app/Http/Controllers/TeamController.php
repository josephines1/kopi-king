<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('teams.index', [
            'teams' => Team::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'desc' => 'required',
            'image' => 'required|image|file|max:1024|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $validated['image'] = $request->file('image')->store('team-images');

        Team::create($validated);

        session()->flash('success', "Team member added successfully");
        return redirect(route('teams.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        return view('teams.edit', [
            'team' => $team
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'desc' => 'required',
            'image' => 'image|file|max:1024',
        ]);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validated['image'] = $request->file('image')->store('team-images');
        }

        $team->update($validated);

        session()->flash('success', "Team member updated successfully");
        return redirect(route('teams.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        if ($team->image) {
            Storage::delete($team->image);
        }
        $team->delete();

        session()->flash('success', "Team member deleted successfully");
        return redirect(route('teams.index'));
    }
}
