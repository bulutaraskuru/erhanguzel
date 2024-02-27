<div class="home-slides-two owl-carousel owl-theme">
    @foreach ($sliders as $slider )
        <div class="main-banner"
             style="background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url({{ asset($slider->img) }});">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 ffsa" style="">
                                <div class="banner-content text-white">
                                    <div class="line"></div>
                                    <span class="sub-title">{{ $slider->title_small }}</span>
                                    <h1>{{ $slider->title_big }}</h1>
                                    <p>{{ $slider->description }}</p>
                                    <div class="btn-box">
                                        <a href="#" class="default-btn">@lang('site.all_products')</a>
                                        @if ($slider->link_type == "1")
                                            <a href="{{route('site.product.detail',['slug' => \App\Models\Product::get_variable($slider->link,'slug')])}}"
                                               class="optional-btn">{{ \App\Models\Product::get_variable($slider->link,"title") }}</a>
                                        @elseif ($slider->link_type == "2")
                                            <a href="#"
                                               class="optional-btn">{{ \App\Models\ProductCategory::get_variable($slider->link,"title") }}</a>
                                        @elseif ($slider->link_type == "3")
                                            <a href="{{route('site.product.detail',['slug' => \App\Models\Product::get_variable($slider->link,'slug')])}}"
                                               class="optional-btn">{{ Str::substr(\App\Models\News::get_variable($slider->link,"title"),0, 35) }}
                                                ...</a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
