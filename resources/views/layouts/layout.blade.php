<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('head')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Finance-App</title>
</head>

<body class="font-[Poppins] text-[#a0a0a0] bg-[#1f1f1f]">
    {{-- Navbar --}}
    <header class="bg-[#181818]">
        <nav class="flex justify-between items-center w-[92%] mx-auto">
            <div>
                <img class="w-16" src="https://cdn-icons-png.flaticon.com/512/5968/5968204.png" alt="...">
            </div>

            {{-- Center nav --}}
            <div
                class="nav-links duration-500  md:static absolute bg-[#181818] md:min-h-fit min-h-[60vh] left-0 top-[-100%] md:w-auto w-full flex items-center px-5">
                <ul class="flex md:flex-row flex-col md:items-center md:gap-[4vw] gap-8">
                    <li><a class="hover:text-gray-500" href=" {{ route('home') }} ">Home</a></li>
                    {{-- <li><a class="hover:text-gray-500" href="#">Anleitung</a></li> --}}

                    @auth
                        {{-- Should only be seen by logged in users --}}
                        <li><a class="hover:text-gray-500" href="{{ route('core-data') }}">Stammdaten</a></li>
                        <li><a class="hover:text-gray-500" href="{{ route('transfers') }}">Buchung</a></li>
                    @endauth
                </ul>
            </div>

            {{-- Right nav --}}
            <div class="flex items-center gap-6">
                @auth
                    <form action="{{ route('logout') }}" method="post" id="logout">
                        @csrf
                        <button type="submit" form="logout"
                            class="bg-[#376791] text-white px-5 py-2 rounded-full hover:bg-[#87acec]">Log Out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-[#376791] text-white px-5 py-2 rounded-full hover:bg-[#87acec]">Login</a>
                    <a href="{{ route('register') }}"
                        class="bg-[#376791] text-white px-5 py-2 rounded-full hover:bg-[#87acec]">Register</a>
                @endauth

                <ion-icon onclick="onToggleMenu(this)" class="text-3xl cursor-pointer md:hidden"
                    name="menu"></ion-icon>
            </div>
        </nav>
    </header>

    <main class="mx-6">
        {{-- Body Placeholder --}}
        @yield('body')
    </main>

    <footer>
        <x-flash />
        {{-- Footer Placeholder --}}
        @yield('footer')
    </footer>
    <script>
        const navLinks = document.querySelector('.nav-links');

        function onToggleMenu(e) {
            e.name = e.name === 'menu' ? 'close' : 'menu';
            navLinks.classList.toggle('top-[9%]');
        }
    </script>
</body>

</html>
