<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">

    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500 capitalize">
        <a href="/pf_tags" class="{{ $textMenuHeader }}">{{ __('admin/portfolio/portfolioTags.menuIndex') }}</a> /
        <a href="/pf_tags/{{ $tag->id }}" class="{{ $textMenuHeader }}">{{ $tag->name }}</a> /
        <a href="/pf_tags/{{ $tag->id }}/translation/create/{{ $missingTranslationId }}"
            class="font-bold text-black {{ $underlineMenuHeader }}">{{ __('generic.newF') }}
            {{ __('generic.translation') }} ({{ $translationLanguage->code }})</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <!-- HEADER -->
        <div class="flex flex-row py-4 {{ $bgMenuColor }}">
            <span class="text-lg text-white px-4 capitalize">{{ __('generic.portfolio') }} {{ __('generic.tag') }}
                {{ __('generic.translation') }}</span>
        </div>

        <div class="mx-auto w-11/12 my-4 px-2">

            <!-- ORIGINAL TAG INFORMATION -->
            <div class="flex flex-col capitalize">

                <div class="flex flex-row justify-between">
                    <div class="w-fit {{ $bgInfoTab }} text-white text-lg rounded-t-md capitalize mb-0 p-2">
                        {{ __('generic.info') }}
                    </div>
                </div>
                <!-- Info Tag -->
                <div class="flex flex-col text-black bg-gray-200">
                    <span class="{{ $menuInfo }} p-2">Id</span>
                    <span class="p-2">{{ $tag->id }}</span>
                    <span class="{{ $menuInfo }} p-2">{{ __('generic.tag') }}</span>
                    <span class="{{ $tagName }} p-2">{{ $tag->name }}</span>
                    <span class="{{ $menuInfo }} p-2">{{ __('generic.description') }}</span>
                    <span class="text-sm p-2">{{ $tag->description ? $tag->description : '-' }}</span>
                </div>

                @if ($isTranslated == false)
                    <div class="flex flex-col capitalize mt-8 mb-4">

                        <div class="flex flex-row justify-between">
                            <div
                                class="w-fit {{ $bgTranslationTab }} text-white text-lg rounded-t-md capitalize mb-0 p-2">
                                {{ __('generic.translation') }}
                            </div>
                        </div>
                        <!-- Info Tag -->
                        <div class="flex flex-col text-black bg-gray-200">
                            <span class="{{ $menuInfo }} p-2">{{ __('generic.language') }}</span>
                            <span class="{{ $translationName }} p-2">{{ $translationLanguage->name }}</span>
                        </div>

                    </div>

                    <!-- EDIT TRANSLATION -->

                    <!-- Edit Tag Message -->
                    <div class="flex justify-start items-end rounded-md py-4 px-2 text-lg text-white bg-blue-600">
                        <span class="font-light">{{ __('generic.createTranslation') }} > <span
                                class="font-bold">{{ $translationLanguage->name }}</span></span>
                    </div>
                    <!-- Mandatory Form Fields Message -->
                    <div class="text-sm text-slate-600 px-2 py-1">
                        {{ __('generic.mandatoryFields') }}
                    </div>


                    <!-- Form -->
                    <div class="bg-slate-100 rounded-md my-2 p-2">
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
                                    <i class="fa-solid fa-language  bg-gray-200 p-3 rounded-l-md"></i>
                                </div>
                            </div>


                            @error('name')
                                <div class="text-sm text-red-600 font-bold py-1 px-2">
                                    {{ $message }}
                                </div>
                            @enderror


                            <!-- Save -->
                            <div class="py-4">
                                <button type="submit"
                                    class="w-full sm:w-fit bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-lg shadow-none transition duration-500 ease-in-out">
                                    {{ __('generic.save') }}
                                </button>
                            </div>

                        </form>
                    </div>
                @else
                    <div class="flex flex-row justify-between items-center gap-4 bg-red-600 p-4 my-6 rounded-md">
                        <span class="text-white font-bold normal-case">{{ __('generic.alreadyTranslation') }}
                            ({{ $translationLanguage->name }})</span>
                        <a href="{{ route('pf_tags.show', $tag) }}"
                            class="font-bold text-white hover:text-black transition duration-1000 ease-in-out"
                            title="{{ __('generic.back') }}">
                            <i class="fa-solid fa-x"></i>
                        </a>
                    </div>
                @endif

            </div>

        </div>


        <!-- Footer -->
        <div class="flex flex-row justify-end items-center py-4 px-4 {{ $bgMenuColor }} sm:rounded-b-lg">
            <a href="{{ route('pf_tags.show', $tag) }}">
                <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out"
                    title="{{ __('generic.back') }}"></i>
            </a>
        </div>


    </div>

</div>
