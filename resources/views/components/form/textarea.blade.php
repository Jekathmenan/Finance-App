@props(['name', 'value' => '', 'label'])
<div>
    <label for="{{ $name }}"
        class="block mb-2 text-sm font-medium text-[#181818] dark:text-white">{{ $label }}</label>
    <textarea type="textarea" name="{{ $name }}" id="{{ $name }}"
        class="bg-gray-50 text-black border border-gray-300 p-2 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placehoder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        value="">{{ $value }}</textarea>
    @error('{{ $name }}')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
