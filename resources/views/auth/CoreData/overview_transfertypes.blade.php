@extends('layouts.layout')
@section('head')
    <link rel="stylesheet" href="/styles/tabs.css">
@endsection
@section('body')
    @if ($data->count() == 0)
        New Transfer type
        <x-coredata url="transfer-type/new" type="Buchungstyp" />
    @else
        <section class="text-gray-700 body-font">
            <div class="m-6 container px-5 py-24 mx-6 ">
                <div class="m-6 flex flex-wrap -m-4 text-center">
                    {{-- rendering a card to add a new transfertype --}}
                    <x-coredata url="transfer-type/new" type="Buchungstyp" />
                    @foreach ($data as $data)
                        {{-- rendering account component for each account --}}
                        <x-coredata :data="$data" url="transfer-type" type="Buchungstyp" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
