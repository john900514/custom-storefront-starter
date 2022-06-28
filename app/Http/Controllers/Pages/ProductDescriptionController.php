<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductDescriptionController extends Controller
{
    public function index()
    {
        // @todo - props for the Page component vue for here
        $data = [];

        return Inertia::render('ProductDesc/PDIndex', $data);
    }
}
