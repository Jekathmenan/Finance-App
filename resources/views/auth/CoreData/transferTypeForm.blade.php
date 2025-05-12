@extends('layouts.layout')
@section('body')
    <section class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:m-8 lg:m-10 lg:py-0">
        <div
            class="w-full bg-[#8c9ea3] rounded-lg schadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1
                    class="text-xl text-[#181818] font-bold text-center leading-tight tracking-tight md:text-2xl dark:text-white">
                    Buchungstyp - @if ($transferType)
                        Bearbeiten
                    @else
                        Erstellen
                    @endif
                </h1>
            </div>
            <form class="space-y-4 md:space-y-6 p-5" action="/transfer-type/{{ $transferType->id ?? '' }}" method="POST">
                @csrf
                @isset($transferType)
                    @method('PATCH')
                @endisset

                <x-form.input name='name' value="{{ $transferType->name ?? '' }}" label='Buchungstyp' />
                <x-form.errors />
                <div class="flex items-center justify-between">
                </div>

                {{-- TODO Check this if statement --}}
                @if ($transferType)
                    <x-form.submit name='Aktualisieren' link="{{ route('transfer-types') }}" ltext='Nicht aktualisieren?'
                        rtext='Zurück' />
                @else
                    <x-form.submit name='Erstellen' link="{{ route('transfer-types') }}" ltext='Zurück nach vorne?'
                        rtext='Zurück' />
                @endif

            </form>
        </div>
    </section>
@endsection
