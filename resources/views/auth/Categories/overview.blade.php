@extends('layouts.layout')
@section('head')
    <link rel="stylesheet" href="/styles/tabs.css">
@endsection
@section('body')
    @if ($categories->count() == 0)
        <x-category url="category/new" />
    @else
        {{-- <div class="lg:grid lg:grid-cols-3 md:grid md:grid-cols-3 sm:grid sm:grid-cols-2 "> --}}
        <section class="text-gray-700 body-font">
            <div class="m-6 container px-5 py-24 mx-6 ">
                <div class="m-6 flex flex-wrap -m-4 text-center">
                    {{-- rendering a card to add a new category --}}
                    <x-category url="category/new" />
                    @foreach ($categories as $cat)
                        {{-- rendering category component for each category --}}


                        <x-category :category="$cat" :url="'category/' . $cat->id" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
