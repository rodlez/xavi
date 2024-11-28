@props([            
    'type' => 'ul',      // default value is 'ul'
    'bgColor' => '',
    'titleList' => '',
])

@php
    $options = [
         'ul' => 'list-disc list-outside px-8 py-2',
         'ol' => 'list-decimal list-outside px-8 py-2',
         'group' => 'list-outside p-4 border border-gray-300 divide-y',
     ];
     // If there is no type defined default will be ul
     $style = $options[$type] . ' ' . $bgColor ?? $options['ul'];     
@endphp

<p class="px-4 font-bold"> {{$titleList}} </p> 

<ul {{ $attributes->merge(['class' => $style ]) }}>
    {{ $slot }}
</ul>