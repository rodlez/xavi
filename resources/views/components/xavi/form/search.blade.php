@php
    $model =  $attributes->wire('model')->value();
@endphp
<div
    @if($model)
        x-data="{ value: @entangle($model) }"
    @endif
    class="mt-1 relative w-full">

    <div class="absolute top-2 bottom-0 left-4 text-slate-700">
        <i class="fa-solid fa-magnifying-glass"></i>
    </div>

    <input type="text"
        {{ $attributes->merge(["class" => "w-full pl-10 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"]) }} />
    {{-- <x-phosphor-magnifying-glass class="absolute top-3 ml-3 w-5 h-5 text-gray-400"/> --}}
    {{-- <i class="fa-solid fa-magnifying-glass absolute top-3 ml-3 w-5 h-5 text-gray-400"></i> --}}
    <button
        x-show="value"
        x-cloak
        @click="$wire.set('{{ $model }}', '')"
        class="w-5 absolute right-4 top-3 text-gray-400">
        
        {{-- <x-phosphor-x-circle-fill/> --}}
        <i class="fa-solid fa-circle-xmark"></i>
    </button>
    
</div>


{{-- <div class="relative w-full">
    <div class="absolute top-2.5 bottom-0 left-4 text-slate-700">
        <i class="fa-solid fa-magnifying-glass"></i>
    </div>
    <input wire:model.live="search" type="search"
        class="w-full rounded-lg pl-10 font-sm placeholder-zinc-400 {{$focusColor}} border-2 border-zinc-200"
        placeholder="{{__("generic.searchPlaceholderName")}}">
</div> --}}