@extends('front.layout.master')
@section('title', 'Bán máy tính')
@section('content')
<section class="container header-scroll">
    <div class="global-menu active-menu__home">
        @include('front.layout.global-menu')
    </div>
    @include('front.home.banner')
</section>
<section class="container">
    @include('front.home.home-product-top')
    @include('front.home.home-product-cat')
</section>
@endsection
