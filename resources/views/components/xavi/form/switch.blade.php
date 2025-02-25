@props([        
    'colorOff' => null,
    'colorOn' => null,
    'textOff' => '✘',
    'textOn' => '✓',
])

@php
    $userClass = $attributes->get('class') ?? '';
    $cursor = $attributes->get('disabled') ? ' cursor-not-allowed opacity-50 ' : ' cursor-pointer ';
    $userClass = $userClass . $cursor;
    $colorOff = $colorOff ?? 'bg-gray-200';
    $colorOn = $colorOn ?? 'bg-green-300';
    $model =  $attributes->wire('model')->value();
@endphp

<label
    @if($model)
        x-data="{ value: @entangle($model) }"
    @endif
    class="{{$userClass}} border border-gray-300 rounded-md text-center font-semibold uppercase text-xs h-9 w-16 inline-flex flex-wrap overflow-hidden">
    <input type="checkbox" class="hidden peer"
           {{ $attributes->except('class') }}>
    <span data-content="{{$textOff}}"
          class="self-stretch w-full h-full flex justify-center items-center {{ $colorOff }} before:content-[attr(data-content)] peer-checked:-translate-x-full transition duration-300 ease-in-out"></span>
    <span data-content="{{$textOn}}"
          class="self-stretch w-full h-full flex justify-center items-center {{ $colorOn }} before:content-[attr(data-content)] -translate-y-full translate-x-full peer-checked:-translate-x-0 transition duration-300 ease-in-out"></span>
</label>