<?php

namespace App\Http\Controllers\Site\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index()
    {
        $news = News::whereIsActive(1)->orderBy('created_at', 'desc')->paginate(10);
        $page_title = 'Haberler';

        return view('site.news.index', [
            'news' => $news,
            'page_title' => $page_title,
        ]);
    }

    public function detail($slug)
    {
        $data = News::findBySlug($slug);
        views($data)->record();

        return view('site.news.detail', ['data' => $data]);
    }

    public function search(Request $request)
    {
        $news = News::where('title', 'LIKE', '%'.$request->get('text').'%')
            ->orWhere('description', 'LIKE', '%'.$request->get('text').'%')
            ->get();
        $page_title = 'Haberler';

        return view('site.news.index', [
            'news' => $news,
            'text' => $request->get('text'),
            'page_title' => $page_title,
        ]);
    }
}
