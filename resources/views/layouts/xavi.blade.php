<!DOCTYPE html>
<html lang="{{ config('app.locale', 'es') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description ?? 'Welcome to Xavrod' }}">
    <title>{{ $title ?? 'XavRod' }}</title>

    <!-- JQUERY -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <!-- LIGHTBOX -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.5/js/lightbox.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.5/css/lightbox.css" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

</head>

<body class="font-sans antialiased">
    <div class="flex flex-col space-y-2 min-h-screen text-gray-800 bg-slate-100">
        {{-- <header class="shadow bg-white/70 sticky inset-0 backdrop-blur-sm z-10"> --}}
        <header class="bg-red-400 w-full flex mx-auto gap-4 p-2 sticky inset-0 backdrop-blur-sm z-10">
            {{--  Logo  --}}            
            <x-layout.xavilogo />
            {{--  Navigation  --}}            
            <x-layout.xavinav />
        </header>
        <main class="container mx-auto flex-1 px-4">
            {{-- Title --}}
            {{-- <h1 class="text-3xl mb-4 capitalize">
                {{ $subtitle ?? ($title ?? 'This page has no (sub)title') }}
            </h1> --}}
            {{-- Main content --}}
            {{ $slot }}
        </main>
        {{--  Footer  --}}            
        <x-layout.xavifooter />
        {{-- JS --}}
        @stack('script')
        @livewireScripts
    </div>
</body>

</html>
