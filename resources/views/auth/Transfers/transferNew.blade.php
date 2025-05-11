@extends('layouts.layout')
@section('body')
    <section class="flex flex-col container items-center justify-center px-6 py-8 mx-auto md:m-8 lg:m-10 lg:py-0">
        <div
            class="w-full bg-[#8c9ea3] rounded-lg schadow dark:border md:mt-0 sm:max-w-9/10 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1
                    class="text-xl text-[#181818] font-bold text-center leading-tight tracking-tight md:text-2xl dark:text-white">

                    Transfer anlegen
                </h1>
            </div>
            <form class="w-full space-y-2 md:space-y-6 p-5" action="/transfer/{{ $transfer->id ?? '' }}" method="POST">
                @csrf
                @isset($transfer)
                    @method('PATCH')
                    Transfer is set
                @endisset

                <x-form.input name='type' label='Typ' required='required' />
                <x-form.input name='note' label='Bezeichnung' />
                <x-form.input name='date' label='Datum' />
                <x-form.input name='repeattype' label='Wiederholungstyp' />
                <x-form.input name='amount' label='Betrag' />
                {{-- <x-form.input name='category' label='Kategorie' /> --}}

                <x-form.select name='category' label='Kategorie' :options="$categories" />
                <x-form.select name='accountFrom' label='Konto von' :options="$accounts" />
                <x-form.select name='accountTo' label='Konto nach' :options="$accounts" />
                {{-- <x-form.input name='accountFrom' label='Von' /> 
                <x-form.input name='accountTo' label='Nach' /> --}}
                <x-form.textarea name='description' label='Beschreibung' />

                <x-form.submit name='Anlegen' link="{{ route('transfers') }}" ltext='Zurück zur Übersicht?'
                    rtext='Zurück' />

            </form>
        </div>
    </section>
@endsection
