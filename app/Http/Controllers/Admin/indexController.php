<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function index()
    {
        $page_title = 'Yönetim Paneli | Anasayfa';

        return view('admin.index', [
            'page_title' => $page_title,
        ]);
    }
}
