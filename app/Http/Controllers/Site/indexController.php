<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Request;

class indexController extends Controller
{
    public function index()
    {
        $page_title = 'Anasayfa';

        return view('site.index', [
            'page_title' => $page_title,
        ]);
    }

    public function videos()
    {
        $page_title = "Videolarımız";

        return view('site.videos', ['page_title' => $page_title]);
    }

    public function digital()
    {
        $page_title = "Broşürlerimiz";

        return view('site.digital', ['page_title' => $page_title]);
    }
    public function video_detail($slug)
    {
        $data = Video::findBySlug($slug);
        $page_title = $data->title;
        return view('site.video_detail', ['data' => $data, 'page_title' => $page_title]);
    }

    public function comingsoon()
    {
        $page_title = 'Yapım aşamasında';

        return view('site.comingsoon', [
            'page_title' => $page_title,
        ]);
    }
}
