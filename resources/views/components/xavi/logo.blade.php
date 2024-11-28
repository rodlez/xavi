@props([            
    'type' => 'small',      // default value is 'ul'
    'transition' => '',    
])

@php
    $options = [
         'small' => 'w-12',
         'medium' => 'w-24',
         'big' => 'w-48',
     ];
     // If there is no type defined default will be ul
     $style = $options[$type] . ' ' . $transition ?? $options['small'];     
@endphp

<ul {{ $attributes->merge(['class' => $style ]) }}>
    {{ $slot }}
</ul>

<img src="{{asset('assets/icons/logo.jpg')}}" alt="XavRod Logo" {{ $attributes->merge(['class' => $style ]) }} {{-- height="50px" width="100px" --}}>