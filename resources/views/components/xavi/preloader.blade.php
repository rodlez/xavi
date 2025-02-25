<div {{ $attributes->merge(['class' => "my-4 p-4 rounded-md !flex items-center gap-4"]) }} >
    {{-- Need to install BLADE UI KIT ICONS, but the more packages installed, slower the app will be.. --}}
    {{-- <x-phosphor-spinner-gap-bold class="animate-spin w-6 h-6"/> --}}
    <i class="fa-solid fa-spinner"></i>
    <span class="flex-1">
        @if($slot->isEmpty())
            <p>Processing data...</p>
        @else
            {{ $slot }}
        @endif
    </span>
</div>