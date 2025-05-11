@extends('layouts.layout')
@section('head')
    <link rel="stylesheet" href="/styles/tabs.css">
@endsection
@section('body')
    @if ($accounts->count() == 0)
        <x-account url="account/new" />
    @else
        {{-- <div class="lg:grid lg:grid-cols-3 md:grid md:grid-cols-3 sm:grid sm:grid-cols-2 "> --}}
        <section class="text-gray-700 body-font">
            <div class="m-6 container px-5 py-24 mx-6 ">
                <div class="m-6 flex flex-wrap -m-4 text-center">
                    {{-- rendering a card to add a new account --}}
                    <x-account url="account/new" />
                    @foreach ($accounts as $acc)
                        {{-- rendering account component for each account --}}
                        <x-account :account="$acc" :url="'account/' . $acc->id" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
