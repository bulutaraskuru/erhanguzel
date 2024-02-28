    <header id="header" data-transparent="false" data-fullwidth="false" class="light submenu-light">
        <div class="header-inner">
            <div class="container-fluid">
                <!--Logo-->
                <div id="logo">
                    <a href="{{ route('site.index') }}">
                        <span class="logo-default"><img style="height:55px;" src="{{ asset('site/logos.png') }}"
                                alt=""></span>
                        <span class="logo-dark"><img style="height: 55px;" src="{{ asset('site/logos.png') }}"
                                alt=""></span>
                    </a>
                </div>
                <!--End: Logo-->
                <!-- Search -->
                <div id="search"><a id="btn-search-close" class="btn-search-close" aria-label="Close search form"><i
                            class="icon-x"></i></a>
                    <form class="search-form" action="{{ route('site.news.search') }}" method="get">
                        <input class="form-control" name="text" id="text" type="text"
                            placeholder="Yaz ve Ara..." />
                        <span class="text-muted">Yazmaya başlayın ve kapatmak için "Enter" veya "ESC" tuşuna
                            basın</span>
                    </form>
                </div>
                <!-- end: search -->
                <!--Header Extras-->
                <div class="header-extras d-flex justify-content-center align-items-center ">
                    <a href="#form" style="background-color: #ff0000"
                        class="btn d-none d-md-block btn-rounded  mt-3">Bir Fikrim Var</a>
                    <ul class="d-none d-md-block">
                        <li>
                            <a id="btn-search" class="mt-4" href="#"> <i class="icon-search "
                                    style="font-size: 30px"></i></a>
                        </li>
                    </ul>

                </div>
                <!--end: Header Extras-->
                <!--Navigation Resposnive Trigger-->
                <div id="mainMenu-trigger">
                    <a class="lines-button x"><span class="lines"></span></a>
                </div>
                <!--end: Navigation Resposnive Trigger-->
                <!--Navigation-->
                <div id="mainMenu" class="menu-center menu-lines">
                    <div class="container">
                        <nav>
                            <ul>
                                <li class="@if (\Request::segment(1) == '') current @endif"><a
                                        href="{{ route('site.index') }}">Anasayfa</a></li>
                                <li class="@if (\Request::segment(2) == 'hakkimda') current @endif"><a
                                        href="{{ route('site.page.detail', ['slug' => 'hakkimda']) }}">Hakkımda</a></li>
                                <li class="dropdown"><a href="#">Projeler</a>
                                    <ul class="dropdown-menu">
                                        @foreach ($project_categories as $category)
                                            <li><a href="#">{{ $category->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="@if (\Request::segment(1) == 'haber') current @endif"><a
                                        href="{{ route('site.news.index') }}">Haberler</a></li>
                                <li class="dropdown"><a href="#">Dijital</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('site.digital') }}">Broşüler</a></li>
                                        <li><a href="{{ route('site.videos') }}">Videolar</a></li>
                                        <li><a href="{{ route('site.gallery.index') }}">Galeri</a></li>
                                    </ul>
                                </li>
                                <li class="@if (\Request::segment(1) == 'iletisim') current @endif"><a
                                        href="{{ route('site.contact.index') }}">İletişim</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!--end: Navigation-->
            </div>
        </div>
    </header>
