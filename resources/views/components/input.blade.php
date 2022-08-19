@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-emerald-300 rounded-md shadow-sm border-gray-300 focus:border-emerald-50 focus:ring focus:ring-emerald-900 focus:ring-opacity-50']) !!}>
