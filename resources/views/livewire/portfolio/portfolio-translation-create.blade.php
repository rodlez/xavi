<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">

    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500 capitalize">
        <a href="/portfolios" class="{{ $textMenuHeader }}">{{ __('admin/portfolio/portfolio.menuIndex') }}</a> /
        <a href="/portfolios/{{ $portfolio->id }}" class="{{ $textMenuHeader }}">{{ $portfolio->name }}</a> /
        <a href="/portfolios/{{ $portfolio->id }}/translation/create"
            class="font-bold text-black {{ $underlineMenuHeader }}">{{ __('generic.translation') }}</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <!-- HEADER -->
        <div class="flex flex-row justify-between items-center py-4 {{ $bgMenuColor }}">
            <div>
                <span class="text-lg text-white px-4 capitalize">{{ __('generic.newF') }}
                    ({{ $translationLanguage->name }})</span>
            </div>
        </div>

        <!-- PORTFOLIO INFO -->
        <div class="flex flex-col mx-auto my-4 w-11/12">
            <div class="w-fit bg-black text-white text-lg capitalize mb-1 p-2">
                {{ __('generic.info') }}
            </div>
            <div class="flex flex-col text-white capitalize bg-slate-800">
                <span class="bg-orange-600 py-1 px-2">Id</span>
                <span class="text-sm p-2">{{ $portfolio->id }}</span>
                <span class="bg-orange-600 py-1 px-2">User</span>
                <span class="text-sm p-2">{{ $portfolio->user->name }}</span>
                <span class="bg-orange-600 py-1 px-2">{{ __('generic.published') }}</span>
                <span class="font-bold p-2">{{ publishedText($portfolio->published) }}</span>
                <span class="bg-orange-600 py-1 px-2">{{ __('generic.status') }}</span>
                <span class="font-bold p-2">{{ statusText($portfolio->status) }}</span>
                <span class="bg-orange-600 py-1 px-2">{{ __('generic.name') }}</span>
                <span class="font-bold p-2">{{ $portfolio->name }}</span>
                <span class="bg-orange-600 py-1 px-2">{{ __('generic.description') }}</span>
                <span class="text-sm p-2">{{ $portfolio->description ? $portfolio->description : '-' }}</span>
            </div>
        </div>

        <!-- CREATE TRANSLATION -->
        <div class="mx-auto w-11/12 my-4">

            @if ($isTranslated == false)
                <form wire:submit="save">
                    <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                    @csrf

                    <!-- Form Text Message -->
                    <div class="italic p-2 rounded-md {{ $bgInfoColor }}">{{ __('generic.createTranslation') }}
                    </div>

                    <!-- Form Errors Message -->
                    @if ($errors->any())
                        <div class="bg-red-400 p-2 rounded-md my-2">
                            <span class="text-lg text-white font-bold">{{ __('generic.errorForm') }}</span>
                        </div>
                    @endif

                    <!-- Language -->
                    <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.language') }}</h2>

                    <div class="relative">
                        <input placeholder="{{ $translationLanguage->name }}" readonly disabled
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-language  bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    <!-- Category -->
                    <h2 class="text-lg font-bold capitalize pt-2 pb-1 px-2">{{ __('generic.categories') }} <span
                            class="text-red-600">*</span></h2>
                    @if ($categories->count() > 0)
                        <div class="relative">
                            <select wire:model.live="pf_cat_trans_id" name="pf_cat_trans_id" id="pf_cat_trans_id"
                                class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" class="text-green-600"
                                        @if (old('pf_cat_trans_id') == $category->id) selected @endif>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                                <i class="fa-solid fa-basketball bg-gray-200 p-3 rounded-l-md"></i>
                            </div>
                        </div>
                        <div class="text-sm text-red-600 font-bold py-1 px-2">
                            @error('pf_cat_trans_id')
                                {{ $message }}
                            @enderror
                        </div>
                    @else
                        <!-- Still No Categories created -->
                        <div class="text-sm text-red-600 font-bold py-1 px-2">
                            {{ __('admin/portfolio/portfolio.noCategoriesMessage') }}
                            <button
                                class="bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-sm shadow-none transition duration-500 ease-in-out">
                                <a href="{{ route('pf_categories') }}">
                                    {{ __('generic.categories') }}
                                </a>
                            </button>
                        </div>
                    @endif


                    <!-- Type -->
                    <h2 class="text-lg font-bold capitalize pt-2 pb-1 px-2">{{ __('generic.types') }} <span
                            class="text-red-600">*</span></h2>
                    @if ($types->count() > 0)
                        <div class="relative">
                            <select wire:model.live="pf_type_trans_id" name="pf_type_trans_id" id="pf_type_trans_id"
                                class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" class="text-green-600"
                                        @if (old('pf_type_trans_id') == $type->id) selected @endif>{{ $type->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                                <i class="fa-solid fa-basketball bg-gray-200 p-3 rounded-l-md"></i>
                            </div>
                        </div>
                        <div class="text-sm text-red-600 font-bold py-1 px-2">
                            @error('pf_type_trans_id')
                                {{ $message }}
                            @enderror
                        </div>
                    @else
                        <!-- Still No Types created -->
                        <div class="text-sm text-red-600 font-bold py-1 px-2">
                            {{ __('admin/portfolio/portfolio.noTypesMessage') }}
                            <button
                                class="bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-sm shadow-none transition duration-500 ease-in-out">
                                <a href="{{ route('pf_types') }}">
                                    {{ __('generic.types') }}
                                </a>
                            </button>
                        </div>
                    @endif

                    <!-- Title -->
                    <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.title') }} <span
                            class="text-red-600">*</span>
                    </h2>

                    <div class="relative">
                        <input wire:model="title" name="title" id="title" type="text"
                            value="{{ old('title') }}" maxlength="200"
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-tag  bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    <div class="text-sm text-red-600 font-bold py-1 px-2">
                        @error('title')
                            {{ $message }}
                        @enderror
                    </div>

                    <!-- SubTitle -->
                    <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.subtitle') }}</h2>

                    <div class="relative">
                        <input wire:model="subtitle" name="subtitle" id="subtitle" type="text"
                            value="{{ old('subtitle') }}" maxlength="200"
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-tag  bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    <div class="text-sm text-red-600 font-bold py-1 px-2">
                        @error('subtitle')
                            {{ $message }}
                        @enderror
                    </div>

                    <!-- Content -->
                    <div class="flex flex-col justify-start items-start w-full sm:w-2/3 gap-4 py-2">
                        <span class="text-lg font-semibold capitalize px-2">{{ __('generic.content') }}</span>
                        <textarea wire:model="content" rows="6" name="content" id="content"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg w-full p-2 {{ $focusColor }}"></textarea>
                    </div>

                    <div class="text-sm text-red-600 font-bold py-1 px-2">
                        @error('content')
                            {{ $message }}
                        @enderror
                    </div>

                    <!-- Year -->
                    <h2 class="text-lg font-bold pt-2 pb-1 px-2">{{ __('generic.year') }}</h2>

                    <div class="relative">
                        <input wire:model="year" name="year" id="year" type="number"
                            value="{{ old('year') }}" maxlength="200"
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">

                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-clock bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    <div class="text-sm text-red-600 font-bold py-1 px-2">
                        @error('year')
                            {{ $message }}
                        @enderror
                    </div>

                    <!-- Location -->
                    <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.location') }}</h2>

                    <div class="relative">
                        <input wire:model="location" name="location" id="location" type="text"
                            value="{{ old('location') }}" maxlength="200"
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-tag  bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    <div class="text-sm text-red-600 font-bold py-1 px-2">
                        @error('location')
                            {{ $message }}
                        @enderror
                    </div>

                    <!-- Client -->
                    <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.client') }}</h2>

                    <div class="relative">
                        <input wire:model="client" name="client" id="client" type="text"
                            value="{{ old('client') }}" maxlength="200"
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-tag  bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    <div class="text-sm text-red-600 font-bold py-1 px-2">
                        @error('client')
                            {{ $message }}
                        @enderror
                    </div>

                    <!-- Project -->
                    <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.project') }}</h2>

                    <div class="relative">
                        <input wire:model="project" name="project" id="project" type="text"
                            value="{{ old('project') }}" maxlength="200"
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-tag  bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    <div class="text-sm text-red-600 font-bold py-1 px-2">
                        @error('project')
                            {{ $message }}
                        @enderror
                    </div>

                    <!-- Save -->
                    <div class="py-4">
                        <button type="submit"
                            class="w-full sm:w-fit bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-lg shadow-none transition duration-500 ease-in-out">
                            {{ __('generic.save') }}
                            <i class="fa-solid fa-floppy-disk px-2"></i>
                        </button>
                    </div>

                </form>
            @else
                <div class="flex flex-row justify-between items-center gap-4 bg-red-600 p-4 rounded-md">
                    <span class="text-white font-bold">{{ __('generic.alreadyTranslation') }}
                        ({{ $translationLanguage->name }})</span>
                    <a href="{{ route('portfolios.show', $portfolio) }}"
                        class="font-bold text-white hover:text-black transition duration-1000 ease-in-out"
                        title="{{ __('generic.back') }}">
                        <i class="fa-solid fa-x"></i>
                    </a>
                </div>
            @endif
        </div>

        <!-- Footer -->
        <div class="flex flex-row justify-end items-center py-4 px-4 {{ $bgMenuColor }} sm:rounded-b-lg">
            <a href="{{ route('portfolios.show', $portfolio) }}">
                <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out"
                    title="{{ __('generic.back') }}"></i>
            </a>
        </div>


    </div>

</div>
