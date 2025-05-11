@extends('layouts.layout')

@section('head')
    @yield('head')
    <link rel="stylesheet" href="/styles/tabs.css">
@endsection

@section('body')
    <div class="tab">
        @yield('tabs')
    </div>

    @yield('tab-contents')
@endsection
@section('footer')
    <script src="/scripts/tabs.js"></script>
    @yield('footer')
@endsection
