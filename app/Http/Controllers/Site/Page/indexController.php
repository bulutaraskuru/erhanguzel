<?php

namespace App\Http\Controllers\Site\Page;

use App\Http\Controllers\Controller;
use App\Models\Page;

class indexController extends Controller
{
    public function detail($slug)
    {
        $data = Page::findBySlug($slug);

        return view('site.page.detail', ['data' => $data]);
    }
}
