    <nav class="flex justify-start items-center gap-4 bg-red-200">

        <!-- Menu Links -->

        <a href="{{ route('home') }}" class="hover:underline">{{ __('menulinks.home') }}</a>
        <a href="{{ route('contact') }}" class="hover:underline">{{ __('menulinks.contact') }}</a>
        <a href="{{ route('services') }}" class="hover:underline">{{ __('menulinks.services') }}</a>

        <a href="{{ route('portfolio') }}" class="hover:underline capitalize">{{ __('generic.portfolio') }}</a>

        <!-- Playground -->
        <a href="{{ route('playground') }}" class="hover:underline">Test</a>

        <!-- Authentication Links -->

        @if (Auth::check())
            <a href="{{ route('dashboard') }}" class="hover:underline">Admin</a>
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <button type="submit"
                        class="hover:underline hover:text-red-400">
                    {{ __('Log Out') }}
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="hover:underline">Login</a>
        @endif

        <!-- Languages Links-->

        @if (App::currentLocale() != 'es')
            <a href="{{ route('change.lang', ['lang' => 'es']) }}" class="hover:underline">ESP</a>
        @endif
        @if (App::currentLocale() != 'ca')
            <a href="{{ route('change.lang', ['lang' => 'ca']) }}" class="hover:underline">CAT</a>
        @endif
        @if (App::currentLocale() != 'en')
            <a href="{{ route('change.lang', ['lang' => 'en']) }}" class="hover:underline">ENG</a>
        @endif

        <!-- Test Session -->
        SESSION -> {{var_dump(session()->all())}}

        <!-- Test Locale -->
        LOCALE -> {{App::currentLocale()}}

        <!-- Using a Dropdown Component -->
        {{-- <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                    @php($languages = ['en' => 'English', 'es' => 'Español', 'ca' => 'Català'])
                    <div>Language: {{ $languages[Session::get('locale', 'es')] }}</div>
    
                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>
    
            <x-slot name="content">
                <x-dropdown-link :href="route('change.lang', ['lang' => 'en'])">
                    English
                </x-dropdown-link>
                <x-dropdown-link :href="route('change.lang', ['lang' => 'es'])">
                    Español
                </x-dropdown-link>
                <x-dropdown-link :href="route('change.lang', ['lang' => 'ca'])">
                    Català
                </x-dropdown-link>
            </x-slot>
        </x-dropdown> --}}
    </nav>
