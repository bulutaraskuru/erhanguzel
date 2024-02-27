<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function index()
    {
        $page_title = 'Anasayfa';

        return view('site.index', [
            'page_title' => $page_title,
        ]);
    }

    public function comingsoon()
    {
        $page_title = 'Yapım aşamasında';

        return view('site.comingsoon', [
            'page_title' => $page_title,
        ]);
    }
}
