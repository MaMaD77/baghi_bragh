<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function draw(): View
    {
        $breadcrumbs = [
            ['link' => route('dashboard'), 'name' => __('Home')],
            ['link' => route('dashboard'), 'name' => __('Dashboard')],
            ['name' => __('Draw')]
        ];

        return view('components.dashboard.pages.draw', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
