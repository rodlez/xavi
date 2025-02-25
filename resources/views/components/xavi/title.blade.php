{{-- <div class="text-xl sm:text-4xl font-bold text-white bg-black my-0 py-4 text-center uppercase">
    {{$slot}}
</div> --}}

@props([            
    'type' => 'main',      // default value is 'main'
    'bgColor' => 'bg-black',
])

@php
    $options = [
         'main' => 'text-xl sm:text-4xl font-bold text-white my-0 py-4 text-center uppercase',
         'submenu' => 'text-m sm:text-xl font-bold text-white my-0 py-4 text-center uppercase',
     ];
     // If there is no type defined default will be main
     $style = $options[$type] . ' ' . $bgColor ?? $options['main'];     
@endphp


<div {{ $attributes->merge(['class' => $style ]) }}>
    {{ $slot }}
</div>