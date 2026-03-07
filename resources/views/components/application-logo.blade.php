@props(['class' => 'h-16 w-auto'])

<img src="{{ asset('logo.png') }}" {{ $attributes->merge(['class' => $class]) }} alt="Logo">
