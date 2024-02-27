@extends('layouts.site')
@section('content')
    <!-- Start Page Title -->
    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2 style="font-size: 16px; font-style: italic">{{$text}} : aradığınız sonuç</h2>
                <ul>
                    <li><a href="{{ route('site.index') }}">@lang('site.home')</a></li>
                    <li><a href="{{ route('site.news.index') }}">@lang('site.blog')</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title -->
    <!-- Start Blog Area -->
    <section class="blog-area ptb-100">
        <div class="container">
            <div class="row">
                @foreach($news as $new)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog-post">
                            <div class="post-image">
                                <a href="{{route('site.news.detail',['slug' => $new->slug])}}">
                                    <img src="{{ asset($new->img) }}" alt="image">
                                </a>
                                <div class="date">
                                    <span>{{date('d.m.Y H:i',strtotime($new->created_at))}}</span>
                                </div>
                            </div>
                            <div class="post-content">
                                <span class="category">@lang('site.ganiorganik')</span>
                                <h3><a href="{{route('site.news.detail',['slug' => $new->slug])}}">{{ $new->title }}</a></h3>
                                <a href="{{route('site.news.detail',['slug' => $new->slug])}}" class="details-btn">@lang('site.detail_button')</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $news->links('vendor.pagination.default') }}
            </div>
        </div>
    </section>
    <!-- End Blog Area -->
    @include('site.component.form')
@endsection
