@props([
    'value10' => null,
    'value5' => null,
    'sizeClass' => 'w-3.5 h-3.5',
    'label' => null,
])

@php
    $rating_5 = $value5 ?? (is_null($value10) ? 0 : $value10 / 2);
    $rating_5 = max(0, min(5, $rating_5));

    $fullStars = floor($rating_5);
    $hasHalf = $rating_5 - $fullStars >= 0.5;
    $emptyStars = max(0, 5 - $fullStars - ($hasHalf ? 1 : 0));

    $ariaLabel = $label ?? 'Valoración: ' . number_format($rating_5, 1) . ' sobre 5';
@endphp

<div {{ $attributes->class('flex gap-0.5') }} aria-label="{{ $ariaLabel }}">
    @for ($i = 0; $i < $fullStars; $i++)
        <x-icons.star class="{{ $sizeClass }} fill-current" aria-hidden="true" />
    @endfor
    @if ($hasHalf)
        <x-icons.star half class="{{ $sizeClass }} fill-current" aria-hidden="true" />
    @endif
    @for ($i = 0; $i < $emptyStars; $i++)
        <x-icons.star class="{{ $sizeClass }} opacity-30 fill-current" aria-hidden="true" />
    @endfor
</div>

