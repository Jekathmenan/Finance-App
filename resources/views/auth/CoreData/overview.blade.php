@extends('layouts.layout')
@section('head')
    <link rel="stylesheet" href="/styles/tabs.css">
@endsection
@section('body')
    <section class="text-gray-700 body-font">
        <div class="m-6 container px-5 py-24 mx-6 ">
            <div class="m-6 flex flex-wrap -m-4 text-center">
                {{-- rendering a card to add a new transfertype --}}
                <x-coredata.card name="Buchungstypen" url="/transfer-types/" />
                <x-coredata.card name="Kategorien" url="/categories/" />
                <x-coredata.card name="Konten" url="/accounts/" />
            </div>
        </div>
    </section>
@endsection
