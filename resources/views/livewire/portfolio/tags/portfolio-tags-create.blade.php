<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">

    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500 capitalize">
        <a href="/pf_tags"
            class="text-black {{ $textMenuHeader }}">{{ __('admin/portfolio/portfolioTags.menuIndex') }}</a> /
        <a href="/pf_tags/create" class="font-bold text-black {{ $underlineMenuHeader }}">{{ __('generic.new') }}</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <!-- HEADER -->
        <div class="flex flex-row justify-start items-center py-4 {{ $bgMenuColor }}">
            <span class="text-lg text-white capitalize px-4">{{ __('generic.portfolio') }} {{ __('generic.tag') }}</span>
        </div>

        <!-- NEW TAG -->
        <div class="mx-auto w-11/12 py-4 px-2">

            <!-- New Tag Message -->
            <div class="flex justify-start items-end rounded-md p-4 text-lg text-white bg-green-600">
                <span class="font-light">{{ __('admin/portfolio/portfolioTags.infoMessageCreate') }}</span>
            </div>
            <!-- Mandatory Form Fields Message -->
            <div class="text-sm text-slate-600 px-4 py-1">
                {{ __('generic.mandatoryFields') }}
            </div>

            <!-- Form -->
            <div class="bg-slate-100 rounded-md my-2 p-2">

                <form wire:submit="save">
                    <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                    @csrf
                    <!-- Name -->
                    <h2 class="text-lg font-bold capitalize pt-2 pb-1 px-2">{{ __('generic.name') }} <span
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
                        <span class="text-lg font-semibold capitalize px-2">{{ __('generic.description') }}</span>
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
        <div class="flex flex-row justify-end items-center py-4 px-4 {{ $bgMenuColor }} sm:rounded-b-lg">
            <a href="{{ route('pf_tags') }}">
                <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out"
                    title="{{ __('generic.back') }}"></i>
            </a>
        </div>

    </div>

</div>
