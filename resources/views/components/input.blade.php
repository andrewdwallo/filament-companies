@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'flex items-center space-x-2 rtl:space-x-reverse group block w-full transition duration-75 rounded-lg shadow-sm focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70 dark:bg-gray-700 dark:text-white dark:focus:border-primary-500 border-gray-300 dark:border-gray-600']) !!}>
