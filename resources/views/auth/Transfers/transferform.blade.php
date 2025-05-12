@extends('layouts.layout')
@section('body')
    <section class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:m-8 lg:m-10 lg:py-0">
        <div
            class="w-full bg-[#8c9ea3] rounded-lg schadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1
                    class="text-xl text-[#181818] font-bold text-center leading-tight tracking-tight md:text-2xl dark:text-white">
                    @isset($transfer)
                        Transfer bearbeiten
                    @else
                        Transfer anlegen
                    @endisset
                </h1>
            </div>
            <form class="space-y-2 md:space-y-6 p-5" action="/transfer/{{ $transfer->id ?? '' }}" method="POST">
                @csrf
                @isset($transfer)
                    @method('PATCH')
                @endisset
                @php
                    $transfer = $transfer ?? null;
                    $dateValue = $transfer?->date ? \Carbon\Carbon::parse($transfer->date)->format('d.m.Y') : '';
                    $typeValue = $transfer?->type ? $transfer->type : '';
                    $noteValue = $transfer?->note ? $transfer->note : '';
                    $repeatTypeValue = $transfer?->repeattype ? $transfer->repeattype : '';
                    $amountValue = $transfer?->amount ? $transfer->amount / 100 : '';
                @endphp
                <x-form.input name='type' value="{{ $typeValue }}" label='Typ' required='required' />
                <x-form.input name='note' value="{{ $noteValue }}" label='Bezeichnung' />

                <x-form.input name='date' value="{{ $dateValue }}" label='Datum' />
                <x-form.input name='repeattype' value="{{ $repeatTypeValue }}" label='Wiederholungstyp' />
                <x-form.input name='amount' value="{{ $amountValue }}" label='Betrag' />
                <x-form.select name='category' label='Kategorie' value="{{ $transfer->category ?? '' }}"
                    :options="$categories" />
                <x-form.select name='accountFrom' value="{{ $transfer->account_from ?? '' }}" label='Konto von'
                    :options="$accounts" />
                <x-form.select name='accountTo' value="{{ $transfer->account_to ?? '' }}" label='Konto nach'
                    :options="$accounts" />
                {{-- <x-form.input name='category' value="{{ $transfer->category ?? '' }}" label='Kategorie' />
                <x-form.input name='accountFrom' value="{{ $transfer->account_from ?? '' }}" label='Von' />
                <x-form.input name='accountTo' value="{{ $transfer->account_to ?? '' }}" label='Nach' /> --}}
                <x-form.textarea name='description' value="{{ $transfer->description ?? '' }}" label='Beschreibung' />

                @if ($transfer)
                    <x-form.submit name='Aktualisieren' link="{{ route('transfers') }}" ltext='Zurück zur Übersicht?'
                        rtext='Zurück' />
                @else
                    <x-form.submit name='Anlegen' link="{{ route('transfers') }}" ltext='Zurück zur Übersicht?'
                        rtext='Zurück' />
                @endif

            </form>
        </div>
    </section>
@endsection
