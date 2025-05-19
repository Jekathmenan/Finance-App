@props(['name', 'value' => '', 'url' => null])
<a class="p-4 md:w-1/4 sm:w-1/2 w-full" href="{{ $url }}">
    <card>
        <div
            class="max-w-xl border-2 border-gray-600 px-4 py-6 rounded-lg transform transition duration-500 hover:scale-105">

            <p class="leading-relaxed dark:text-white">
                {{ $name }}
                <br>
                {{ $value }}
            </p>
        </div>
    </card>
</a>
