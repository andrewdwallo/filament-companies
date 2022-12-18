@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-white text-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}>
