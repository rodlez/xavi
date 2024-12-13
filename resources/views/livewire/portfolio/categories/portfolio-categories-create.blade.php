<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">

    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500 capitalize">
        <a href="/pf_categories" class="text-black {{$textMenuHeader}}">{{__("admin/portfolio/portfolioCategories.menuIndex")}}</a> /
        <a href="/pf_categories/create" class="font-bold text-black {{$underlineMenuHeader}}">{{__("generic.new")}}</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <!-- HEADER -->
        <div class="flex flex-row py-4 {{$bgMenuColor}}">
            <span class="text-lg text-white capitalize px-4">{{__("admin/portfolio/portfolioCategories.titleHeader")}} </span>
        </div>

        <!-- NEW category -->
        <div class="mx-auto w-11/12 py-4 px-2">

            <!-- Create Translation Category Message -->
            <div class="flex w-full sm:w-fit text-lg text-white bg-green-600 font-light normal-case rounded-t-md p-2">
                <span>{{ __('admin/portfolio/portfolioCategories.infoMessageCreate') }}</span>
            </div>
            <!-- Mandatory Form Fields Message -->
            <div class="flex flex-col text-black normal-case bg-gray-200 sm:rounded-tr-lg">
                <span
                    class="{{ $menuInfo }} text-sm p-2 sm:rounded-tr-lg">{{ __('generic.mandatoryFields') }}</span>
            </div>           

            <!-- Form -->
            <div class="bg-slate-100 rounded-md my-0 p-2">

                <form wire:submit="save">
                    <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                    @csrf
                    <!-- AutoTranslations -->
                    <div class="flex flex-col py-2">
                        <div
                            class="flex flex-row justify-between sm:justify-start items-center rounded-lg my-2 p-2 gap-2 {{ $autoTranslations == false ? 'bg-slate-400' : 'bg-green-400' }} ">
                            <span class="text-lg text-white">{{ __('generic.noTranslation') }}</span>
                            <div>
                                <label class="inline-flex cursor-pointer pt-2">
                                    <input wire:model.live="autoTranslations" name="autoTranslations"
                                        id="autoTranslations" type="checkbox" value="{{ old('autoTranslations') }}"
                                        class="sr-only peer">
                                    <div
                                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-white dark:peer-focus:ring-gray-600 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="bg-slate-800 rounded-md p-2">
                            <span class="text-sm text-white normal-case">{{ __('generic.noTranslationMessage') }}</span>
                        </div>
                    </div>
                    
                    <!-- Name -->
                    <h2 class="text-lg font-bold capitalize pb-1 px-1">{{ __('generic.name') }} <span
                            class="text-red-600">*</span></h2>

                    <div class="relative">
                        <input wire:model="name" name="name" id="name" type="text"
                            value="{{ old('name') }}" maxlength="100"
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white {{ $focusColor }}">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-tag bg-gray-300 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    @error('name')
                        <div class="text-sm text-red-600 font-bold py-1">
                            {{ $message }}
                        </div>
                    @enderror

                    <!-- Description -->
                    <div class="flex flex-col justify-start items-start w-full sm:w-2/3 gap-4 py-2">
                        <span class="text-lg font-semibold capitalize px-1">{{ __('generic.description') }}</span>
                        <textarea wire:model="description" rows="6" name="description" id="description"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg w-full p-2 {{ $focusColor }}"></textarea>
                    </div>

                    @error('description')
                        <div class="text-sm text-red-600 font-bold py-1">
                            {{ $message }}
                        </div>
                    @enderror

                    <!-- Save -->
                    <div class="my-4 pt-4">
                        <button type="submit"
                            class="w-full sm:w-fit bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-lg shadow-none transition duration-500 ease-in-out">
                            {{ __('generic.save') }}
                        </button>
                    </div>

                </form>
            </div>

        </div>

        <!-- FOOTER -->        
        <div
            class="flex flex-row justify-between items-center text-white text-center p-4 {{ $bgMenuColor }} sm:rounded-b-lg">
            <div class="w-1/3 text-left"><a href="{{ route('pf_categories') }}">
                    <i class="fa-lg fa-solid fa-chevron-left hover:text-black transition duration-1000 ease-in-out"
                        title="{{ __('generic.back') }}"></i>
                </a>
            </div>
            <div class="w-1/3 text-xs">{{ __('generic.authorInfo') }}</div>
            <div class="w-1/3 text-right">
                <a href="{{ route('dashboard') }}">
                    <i class="fa-lg fa-solid fa-house hover:text-black transition duration-1000 ease-in-out"
                        title="{{ __('generic.back') }}"></i>
                </a>
            </div>
        </div>

    </div>

</div>