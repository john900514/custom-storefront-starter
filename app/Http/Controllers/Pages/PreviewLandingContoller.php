<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PreviewLandingContoller extends Controller
{
    public function index()
    {
        $data = [];
        return Inertia::render('PreviewLanding/PreviewLandingIndex', $data);
    }
}
