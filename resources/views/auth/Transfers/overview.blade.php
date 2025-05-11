@extends('layouts.layout')
@section('head')
    {{-- <link rel="stylesheet" href="/styles/tabs.css"> --}}
@endsection
@section('body')
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Date /<br />
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Note
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Account
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Amount
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <a class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 
                            rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none text-white bg-blue-700"
                            href="{{ route('transfers.new') }}">
                            +
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transfers as $transfer)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ date('d.m.Y', strtotime($transfer->date)) }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $transfer->note }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $transfer->accountFrom->name }}
                            @if ($transfer->accountFrom->name !== $transfer->accountTo->name)
                                <br /> --> <br />
                                {{ $transfer->accountTo->name }}
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $transfer->amount / 100 }}
                        </td>
                        <td class="px-6 py-4">
                            <a class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 
                            rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none text-white bg-blue-700"
                                href="/transfer/{{ $transfer->id }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
