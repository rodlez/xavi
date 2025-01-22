<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">
    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500">
        <a href="/admin/languages" class="{{ $textMenuHeader }}">{{ __('generic.languages') }}</a> /
        <a href="/admin/languages/{{ $language->id }}" class="{{ $textMenuHeader }}">{{ __('generic.info') }}</a> /
        <a href="/admin/languages/edit/{{ $language->id }}"
            class="font-bold text-black {{ $underlineMenuHeader }}">{{ __('generic.edit') }}</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <!-- Header -->
        <div class="flex flex-row justify-between items-center py-4 {{ $bgMenuColor }}">
            <div>
                <span class="text-lg text-white px-4">{{ __('generic.languages') }}</span>
            </div>
        </div>
        <!--Language -->
        <div class="mx-auto w-11/12 py-4 px-2">
            <form action="{{ route('languages.update', $language) }}" method="POST">
                <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                @csrf
                <!-- Directive to Override the http method -->
                @method('PUT')

                <!-- Name -->
                <div class="flex flex-col justify-start items-start w-full sm:w-2/3 gap-4 py-2">
                    <span class="text-md font-semibold capitalize px-2">{{ __('generic.name') }} <span class="text-red-600">*</span></span>
                    <input name="name" id="name" type="text" value="{{ $language->name }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg w-full sm:w-2/3 p-2 focus:ring-yellow-500 focus:border-yellow-500">
                </div>
                <!-- Errors -->
                @error('name')
                    <div>
                        <span class="text-sm text-red-400 font-bold px-2">{{ $message }}</span>
                    </div>
                @enderror

                <!-- Code -->
                <div class="flex flex-col justify-start items-start w-full sm:w-2/3 gap-4 py-2">
                    <span class="text-md font-semibold capitalize px-2">{{ __('generic.code') }} <span class="text-red-600">*</span></span>
                    <input name="code" id="code" type="text" value="{{ $language->code }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg w-full sm:w-2/3 p-2 focus:ring-yellow-500 focus:border-yellow-500">
                </div>
                <!-- Errors -->
                @error('code')
                    <div>
                        <span class="text-sm text-red-400 font-bold px-2">{{ $message }}</span>
                    </div>
                @enderror

                <!-- Save -->
                <div class="py-4">
                    <button type="submit"
                        class="w-full sm:w-fit bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-lg shadow-none transition duration-500 ease-in-out">
                        {{ __('generic.save') }}
                        <i class="fa-solid fa-floppy-disk px-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Footer -->
    <div class="flex flex-row justify-end items-center py-4 px-4 {{ $bgMenuColor }} sm:rounded-b-lg">
        <a href="{{ route('languages.show', $language) }}">
            <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out"
                title="{{ __('generic.back') }}"></i>
        </a>
    </div>
</div>
