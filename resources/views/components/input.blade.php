@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-white text-gray-900 dark:bg-gray-700 dark:focus:border-primary-500 dark:text-white border-gray-300 focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 focus:ring-opacity-70 rounded-lg shadow-sm']) !!}>
