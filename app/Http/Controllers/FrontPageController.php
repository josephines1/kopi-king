<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Team;
use App\Models\Category;
use App\Models\FrontPage;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FrontPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('front-pages.index', [
            'pages' => FrontPage::where('type', '=', 'page')->get()
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
    public function show(FrontPage $frontPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FrontPage $frontPage)
    {
        session(['previous_url' => url()->previous()]);
        return view('front-pages.edit', [
            'page' => $frontPage
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FrontPage $frontPage)
    {
        $rules = [
            'content' => 'required|array',
        ];

        if (isset($request->content['hero'])) {
            $rules['content.hero.title'] = 'required|string';
            $rules['content.hero.text'] = 'required|string';
            $rules['content.hero.image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            if (isset($request->content['hero']['cta-text'])) {
                $rules['content.hero.cta-text'] = 'required|string';
            }
            if (isset($request->content['hero']['cta-link'])) {
                $rules['content.hero.cta-link'] = 'required|url';
            }
        }

        if (isset($request->content['about'])) {
            $rules['content.about.small-title'] = 'required|string';
            $rules['content.about.title'] = 'required|string';
            $rules['content.about.text'] = 'required|string';
            $rules['content.about.cta-text'] = 'required|string';
            $rules['content.about.cta-link'] = 'required|url';
        }

        if (isset($request->content['product'])) {
            $rules['content.product.small-title'] = 'required|string';
            $rules['content.product.title'] = 'required|string';
            $rules['content.product.cta-text'] = 'required|string';
            $rules['content.product.cta-link'] = 'required|url';
        }

        if (isset($request->content['mission'])) {
            $rules['content.mission.small-title'] = 'required|string';
            $rules['content.mission.title'] = 'required|string';
            $rules['content.mission.text'] = 'required|string';
        }

        if (isset($request->content['vision'])) {
            $rules['content.vision.small-title'] = 'required|string';
            $rules['content.vision.title'] = 'required|string';
            $rules['content.vision.text'] = 'required|string';
        }

        if (isset($request->content['teams'])) {
            $rules['content.teams.small-title'] = 'required|string';
            $rules['content.teams.title'] = 'required|string';
        }

        if (isset($request->content['location'])) {
            $rules['content.location.small-title'] = 'required|string';
            $rules['content.location.title'] = 'required|string';
            $rules['content.location.text'] = 'required|string';
            $rules['content.location.cta-text'] = 'required|string';
            $rules['content.location.cta-link'] = 'required|url';
            $rules['content.location.latitude'] = 'required|numeric';
            $rules['content.location.longitude'] = 'required|numeric';
        }

        if (isset($request->content['contact'])) {
            $rules['content.contact.small-title'] = 'required|string';
            $rules['content.contact.title'] = 'required|string';
            $rules['content.contact.text'] = 'required|string';
        }

        if (isset($request->content['company'])) {
            $rules['content.company.name'] = 'required|string';
            $rules['content.company.logo'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        $validated = $request->validate($rules);

        if (isset($request->content['hero'])) {
            if ($request->file('content.hero.image')) {
                if ($request->content['hero']['oldImage']) {
                    Storage::delete($request->content['hero']['oldImage']);
                }

                $validated['content']['hero']['image'] = $request->file('content.hero.image')->store('front-images');
            } else {
                $validated['content']['hero']['image'] = $request->content['hero']['oldImage'];
            }
        }

        if (isset($request->content['company'])) {
            if ($request->file('content.company.logo')) {
                if ($request->content['company']['oldImage']) {
                    Storage::delete($request->content['company']['oldImage']);
                }

                $validated['content']['company']['logo'] = $request->file('content.company.logo')->store('company-images');
            } else {
                $validated['content']['company']['logo'] = $request->content['company']['oldImage'];
            }
        }

        $frontPage->update($validated);

        session()->flash('success', 'Page updated successfully');
        return redirect(session('previous_url', route('front-pages.index')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FrontPage $frontPage)
    {
        //
    }

    /**
     * Show front page Home
     */
    public function home()
    {
        $content = FrontPage::where('name', '=', 'home')->first();
        $menus = Menu::latest()->limit(3)->get();
        return view('front.home', [
            'content' => $content->content,
            'menus' => $menus,
        ]);
    }

    /**
     * Show front page Menu
     */
    public function menu()
    {
        $content = FrontPage::where('name', '=', 'menus')->first();
        $categories = Category::latest()->get();
        $menus = Menu::latest()->get();

        return view('front.menu', [
            'content' => $content->content,
            'categories' => $categories,
            'menus' => $menus,
        ]);
    }

    /**
     * Filter Menu List
     */
    public function filter(Request $request)
    {
        $categoryId = $request->category_id;

        if ($categoryId == 'all') {
            $menus = Menu::with('category')->get();
        } else {
            $menus = Menu::with('category')->where('category_id', $categoryId)->get();
        }

        return response()->json([
            'menus' => $menus
        ]);
    }

    /**
     * Show front page About
     */
    public function about()
    {
        $content = FrontPage::where('name', '=', 'about')->first();
        $teams = Team::latest()->get();

        return view('front.about', [
            'content' => $content->content,
            'teams' => $teams,
        ]);
    }

    /**
     * Show front page Contact
     */
    public function contact()
    {
        $content = FrontPage::where('name', '=', 'contact')->first();

        return view('front.contact', [
            'content' => $content->content,
        ]);
    }
}
