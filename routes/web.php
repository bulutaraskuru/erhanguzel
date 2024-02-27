<?php

use App\Http\Controllers\Admin\Box\indexController as BoxController;
use App\Http\Controllers\Admin\Gallery\indexController as GalleryController;
use App\Http\Controllers\Admin\indexController as DashboardController;
use App\Http\Controllers\Admin\News\indexController as NewsController;
use App\Http\Controllers\Admin\NewsImage\indexController as NewImageController;
use App\Http\Controllers\Admin\Page\indexController as PageController;
use App\Http\Controllers\Admin\Partner\indexController as PartnerController;
use App\Http\Controllers\Admin\Slider\indexController as SliderController;
use App\Http\Controllers\Admin\Sss\indexController as SssController;
use App\Http\Controllers\Admin\User\indexController as UserController;

/** SiteController Route */
use App\Http\Controllers\Site\Contact\indexController as SiteContactController;
use App\Http\Controllers\Site\Gallery\indexController as SiteGalleryController;
use App\Http\Controllers\Site\indexController as SiteController;
use App\Http\Controllers\Site\News\indexController as SiteNewsController;
use App\Http\Controllers\Site\Page\indexController as SitePageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'site', 'as' => 'site.'], function () {
//    Route::get('/', [SiteController::class, 'comingsoon'])->name('comingsoon');
    Route::get('/', [SiteController::class, 'index'])->name('index');

    Route::get('/qr', function () {
        return redirect()->route('site.page.detail', ['slug' => 'hakkimda']);
    })->name('qr');

    Route::get('/facebook', function () {
        return redirect('https://www.facebook.com/erhanguzel.34/');
    })->name('facebook');

    Route::get('/x', function () {
        return redirect('https://twitter.com/erhanguzel_34');
    })->name('x');

    Route::get('/instagram', function () {
        return redirect('https://www.instagram.com/erhanguzel.34/');
    })->name('instagram');


    Route::get('/linkedin', function () {
        return redirect('https://www.linkedin.com/in/erhanguzel34/');
    })->name('linkedin');

    Route::get('/clear', function () {
        Artisan::call("optimize:clear");
        Artisan::call("cache:clear");
        Artisan::call("config:cache");
        return redirect()->route('site.index');
    })->name('clear');


    Route::group(['namespace' => 'contact', 'as' => 'contact.'], function () {
        Route::get('/iletisim', [SiteContactController::class, 'index'])->name('index');
        Route::post('/voluntarily', [SiteContactController::class, 'voluntarily'])->name('voluntarily');
    });

    Route::group(['namespace' => 'page', 'as' => 'page.'], function () {
        Route::get('/sayfa/{slug}', [SitePageController::class, 'detail'])->name('detail');
    });

    Route::group(['namespace' => 'gallery', 'as' => 'gallery.'], function () {
        Route::get('/galeri', [SiteGalleryController::class, 'index'])->name('index');
    });

    Route::group(['namespace' => 'news', 'as' => 'news.'], function () {
        Route::get('/haber', [SiteNewsController::class, 'index'])->name('index');
        Route::get('/haber/{slug}', [SiteNewsController::class, 'detail'])->name('detail');
        Route::get('/arama', [SiteNewsController::class, 'search'])->name('search');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:super_admin|editor']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/data', [UserController::class, 'data'])->name('data');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::get('/show/{id}', [UserController::class, 'show'])->name('show');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::post('/export', [UserController::class, 'export'])->name('export');
    });

    Route::group(['prefix' => 'page', 'as' => 'page.'], function () {
        Route::get('/', [PageController::class, 'index'])->name('index');
        Route::get('/data', [PageController::class, 'data'])->name('data');
        Route::get('/create', [PageController::class, 'create'])->name('create');
        Route::post('/store', [PageController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PageController::class, 'edit'])->name('edit');
        Route::get('/show/{id}', [PageController::class, 'show'])->name('show');
        Route::put('/update/{id}', [PageController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [PageController::class, 'destroy'])->name('destroy');
        Route::post('/export', [PageController::class, 'export'])->name('export');
        Route::post('/upload', [PageController::class, 'upload'])->name('upload');
    });

    Route::group(['prefix' => 'news', 'as' => 'news.'], function () {
        Route::get('/', [NewsController::class, 'index'])->name('index');
        Route::get('/data', [NewsController::class, 'data'])->name('data');
        Route::get('/create', [NewsController::class, 'create'])->name('create');
        Route::post('/store', [NewsController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [NewsController::class, 'edit'])->name('edit');
        Route::get('/image/{id}', [NewsController::class, 'image'])->name('image');
        Route::put('/update/{id}', [NewsController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [NewsController::class, 'destroy'])->name('destroy');
        Route::post('/export', [NewsController::class, 'export'])->name('export');
        Route::post('/upload', [NewsController::class, 'upload'])->name('upload');
    });

    Route::group(['as' => 'newimage.', 'prefix' => 'newimage'], function () {
        Route::post('/upload/{id}', [NewImageController::class, 'upload'])->name('upload');
        Route::get('/destroy/{id}', [NewImageController::class, 'destroy'])->name('destroy');
        Route::get('/data/{id}', [NewImageController::class, 'data'])->name('data');
        Route::get('/is_active', [NewImageController::class, 'is_active'])->name('is_active');
        Route::post('/sortable', [NewImageController::class, 'sortable'])->name('sortable');
    });

    Route::group(['as' => 'gallery.', 'prefix' => 'gallery'], function () {
        Route::get('/index', [GalleryController::class, 'index'])->name('index');
        Route::post('/upload', [GalleryController::class, 'upload'])->name('upload');
        Route::get('/destroy/{id}', [GalleryController::class, 'destroy'])->name('destroy');
        Route::get('/data', [GalleryController::class, 'data'])->name('data');
        Route::get('/is_active', [GalleryController::class, 'is_active'])->name('is_active');
        Route::post('/sortable', [GalleryController::class, 'sortable'])->name('sortable');
    });

    Route::group(['prefix' => 'sss', 'as' => 'sss.'], function () {
        Route::get('/', [SssController::class, 'index'])->name('index');
        Route::get('/data', [SssController::class, 'data'])->name('data');
        Route::get('/create', [SssController::class, 'create'])->name('create');
        Route::post('/store', [SssController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SssController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [SssController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [SssController::class, 'destroy'])->name('destroy');
        Route::post('/sortable', [SssController::class, 'sortable'])->name('sortable');
    });

    Route::group(['prefix' => 'box', 'as' => 'box.'], function () {
        Route::get('/', [BoxController::class, 'index'])->name('index');
        Route::get('/data', [BoxController::class, 'data'])->name('data');
        Route::get('/create', [BoxController::class, 'create'])->name('create');
        Route::post('/store', [BoxController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BoxController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [BoxController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [BoxController::class, 'destroy'])->name('destroy');
        Route::post('/sortable', [BoxController::class, 'sortable'])->name('sortable');
    });

    Route::group(['prefix' => 'partner', 'as' => 'partner.'], function () {
        Route::get('/', [PartnerController::class, 'index'])->name('index');
        Route::get('/data', [PartnerController::class, 'data'])->name('data');
        Route::get('/create', [PartnerController::class, 'create'])->name('create');
        Route::post('/store', [PartnerController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PartnerController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PartnerController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [PartnerController::class, 'destroy'])->name('destroy');
        Route::post('/sortable', [PartnerController::class, 'sortable'])->name('sortable');
    });
    Route::group(['prefix' => 'slider', 'as' => 'slider.'], function () {
        Route::get('/', [SliderController::class, 'index'])->name('index');
        Route::get('/data', [SliderController::class, 'data'])->name('data');
        Route::get('/create', [SliderController::class, 'create'])->name('create');
        Route::post('/store', [SliderController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [SliderController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [SliderController::class, 'destroy'])->name('destroy');
        Route::get('/link_type/{selected_value}', [SliderController::class, 'link_type'])->name('link_type');
        Route::post('/sortable', [SliderController::class, 'sortable'])->name('sortable');
    });
});