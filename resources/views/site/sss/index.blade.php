@extends('layouts.site')
@section('seo')
    <title>@lang('site.ganiorganik') | @lang('site.sss') </title>
@endsection

@section('style')
@endsection
@section('content')
    <!-- Start Page Title -->
    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>@lang('site.sss')</h2>
                <ul>
                    <li><a href="{{ route('site.index') }}">@lang('site.home')</a></li>
                    <li>@lang('site.sss')</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Start FAQ Area -->
    <section class="faq-area ptb-100">
        <div class="container">
            <div class="faq-accordion">
                <ul class="accordion">
                    @foreach($sss as $item)
                        <li class="accordion-item">
                            <a class="accordion-title @if($item->order_number ==1) active @endif" href="javascript:void(0)">
                                <i class='bx bx-chevron-down'></i>
                                {{ $item->question }}
                            </a>
                            <div class="accordion-content @if($item->order_number == "1") show @endif">
                                <p>{{$item->answer}}.</p>
                            </div>
                        </li>

                    @endforeach
                </ul>
            </div>

        </div>
    </section>
    <!-- End FAQ Area -->

@endsection
@section('script')
@endsection
