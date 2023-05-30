@props(['disabled' => false, 'id' => null])

<input
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->class([
        'filament-companies-input block w-full transition duration-75 rounded-lg shadow-sm outline-none focus:ring-1 focus:ring-inset disabled:opacity-70',
        'dark:bg-gray-700 dark:text-white' => config('forms.dark_mode'),
        'border-gray-300 focus:border-primary-500 focus:ring-primary-500' => ! $errors->has($id),
        'dark:border-gray-600 dark:focus:border-primary-500' => ! $errors->has($id) && config('forms.dark_mode'),
        'border-danger-600 ring-danger-600 focus:border-danger-500 focus:ring-danger-500' => $errors->has($id),
        'dark:border-danger-400 dark:ring-danger-400 dark:focus:border-danger-400 dark:focus:ring-danger-400' => $errors->has($id) && config('forms.dark_mode'),
    ]) !!}
/>
