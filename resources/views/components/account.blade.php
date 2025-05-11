@props(['account', 'url' => null])
<account class="p-4 md:w-1/4 sm:w-1/2 w-full">
    <div
        class="max-w-xl border-2 border-gray-600 px-4 py-6 rounded-lg transform transition duration-500 hover:scale-105">
        <h2 class="title-font font-medium text-3xl text-gray-900 dark:text-white">
            @empty($account->starting_amount)
                +
            @else
                {{ $account->starting_amount / 100 }}
            @endempty

        </h2>
        <p class="leading-relaxed dark:text-white">
            {{ $account->name ?? 'Neues Konto' }}
        </p>
        <div class="btns flex flex-wrap">
            <div class="edit py-2 flex-1">
                <a class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 
                    rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none text-white bg-blue-700"
                    href="{{ $url }}">
                    @isset($account)
                        Edit
                    @else
                        Add
                    @endisset
                </a>
            </div>

            @isset($account)
                <div class="delete flex-1">
                    <form class="py-2" method="POST" action="/account/{{ $account->id ?? '' }}">
                        @method('DELETE')
                        @csrf
                        <span></span>
                        <button
                            class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none text-white bg-red-700"
                            type="submit">Delete</button>
                    </form>
                </div>
            @endisset
        </div>
    </div>
</account>
