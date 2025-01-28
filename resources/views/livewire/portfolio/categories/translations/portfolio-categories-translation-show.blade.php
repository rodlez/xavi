<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">

    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500 capitalize">
        <a href="{{route('pf_categories')}}" class="{{ $textMenuHeader }}">{{ __('admin/portfolio/portfolioCategories.menuIndex') }}</a> /
        <a href="{{route('pf_categories.show', $translation->category)}}" class="{{ $textMenuHeader }}">{{ $translation->category->name }}</a> /
        <a href="{{route('pf_categories_trans.show', $translation)}}"
            class="font-bold text-black {{ $underlineMenuHeader }}">{{ __('generic.info') }}
            {{ __('generic.translation') }} ({{ $translation->language->code }})</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <!-- HEADER -->
        <div class="flex flex-row py-4 {{ $bgMenuColor }}">
                <span class="text-lg text-white px-4 capitalize">{{ __('generic.portfolio') }} {{ __('generic.category') }}
                    {{ __('generic.translation') }}</span>
        </div>

        <div class="mx-auto w-11/12 my-4 px-2">

            <!-- ORIGINAL CATEGORY INFORMATION -->
            <div class="flex flex-col">

                <div class="flex flex-row justify-between">
                    <div class="flex w-full sm:w-fit {{ $bgInfoTab }} text-white font-light uppercase rounded-t-md p-2">
                        {{ __('generic.category') }}
                    </div>
                </div>
                <!-- Info Category -->
                <div class="flex flex-col text-black capitalize bg-slate-200 rounded-b-lg sm:rounded-tr-lg">
                    <span class="{{ $menuInfo }} p-2 sm:rounded-tr-lg">Id</span>
                    <span class="p-2">{{ $translation->category->id }}</span>
                    <span class="{{ $menuInfo }} p-2">{{ __('generic.name') }}</span>
                    <span class="{{$categoryName}} p-2">{{ $translation->category->name }}</span>
                    <span class="{{ $menuInfo }} p-2">{{ __('generic.description') }}</span>
                    <span class="text-sm normal-case p-2">{{ $translation->category->description ? $translation->category->description : '-' }}</span>
                </div>

            </div>

            <!-- SHOW TRANSLATION -->
            <div class="flex flex-col capitalize my-8">

                <div class="flex flex-row justify-between">
                    <!-- Info Category Translation -->
                    <div class="flex w-full sm:w-fit {{ $bgTranslationTab }} text-white font-light uppercase rounded-t-md p-2">
                        {{ __('generic.translation') }}
                    </div>
                    <!-- File Tabs / Visible only in Larger Screens -->
                    <div class="flex flex-row gap-1 max-sm:hidden">
                        <!-- Edit Category -->
                        <div class="w-fit bg-blue-600 text-white text-lg rounded-t-md capitalize mb-0 p-2">
                            <a href="{{ route('pf_categories_trans.edit', $translation) }}">
                                {{ __('generic.edit') }}
                            </a>
                        </div>
                        <!-- Delete Category -->
                        <div class="w-fit bg-red-600 text-white text-lg rounded-t-md capitalize mb-0 p-2">
                            <form action="{{ route('pf_categories_trans.destroy', $translation) }}" method="POST">
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
                <!-- Info Translation -->
                <div class="flex flex-col text-black capitalize bg-gray-200 rounded-b-lg">
                    <span class="{{ $menuTranslation }} p-2">Id</span>
                    <span class="p-2">{{ $translation->id }}</span>
                    <span class="{{ $menuTranslation }} p-2">{{ __('generic.language') }}</span>
                    <span class="{{$translationName}} p-2">{{ $translation->language->name }}</span>
                    <span class="{{ $menuTranslation }} p-2">{{ __('generic.translation') }}</span>
                    <span class="{{$translationName}} p-2 sm:rounded-b-lg">{{ $translation->name }}</span>
                </div>

                <!-- Big Actions Buttons in SMALL SCREENS -->
                <div class="flex flex-col sm:hidden justify-start gap-2 mt-4">
                    <!-- Edit -->
                    <button
                        class="bg-blue-600 hover:bg-slate-700 text-white uppercase p-2 rounded-md shadow-none transition duration-500 ease-in-out w-full sm:w-fit">
                        <a href="{{ route('pf_categories_trans.edit', $translation) }}">
                            {{ __('generic.edit') }}
                        </a>
                    </button>
                    <!-- Delete -->
                    <form action="{{ route('pf_categories_trans.destroy', $translation) }}" method="POST">
                        <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                        @csrf
                        <!-- Directive to Override the http method -->
                        @method('DELETE')
                        <button
                            class="bg-red-600 hover:bg-slate-700 text-white uppercase p-2 rounded-md shadow-none transition duration-500 ease-in-out w-full sm:w-fit"
                            onclick="return confirm('{{ __('generic.confirmDelete') }}')">
                            {{ __('generic.delete') }}
                        </button>
                    </form>
                </div>

            </div>

        </div>
        
        <!-- Footer -->
        <div
            class="flex flex-row justify-between items-center text-white text-center p-4 {{ $bgMenuColor }} sm:rounded-b-lg">
            <div class="w-1/3 text-left"><a href="{{ route('pf_categories.show', $translation->category) }}">
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

