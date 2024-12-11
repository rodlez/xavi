<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">
    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500 capitalize">
        <a href="/languages" class="text-black {{ $textMenuHeader }}">{{ __('generic.languages') }}</a> /
        <a href="/languages/{{ $language->id }}"
            class="font-bold text-black {{ $underlineMenuHeader }}">{{ __('generic.info') }}</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <!-- Header -->
        <div class="flex flex-row justify-between items-center py-4 {{ $bgMenuColor }}">
            <div>
                <span class="text-lg text-white px-4">{{ __('generic.languages') }}</span>
            </div>
        </div>

        <!-- Info -->
        <div class="mx-auto w-11/12 py-4 px-2">
            <div><span class="font-semibold capitalizepx-2">{{ __('generic.name') }}</span></div>
            <div class="flex flex-row justify-start items-center gap-4 py-2">
                <!-- Name -->
                <input type="text" id="name"
                    class="bg-zinc-200 border border-zinc-300 text-gray-900 text-md rounded-lg w-full sm:w-1/2 pl-2 p-2  dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-yellow-500 dark:focus:border-yellow-500"
                    value="{{ $language->name }}" disabled>
                <!-- Code -->
                <input type="text" id="code"
                    class="bg-zinc-200 border border-zinc-300 text-gray-900 text-md rounded-lg w-full sm:w-1/2 pl-2 p-2  dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-yellow-500 dark:focus:border-yellow-500"
                    value="{{ $language->code }}" disabled>
                <!-- Edit -->
                <a href="{{ route('languages.edit', $language) }}">
                    <i class="fa-solid fa-pen-to-square text-green-600 hover:text-black transition duration-1000 ease-in-out"
                        title="{{ __('generic.edit') }}"></i>
                </a>
                <!-- Delete -->
                <form action="{{ route('languages.destroy', $language) }}" method="POST">
                    <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                    @csrf
                    <!-- Directive to Override the http method -->
                    @method('DELETE')
                    <button onclick="return confirm('{{ __('generic.confirmDelete') }}')">
                        <i class="fa-solid fa-trash text-red-600 hover:text-black transition duration-1000 ease-in-out"
                            title="{{ __('generic.delete') }}"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <div class="flex flex-row justify-end items-center py-4 px-4 {{ $bgMenuColor }} sm:rounded-b-lg">
            <a href="{{ route('languages') }}">
                <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out"
                    title="{{ __('generic.back') }}"></i>
            </a>
        </div>

    </div>

</div>
