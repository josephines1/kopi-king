<?php

namespace App\View\Components;

use App\Models\FrontPage;
use Illuminate\View\View;
use Illuminate\View\Component;

class AppLayout extends Component
{
    public $logo;

    public function __construct()
    {
        $this->logo = FrontPage::where('type', '=', 'logo')->first();
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
