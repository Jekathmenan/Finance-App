@extends('layouts.layout')
@section('body')
    <section class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:m-8 lg:m-12 lg:py-0">
        <div
            class="w-full bg-[#8c9ea3] rounded-lg schadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1
                    class="text-xl text-[#181818] font-bold text-center leading-tight tracking-tight md:text-2xl dark:text-white">
                    Anmelden
                </h1>
            </div>
            <form class="space-y-4 md:space-y-6 p-5" action="{{ route('login') }}" method="post">
                @csrf
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-[#181818] dark:text-white">Email</label>
                    <input type="email" value="{{ old('email') }}" name="email" id="email"
                        class="bg-gray-50 border  text-black border-gray-300 p-2 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placehoder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Email" required>
                </div>
                <div>
                    <label for="password"
                        class="block mb-2 text-sm font-medium text-[#181818] dark:text-white">Passwort</label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                        class="bg-gray-50 border  text-black border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required="">
                </div>
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-500 text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="flex items-center justify-between">
                    <a href="{{ route('forgotpassword') }}"
                        class="text-sm font-medium text-[#181818] hover:underline dark:text-primary-500">Passwort
                        vergessen?</a>
                </div>

                <button type="submit"
                    class="w-full text-white bg-[#376791] hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Anmelden</button>
                <p class="text-sm font-light text-[#181818] dark:text-gray-400">
                    Noch kein Konto? <a href="{{ route('register') }}"
                        class="font-medium text-[#181818] hover:underline dark:text-primary-500">Registrieren</a>
                </p>
            </form>
        </div>
    </section>

@endsection
