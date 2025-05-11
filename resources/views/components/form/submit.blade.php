@props(['name', 'link', 'ltext', 'rtext'])
<button type="submit"
    class="w-full text-white bg-[#376791] hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
    {{ $name }}
</button>
<p class="text-sm font-light text-[#181818] dark:text-gray-400">
    {{ $ltext }} <a href="{{ $link }}"
        class="font-medium text-[#376791] hover:underline dark:text-primary-500">{{ $rtext }}</a>
</p>
