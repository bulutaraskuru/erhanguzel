@extends('layouts.app')

@section('content')
    <!-- Start Login Area -->
    <section class="login-area ptb-100">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6 col-md-6 mt-5 mb-5">
                    <div class="login-content">
                        <h2>@lang('site.login')</h2>
                        <form class="login-form" method="post" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group mb-2">
                                <input type="email" class="form-control" name="email"
                                    placeholder="@lang('cms.email') adresinizi yazınız ...">
                            </div>
                            <div class="form-group mb-2">
                                <input type="password" class="form-control" name="password" placeholder="@lang('cms.password')">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">@lang('site.login')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
