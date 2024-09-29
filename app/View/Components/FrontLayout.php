<?php

namespace App\View\Components;

use App\Models\FrontPage;
use App\Models\SocialMedia;
use Illuminate\View\View;
use Illuminate\View\Component;

class FrontLayout extends Component
{
    public $socials;
    public $logo;

    public function __construct()
    {
        $this->socials = SocialMedia::latest()->get();
        $this->logo = FrontPage::where('type', '=', 'logo')->first();
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.front');
    }
}
