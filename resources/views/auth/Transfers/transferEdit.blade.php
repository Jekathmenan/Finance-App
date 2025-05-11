@extends('layouts.layout')
@section('body')
    <section class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:m-8 lg:m-10 lg:py-0">
        <div
            class="w-full bg-[#8c9ea3] rounded-lg schadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1
                    class="text-xl text-[#181818] font-bold text-center leading-tight tracking-tight md:text-2xl dark:text-white">
                    @if ($transfer)
                        Transfer bearbeiten
                    @else
                        Transfer anlegen
                    @endif
                </h1>
            </div>
            <form class="space-y-2 md:space-y-6 p-5" action="/transfer/{{ $transfer->id ?? '' }}" method="POST">
                @csrf
                @isset($transfer)
                    @method('PATCH')
                    Transfer is set
                @endisset

                <x-form.input name='type' value="{{ $transfer->type ?? '' }}" label='Typ' required='required' />
                <x-form.input name='note' value="{{ $transfer->note ?? '' }}" label='Bezeichnung' />
                <x-form.input name='date' value="{{ $transfer->date ? date('d.m.Y', strtotime($transfer->date)) : '' }}"
                    label='Datum' />
                <x-form.input name='repeattype' value="{{ $transfer->repeattype ?? '' }}" label='Wiederholungstyp' />
                <x-form.input name='amount' value="{{ $transfer->amount ? $transfer->amount / 100 : '' }}"
                    label='Betrag' />
                <x-form.input name='category' value="{{ $transfer->category ?? '' }}" label='Kategorie' />
                <x-form.input name='accountFrom' value="{{ $transfer->account_from ?? '' }}" label='Von' />
                <x-form.input name='accountTo' value="{{ $transfer->account_to ?? '' }}" label='Nach' />
                <x-form.textarea name='description' value="{{ $transfer->description ?? '' }}" bezeichnung='Beschreibung' />
                {{-- <x-form.input name='name' value="{{ $account->name ?? '' }}" bezeichnung='Konto' />
                <x-form.input name='starting_amount' value="{{ $account ? $account->starting_amount / 100 : '' }}"
                    bezeichnung='Anfangsbetrag' />
                <x-form.textarea name='description' value="{{ $account->description ?? '' }}" bezeichnung='Beschreibung' />
                <x-form.errors />
                <div class="flex items-center justify-between">
                </div>
                --}}
                {{-- TODO Check this if statement --}}
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
