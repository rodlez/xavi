<x-xavi-layout>

<div class="flex flex-col justify-center items-center gap-6 text-white bg-red-500 h-screen">
    <div class="text-white text-9xl font-bold">{{ __('errors.error404') }}</div>
    <span class="text-white">{{ __('errors.message404') }}</span>
    <div class="class flex flex-row justify-center gap-4">
        <a href="/admin/dashboard" class="bg-blue-700 hover:bg-blue-500 text-white font-semibold hover:text-white py-2 px-4 border border-white hover:border-transparent rounded">{{ __('errors.home') }}</a>
        <a href="/contact" class="bg-blue-700 hover:bg-blue-500 text-white font-semibold hover:text-white py-2 px-4 border border-white hover:border-transparent rounded">{{ __('errors.contact') }}</a>
    </div>    
aadmin
    <br /><br /><br />
    @if (isset($fallback))
    <span class="bg-green-400 p-4">FALLBACK</span>
    @else
    <span class="bg-black p-4">EXCEPTION</span>
    @endif  

</div>

</x-xavi-layout>