{{-- <div class="text-l italic sm:text-m font-ligth text-black bg-white my-0 p-4 text-center normal">
    {{$slot}}
</div> --}}

@props([            
    'type' => 'main',      // default value is 'main'
    'bgColor' => 'bg-white',
    'borderComp' => 'with',
])

@php
    $options = [
         'main' => 'text-l italic sm:text-m font-ligth text-black my-0 p-4 text-center normal',
         'submenu' => 'text-m sm:text-xl font-bold text-red-600 my-0 py-4 text-center uppercase',
     ];
     $options2 = [
         'with' => 'border border-gray-300 rounded overflow-hidden shadow-md',
         'none' => '',
         //'submenu' => 'text-m sm:text-xl font-bold text-white my-0 py-4 text-center uppercase',
     ];
     // If there is no type defined default will be main
     $style = $options[$type] . ' ' . $options2[$borderComp] . ' ' . $bgColor ?? $options['main'];     
@endphp


<div {{ $attributes->merge(['class' => $style ]) }}>
    {{ $slot }}
</div>