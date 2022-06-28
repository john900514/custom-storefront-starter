<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Pages\PreviewLandingContoller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        // @todo - remove this when the home page is ready
        if(env('APP_ENV') == 'production')
        {
            $temporary_other_controller = new PreviewLandingContoller();
            return  $temporary_other_controller->index();
        }

        // @todo - props for the Page component vue for here
        $data = [];

        return Inertia::render('Home/HomeIndex', $data);
    }
}
