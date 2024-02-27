<?php

namespace App\Http\Controllers\Site\Sss;

use App\Http\Controllers\Controller;
use App\Models\Sss;

class indexController extends Controller
{
    public function index()
    {
        $sss = Sss::whereIsActive(1)->orderBy('order_number', 'asc')->get();

        return view('site.sss.index', ['sss' => $sss]);
    }
}
