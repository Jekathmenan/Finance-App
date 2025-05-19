@extends('layouts.layout')
@section('head')
    {{-- <link rel="stylesheet" href="/styles/tabs.css"> --}}
@endsection
@section('body')
    <div class="relative overflow-x-auto">
        <section class="text-gray-700 body-font">
            <div class="m-6 container px-5 py-4 mx-6 ">
                <span class="dark:text-white">Accounts overview :</span>

                @if ($accounts->count() > 0)
                    {{-- <div class="lg:grid lg:grid-cols-3 md:grid md:grid-cols-3 sm:grid sm:grid-cols-2 "> --}}


                    <div class="m-6 flex flex-wrap m-4 text-center">
                        @foreach ($accounts as $acc)
                            <x-coredata.card name="{{ $acc->name }}" value=" {{ $acc->getBalance() }} CHF" />
                        @endforeach
                    </div>
                @endif
                <span class="dark:text-white">Recent Transfers: &nbsp; | &nbsp; <a class="text-right;dark:text-blue"
                        href="/transfers">View all</a></span>


                <br><br>
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
                        @foreach ($recentTransactions as $transfer)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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
        </section>
    </div>
@endsection
