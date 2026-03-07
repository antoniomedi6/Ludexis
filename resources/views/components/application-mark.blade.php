@props(['class' => 'h-42 w-auto'])

<img src="{{ asset('logo.png') }}" {{ $attributes->merge(['class' => $class]) }} alt="Logo">
