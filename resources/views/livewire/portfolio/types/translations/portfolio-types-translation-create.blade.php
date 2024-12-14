<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">

    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500 capitalize">
        <a href="/pf_types" class="{{ $textMenuHeader }}">{{ __('admin/portfolio/portfolioTypes.menuIndex') }}</a> /
        <a href="/pf_types/{{ $type->id }}" class="{{ $textMenuHeader }}">{{ $type->name }}</a> /
        <a href="/pf_types/{{ $type->id }}/translation/create/{{ $missingTranslationId }}"
            class="font-bold text-black {{ $underlineMenuHeader }}">{{ __('generic.newF') }}
            {{ __('generic.translation') }} ({{ $translationLanguage->code }})</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <!-- HEADER -->
        <div class="flex flex-row py-4 {{ $bgMenuColor }}">
            <span class="text-lg text-white px-4 capitalize">{{ __('generic.portfolio') }} {{ __('generic.type') }}
                {{ __('generic.translation') }}</span>
        </div>

        <div class="mx-auto w-11/12 my-4 px-2">

            <!-- ORIGINAL TYPE INFORMATION -->
            <div class="flex flex-col">

                <div class="flex flex-row justify-between">
                    <div class="flex w-full sm:w-fit {{ $bgInfoTab }} text-white font-light uppercase rounded-t-md p-2">
                        {{ __('generic.type') }}
                    </div>
                </div>
                <!-- Info Type -->
                <div class="flex flex-col text-black capitalize bg-slate-200 rounded-b-lg sm:rounded-tr-lg">
                    <span class="{{ $menuInfo }} p-2 sm:rounded-tr-lg">Id</span>
                    <span class="p-2">{{ $type->id }}</span>
                    <span class="{{ $menuInfo }} p-2">{{ __('generic.name') }}</span>
                    <span class="{{ $typeName }} p-2">{{ $type->name }}</span>
                    <span class="{{ $menuInfo }} p-2">{{ __('generic.description') }}</span>
                    <span class="text-sm normal-case p-2">{{ $type->description ? $type->description : '-' }}</span>
                </div>

                <!-- TRANSLATION -->
                @if ($isTranslated == false)
                    <div class="flex flex-col my-8">
                        <!-- Info Type Translation -->
                        <div class="flex w-full sm:w-fit {{ $bgTranslationTab }} text-white font-light uppercase rounded-t-md p-2">
                            {{ __('generic.translation') }}
                        </div>
                        <div class="flex flex-col text-black capitalize bg-gray-200 rounded-b-lg sm:rounded-tr-lg">
                            <span class="{{ $menuInfo }} p-2 sm:rounded-tr-lg">{{ __('generic.language') }}</span>
                            <span class="{{ $translationName }} p-2 rounded-b-lg">{{ $translationLanguage->name }}</span>
                        </div>
                    </div>

                    <!-- Create Translation Type Message -->
                    <div
                        class="flex w-full sm:w-fit text-lg {{$createTranslation}} font-light normal-case rounded-t-md p-2">
                        <span>{{ __('generic.createTranslation') }}</span>
                    </div>
                    <!-- Mandatory Form Fields Message -->
                    <div class="flex flex-col text-black normal-case bg-gray-200 sm:rounded-tr-lg">
                        <span class="{{ $menuInfo }} text-sm p-2 sm:rounded-tr-lg">{{ __('generic.mandatoryFields') }}</span>
                    </div>                   

                    <!-- Form -->
                    <div class="bg-slate-200 rounded-b-md my-0 p-2">
                        <form wire:submit="save">
                            <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                            @csrf
                            <!-- Name -->
                            <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.translation') }} <span
                                    class="text-red-600">*</span></h2>

                            <div class="relative">
                                <input wire:model="name" name="name" id="name" type="text"
                                    value="{{ old('name') }}" maxlength="100"
                                    class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                                <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                                    <i class="fa-solid fa-language bg-slate-400 p-3 rounded-l-md"></i>
                                </div>
                            </div>

                            @error('name')
                                <div class="text-sm text-red-600 normal-case font-bold py-1 px-2">
                                    {{ $message }}
                                </div>
                            @enderror

                            <!-- Save -->
                            <div class="mt-4 mb-2">
                                <button type="submit"
                                    class="w-full sm:w-1/4 bg-black hover:bg-slate-700 text-white uppercase p-2 rounded-lg shadow-none transition duration-500 ease-in-out">
                                    {{ __('generic.save') }}
                                </button>
                            </div>

                        </form>
                    </div>
                @else
                    <div class="flex flex-row justify-between items-center gap-4 bg-red-600 p-4 my-6 rounded-md">
                        <span class="text-white font-bold normal-case">{{ __('generic.alreadyTranslation') }}
                            ({{ $translationLanguage->name }})</span>
                        <a href="{{ route('pf_types.show', $type) }}"
                            class="font-bold text-white hover:text-black transition duration-1000 ease-in-out"
                            title="{{ __('generic.back') }}">
                            <i class="fa-solid fa-x"></i>
                        </a>
                    </div>
                @endif

            </div>

        </div>

        <!-- Footer -->
        <div
            class="flex flex-row justify-between items-center text-white text-center p-4 {{ $bgMenuColor }} sm:rounded-b-lg">
            <div class="w-1/3 text-left"><a href="{{ route('pf_types.show', $type) }}">
                    <i class="fa-lg fa-solid fa-chevron-left hover:text-black transition duration-1000 ease-in-out"
                        title="{{ __('generic.back') }}"></i>
                </a>
            </div>
            <div class="w-1/3 max-sm:text-xs">{{ __('generic.authorInfo') }}</div>
            <div class="w-1/3 text-right">
                <a href="{{ route('dashboard') }}">
                    <i class="fa-lg fa-solid fa-house hover:text-black transition duration-1000 ease-in-out"
                        title="{{ __('generic.back') }}"></i>
                </a>
            </div>
        </div>

    </div>

</div>
