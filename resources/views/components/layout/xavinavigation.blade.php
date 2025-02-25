<nav class="container mx-auto p-4 flex justify-between">
    {{-- left navigation--}}
    <div class="flex items-center space-x-2">
        {{-- Logo --}}
        <a href="{{ route('home') }}">
            <x-xavi.logo class="w-8 h-8"/>
        </a>
        <a class="hidden sm:block font-medium text-lg" href="{{ route('home') }}">
            The Vinyl Shop
        </a>
        <x-nav-link href="{{ route('portfolio') }}" :active="request()->routeIs('portfolio')">
            Portfolio
        </x-nav-link>
        <x-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">
            Contact
        </x-nav-link>
    </div>

    {{-- right navigation --}}
    <div class="relative flex items-center space-x-2">
        <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
            Login
        </x-nav-link>
        <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
            Register
        </x-nav-link>
        <x-nav-link href="{{ route('under-construction') }}" :active="request()->routeIs('under-construction')">
            <i class="fa-solid fa-cart-shopping"></i>
        </x-nav-link>
        {{-- dropdown navigation--}}
        <x-dropdown align="right" width="48">
            {{-- avatar --}}
            <x-slot name="trigger">
                <img class="rounded-full h-8 w-8 cursor-pointer"
                     src="https://ui-avatars.com/api/?name=Vinyl+Shop"
                     alt="Vinyl Shop">
            </x-slot>
            <x-slot name="content">
                {{-- all users --}}
                <div class="block px-4 py-2 text-xs text-gray-400">My Name</div>
                <x-dropdown-link href="{{ route('dashboard') }}">Dashboard</x-dropdown-link>
                <x-dropdown-link href="{{ route('profile.show') }}">Update Profile</x-dropdown-link>
                <x-dropdown-link href="{{ route('under-construction') }}">Order history</x-dropdown-link>
                <div class="border-t border-gray-100"></div>
                <x-dropdown-link href="{{ route('under-construction') }}">Logout</x-dropdown-link>
                <div class="border-t border-gray-100"></div>
                {{-- admins only --}}
                <div class="block px-4 py-2 text-xs text-gray-400">Admin</div>
                <x-dropdown-link href="{{ route('under-construction') }}">Genres</x-dropdown-link>
                <x-dropdown-link href="{{ route('portfolios') }}">Records</x-dropdown-link>
                <x-dropdown-link href="{{ route('under-construction') }}">Covers</x-dropdown-link>
                <x-dropdown-link href="{{ route('under-construction') }}">Users</x-dropdown-link>
                <x-dropdown-link href="{{ route('under-construction') }}">Orders</x-dropdown-link>
            </x-slot>
        </x-dropdown>
    </div>
</nav>