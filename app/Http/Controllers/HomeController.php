<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Pages\PreviewLandingContoller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $temporary_other_controller = new PreviewLandingContoller();
        return  $temporary_other_controller->index();
    }
}
