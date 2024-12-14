<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">

    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500 capitalize">
        <a href="/portfolios" class="{{ $textMenuHeader }}">{{ __('admin/portfolio/portfolio.menuIndex') }}</a> /
        <a href="/portfolios/{{ $portfolio->id }}" class="{{ $textMenuHeader }}">{{ $portfolio->name }}</a> /
        <a href="/portfolios/{{ $portfolio->id }}/translation/create"
            class="font-bold text-black {{ $underlineMenuHeader }}">{{ __('generic.newF') }} {{ __('generic.translation') }} ({{ $translationLanguage->code }})</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <!-- HEADER -->
        <div class="flex flex-row justify-between items-center py-4 {{ $bgMenuColor }}">
            <div>
                <span class="text-lg text-white px-4 capitalize">{{ __('generic.portfolio') }}
                    {{ __('generic.translation') }}</span>
            </div>
        </div>

        <div class="mx-auto w-11/12 my-4 px-2">

        <!-- ORIGINAL PORTFOLIO INFORMATION -->
        <div class="flex flex-col capitalize">

            <div class="flex flex-row justify-between">
                <div class="w-fit {{ $bgInfoTab }} text-white text-lg rounded-t-md capitalize mb-0 p-2">
                    {{ __('generic.portfolio') }}
                </div>
                <!-- File Portfolios / Visible only in Larger Screens -->
                <div class="flex flex-row gap-1 max-sm:hidden">
                    <!-- Edit Portfolio -->
                    <div class="w-fit bg-blue-600 text-white text-lg rounded-t-md capitalize mb-0 p-2">
                        <a href="{{ route('portfolios.edit', $portfolio) }}">
                            {{ __('generic.edit') }}
                        </a>
                    </div>
                    <!-- Delete Portfolio -->
                    <div class="w-fit bg-red-600 text-white text-lg rounded-t-md capitalize mb-0 p-2">
                        <form action="{{ route('portfolios.destroy', $portfolio) }}" method="POST">
                            <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                            @csrf
                            <!-- Directive to Override the http method -->
                            @method('DELETE')
                            <button class="text-white capitalize"
                                onclick="return confirm('{{ __('generic.confirmDelete') }}')">
                                {{ __('generic.delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Info Portfolio -->
            <div class="flex flex-col text-black bg-gray-100">
                <span class="{{ $menuInfo }} p-2">Id</span>
                <span class="p-2">{{ $portfolio->id }}</span>
                <span class="{{ $menuInfo }} p-2">{{ __('generic.user') }}</span>
                <span class="p-2">{{ $portfolio->user->name }}</span>
                <span class="{{ $menuInfo }} p-2">{{ __('generic.published') }}</span>
                <span
                    class="p-2 {{ $portfolio->published ? 'bg-green-200' : 'bg-red-200' }}">{{ publishedText($portfolio->published) }}</span>
                <span class="{{ $menuInfo }} p-2">{{ __('generic.status') }}</span>
                <span class="p-2">{{ statusText($portfolio->status) }}</span>
                <span class="{{ $menuInfo }} p-2">{{ __('generic.name') }}</span>
                <span class="p-2 {{ $portfolioName }}">{{ $portfolio->name }}</span>
                <span class="{{ $menuInfo }} p-2">{{ __('generic.description') }}</span>
                <span
                    class="p-2 normal-case">{{ $portfolio->description ? $portfolio->description : '-' }}</span>
            </div>

            <!-- Big Actions Buttons in SMALL SCREENS -->
            <div class="flex flex-col sm:hidden justify-start gap-1 py-2">
                <!-- Edit -->
                <button
                    class="bg-blue-600 hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-md shadow-none transition duration-500 ease-in-out w-full sm:w-fit">
                    <a href="{{ route('portfolios.edit', $portfolio) }}">
                        {{ __('generic.edit') }}
                    </a>
                </button>
                <!-- Delete -->
                <form action="{{ route('portfolios.destroy', $portfolio) }}" method="POST">
                    <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                    @csrf
                    <!-- Directive to Override the http method -->
                    @method('DELETE')
                    <button
                        class="bg-red-600 hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-md shadow-none transition duration-500 ease-in-out w-full sm:w-fit"
                        onclick="return confirm('{{ __('generic.confirmDelete') }}')">
                        {{ __('generic.delete') }}
                    </button>
                </form>
            </div>

        </div>

       

            @if ($isTranslated == false)


            <div class="flex flex-col my-8">
                <!-- Info Tag Translation -->
                <div class="flex w-full sm:w-fit {{ $bgTranslationTab }} text-white font-light uppercase rounded-t-md p-2">
                    {{ __('generic.translation') }}
                </div>
                <div class="flex flex-col text-black capitalize bg-gray-200 rounded-b-lg sm:rounded-tr-lg">
                    <span class="{{ $menuInfo }} p-2 sm:rounded-tr-lg">{{ __('generic.language') }}</span>
                    <span class="{{ $translationName }} p-2 rounded-b-lg">{{ $translationLanguage->name }}</span>
                </div>
            </div>

            <!-- Create Translation Tag Message -->
            <div
            class="flex w-full sm:w-fit text-lg {{$createTranslation}} font-light normal-case rounded-t-md p-2">
            <span>{{ __('generic.createTranslation') }}</span>
        </div>
        <!-- Mandatory Form Fields Message -->
        <div class="flex flex-col text-black normal-case bg-gray-200 sm:rounded-tr-lg">
            <span class="{{ $menuInfo }} text-sm p-2 sm:rounded-tr-lg">{{ __('generic.mandatoryFields') }}</span>
        </div>


        <div class="bg-slate-100 rounded-b-md my-0 px-2 py-4">       
        
        <form wire:submit="save">
                    <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                    @csrf                   

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
                                <i class="fa-solid fa-list bg-gray-200 p-3 rounded-l-md"></i>
                            </div>
                        </div>
                        <div class="text-sm text-red-600 font-bold py-1 px-2">
                            @error('pf_cat_trans_id')
                                {{ $message }}
                            @enderror
                        </div>
                    @else
                        <!-- Still No Categories created -->                        
                        <div class="flex flex-col sm:flex-row justify-start items-start gap-2">
                            <div class="text-md text-red-600 font-bold p-2 bg-red-200 rounded-md w-full">
                                {{ __('admin/portfolio/portfolio.noCategoriesMessage') }}
                            </div>
                            <button
                                class="bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-sm shadow-none transition duration-500 ease-in-out w-full sm:w-fit">
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
                                <i class="fa-solid fa-folder-tree bg-gray-200 p-3 rounded-l-md"></i>
                            </div>
                        </div>
                        <div class="text-sm text-red-600 font-bold py-1 px-2">
                            @error('pf_type_trans_id')
                                {{ $message }}
                            @enderror
                        </div>
                    @else
                        <!-- Still No Types created -->                        
                        <div class="flex flex-col sm:flex-row justify-start items-start gap-2">
                            <div class="text-md text-red-600 font-bold p-2 bg-red-200 rounded-md w-full">
                                {{ __('admin/portfolio/portfolio.noTypesMessage') }}
                            </div>
                            <button
                                class="bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-sm shadow-none transition duration-500 ease-in-out w-full sm:w-fit">
                                <a href="{{ route('pf_types') }}">
                                    {{ __('generic.types') }}
                                </a>
                            </button>                
                        </div>
                    @endif

                    <!-- Tags -->
                    <h2 class="text-lg font-bold capitalize pt-2 pb-1 px-2">{{ __('generic.tags') }} <span
                            class="text-red-600">*</span></h2>
                    @if ($tags->count() > 0)
                        <div class="relative">
                            <select wire:model.live="selectedTags" name="selectedTags" id="selectedTags" multiple
                                class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}" class="text-green-600"
                                        @if (old('selectedTags') == $tag->id) selected @endif>{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                                <i class="fa-solid fa-tag bg-gray-200 p-3 rounded-l-md"></i>
                            </div>
                        </div>
                        <div class="text-sm text-red-600 font-bold py-1 px-2">
                            @error('selectedTags')
                                {{ $message }}
                            @enderror
                        </div>
                    @else
                        <!-- Still No Tags created -->
                        <div class="flex flex-col sm:flex-row justify-start items-start gap-2">
                            <div class="text-md text-red-600 font-bold p-2 bg-red-200 rounded-md w-full">
                                {{ __('admin/portfolio/portfolio.noTagsMessage') }}
                            </div>
                            <button
                                class="bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-sm shadow-none transition duration-500 ease-in-out w-full sm:w-fit">
                                <a href="{{ route('pf_tags') }}">
                                    {{ __('generic.tags') }}
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
                            <i class="fa-solid fa-pencil  bg-gray-200 p-3 rounded-l-md"></i>
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
                            <i class="fa-solid fa-pencil  bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    <div class="text-sm text-red-600 font-bold py-1 px-2">
                        @error('subtitle')
                            {{ $message }}
                        @enderror
                    </div>

                    <!-- Content -->
                    <div class="flex flex-col justify-start items-start w-full gap-4 py-1">
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
                    <h2 class="text-lg font-bold capitalize pt-2 pb-1 px-2">{{ __('generic.year') }}</h2>

                    <div class="relative">
                        <input wire:model="year" name="year" id="year" type="number"
                            value="{{ old('year') }}" maxlength="200"
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">

                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-calendar-days bg-gray-200 p-3 rounded-l-md"></i>
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
                            <i class="fa-solid fa-location-dot  bg-gray-200 p-3 rounded-l-md"></i>
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
                            <i class="fa-solid fa-helmet-safety  bg-gray-200 p-3 rounded-l-md"></i>
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
                            <i class="fa-solid fa-wrench  bg-gray-200 p-3 rounded-l-md"></i>
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
                        </button>
                    </div>

                </form>
        </div>
            @else
                <div class="flex flex-row justify-between items-center gap-4 bg-red-600 p-4 my-4 rounded-md">
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


    </div>

        <!-- Footer -->
        <div
            class="flex flex-row justify-between items-center text-white text-center p-4 {{ $bgMenuColor }} sm:rounded-b-lg">
            <div class="w-1/3 text-left"><a href="{{ route('portfolios.show', $portfolio) }}">
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
