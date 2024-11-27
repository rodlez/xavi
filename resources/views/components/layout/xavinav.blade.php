    <nav class="flex justify-start items-center gap-4 bg-red-200">
        <a href="{{ route('home') }}" class="hover:underline">Home</a>
        <a href="{{ route('contact') }}" class="hover:underline">Contact</a>
        <a href="{{ route('services') }}" class="hover:underline">Services</a>
        <!-- Authentication -->
        @if (Auth::check())
            <a href="{{ route('dashboard') }}" class="hover:underline">Admin</a>
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <button type="submit"
                    class="hover:underline hover:text-red-400">
                    {{ __('Log Out') }}
                </button>
            </form>
        @endif
    </nav>
