@extends('layouts.layout')
@section('body')
    <section class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:m-8 lg:m-10 lg:py-0">
        <div
            class="w-full bg-[#8c9ea3] rounded-lg schadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1
                    class="text-xl text-[#181818] font-bold text-center leading-tight tracking-tight md:text-2xl dark:text-white">
                    Transfer import
                </h1>
            </div>
            <form class="space-y-2 md:space-y-6 p-5" action="{{ route('transfers.import') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <label for="csv_file">Import CSV:</label>
                <input type="file" name="csv_file" class="form-control" required>

                <button type="submit" class="btn btn-primary mt-2">Import</button>
                @if (session('errors'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach (session('errors') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- @if ($transfer)
                    <x-form.submit name='Aktualisieren' link="{{ route('transfers') }}" ltext='Zurück zur Übersicht?'
                        rtext='Zurück' />
                @else
                    <x-form.submit name='Anlegen' link="{{ route('transfers') }}" ltext='Zurück zur Übersicht?'
                        rtext='Zurück' />
                @endif --}}

            </form>
        </div>
    </section>
@endsection
