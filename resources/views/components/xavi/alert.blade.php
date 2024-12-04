@props([            
    'type' => 'success',
    'dismissible' => true,
    'closeSelf' => 0
])

@php
    $dismissible = filter_var($dismissible, FILTER_VALIDATE_BOOLEAN);
    $options = [
        'success' => 'text-emerald-900 bg-emerald-100 border-emerald-300 capitalize',
        'danger' => 'text-red-900 bg-red-100 border-red-300 capitalize',
        'info' => 'text-sky-900 bg-sky-100 border-sky-300 capitalize',
        'warning' => 'text-orange-900 bg-orange-100 border-orange-300 capitalize',
        'light' => 'bg-white border-gray-300 capitalize',
    ];
    $style = $options[$type] ?? $options['success']
@endphp

<div    
    wire:key="{{ rand() }}"
    {{-- To make the component compatible with Livewire to react to DOM changes 
        One of the issues with Livewire is that the component will not always react after the DOM has changed
        When you close the alert and want to open it again, you need to re-initialize the component
        Line 2: this can be solved by adding the wire:key Livewire directive with a unique (= random) value to the component
    --}}
    x-data="{ open: true }"
    x-show="open"
    x-transition.duration.300ms
    @if($closeSelf > 0)         
        x-init="setTimeout(() => open = false, {{ $closeSelf }})"
    @endif
    {{ $attributes->merge(['class' => "$style flex gap-4 p-4 my-4 border"]) }}>
    <div class="flex-1">
        {{ $slot  }}
    </div>
    @if($dismissible)
        <button class="cursor-pointer flex justify-center items-center" aria-label="close" @click="open = false">
            {{-- <x-heroicon-s-x-circle/> --}}
            <i class="fa-solid fa-circle-xmark hover:text-red-600"></i>
        </button>
    @endif
</div>