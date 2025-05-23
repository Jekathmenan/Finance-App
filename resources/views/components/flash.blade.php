@if (session()->has('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
        class="fixed bg-blue-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
        <p>{{ session('success') }}</p>
    </div>
@elseif (session()->has('warning'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
        class="fixed bg-yellow-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
        <p>{{ session('warning') }}</p>
    </div>
@elseif (session()->has('error'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
        class="fixed bg-red-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
        <p>{{ session('error') }}</p>
    </div>
@endif
