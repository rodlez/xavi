<x-xavi-layout>

    <div class="flex flex-col justify-center items-center gap-6 bg-red-500 h-screen">
        <div class="text-white text-9xl font-bold">{{ __('errors.error500') }}</div>
        <span class="text-white">{{ __('errors.message500') }}</span>
        <div class="class flex flex-row justify-center gap-4">
            <a href="/" class="bg-blue-700 hover:bg-blue-500 text-white font-semibold hover:text-white py-2 px-4 border border-white hover:border-transparent rounded">{{ __('errors.home') }}</a>
            <a href="/contact" class="bg-blue-700 hover:bg-blue-500 text-white font-semibold hover:text-white py-2 px-4 border border-white hover:border-transparent rounded">{{ __('errors.contact') }}</a>
        </div>  
        
        <span>ERROR PATH -> {{isset($errorPath) ? $errorPath : '' }}</span>  
        <span>EXCEPTION MESSAGE -> {{isset($exception) ? $exception->getMessage() : '' }}</span>

    </div>         
    
</x-xavi-layout>