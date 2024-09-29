<?php

namespace App\Http\Controllers;

use App\Models\FrontPage;
use App\Models\Message;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('dashboard', [
            'pages' => FrontPage::where('type', '=', 'page')->get(),
            'logo' => FrontPage::where('type', '=', 'logo')->first(),
            'messages' => Message::latest()->limit(3)->get()
        ]);
    }
}
