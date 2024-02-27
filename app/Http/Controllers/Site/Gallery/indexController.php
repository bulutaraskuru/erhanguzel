<?php

namespace App\Http\Controllers\Site\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class indexController extends Controller
{
    public function index()
    {
        $page_title = 'Galeri';
        $galleries_pagintaion = Gallery::where('is_active', 1)->orderBy('order_number', 'asc')->paginate(12);

        return view('site.gallery.index', [
            'page_title' => $page_title,
            'galleries_pagintaion' => $galleries_pagintaion,
        ]);
    }
}
