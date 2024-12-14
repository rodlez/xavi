<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">

    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500 capitalize">
        <a href="/portfolios" class="{{ $textMenuHeader }}">{{ __('admin/portfolio/portfolio.menuIndex') }}</a> /
        <a href="/portfolios/{{ $translation->portfolio->id }}"
            class="{{ $textMenuHeader }}">{{ $translation->portfolio->name }}</a> /
        <a href="/portfolios_trans/{{ $translation->id }}"
            class="font-bold text-black {{ $underlineMenuHeader }}">{{ __('generic.info') }}
            {{ __('generic.translation') }} ({{ $translation->language->code }})</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <!-- HEADER -->
        <div class="flex flex-row justify-between items-center py-4 {{ $bgMenuColor }}">
            <span class="text-lg text-white px-4 capitalize">{{ __('generic.portfolio') }}
                {{ __('generic.translation') }}</span>
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
                            <a href="{{ route('portfolios.edit', $translation->portfolio) }}">
                                {{ __('generic.edit') }}
                            </a>
                        </div>
                        <!-- Delete Portfolio -->
                        <div class="w-fit bg-red-600 text-white text-lg rounded-t-md capitalize mb-0 p-2">
                            <form action="{{ route('portfolios.destroy', $translation->portfolio) }}" method="POST">
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
                    <span class="p-2">{{ $translation->portfolio->id }}</span>
                    <span class="{{ $menuInfo }} p-2">{{ __('generic.user') }}</span>
                    <span class="p-2">{{ $translation->portfolio->user->name }}</span>
                    <span class="{{ $menuInfo }} p-2">{{ __('generic.published') }}</span>
                    <span
                        class="p-2 {{ $translation->portfolio->published ? 'bg-green-200' : 'bg-red-200' }}">{{ publishedText($translation->portfolio->published) }}</span>
                    <span class="{{ $menuInfo }} p-2">{{ __('generic.status') }}</span>
                    <span class="p-2">{{ statusText($translation->portfolio->status) }}</span>
                    <span class="{{ $menuInfo }} p-2">{{ __('generic.name') }}</span>
                    <span class="p-2 {{ $portfolioName }}">{{ $translation->portfolio->name }}</span>
                    <span class="{{ $menuInfo }} p-2">{{ __('generic.description') }}</span>
                    <span
                        class="p-2 normal-case">{{ $translation->portfolio->description ? $translation->portfolio->description : '-' }}</span>
                </div>

                <!-- Big Actions Buttons in SMALL SCREENS -->
                <div class="flex flex-col sm:hidden justify-start gap-1 py-2">
                    <!-- Edit -->
                    <button
                        class="bg-blue-600 hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-md shadow-none transition duration-500 ease-in-out w-full sm:w-fit">
                        <a href="{{ route('portfolios.edit', $translation->portfolio) }}">
                            {{ __('generic.edit') }}
                        </a>
                    </button>
                    <!-- Delete -->
                    <form action="{{ route('portfolios.destroy', $translation->portfolio) }}" method="POST">
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

            <!-- Show TRANSLATION -->
            <div class="flex flex-col capitalize my-8">

                <div class="flex flex-row justify-between bg-white">
                    <!-- Info Portfolio Translation -->
                    <div
                        class="flex w-full sm:w-fit {{ $bgTranslationTab }} text-white font-light uppercase rounded-t-md p-2">
                        {{ __('generic.translation') }}
                    </div>
                    <!-- File Tabs / Visible only in Larger Screens -->
                    <div class="flex flex-row gap-1 max-sm:hidden">
                        <!-- Edit Portfolio -->
                        <div class="w-fit bg-blue-600 text-white text-lg rounded-t-md capitalize mb-0 p-2">
                            <a href="{{ route('portfolios_trans.edit', $translation) }}">
                                {{ __('generic.edit') }}
                            </a>
                        </div>
                        <!-- Delete Portfolio -->
                        <div class="w-fit bg-red-600 text-white text-lg rounded-t-md capitalize mb-0 p-2">
                            <form action="{{ route('portfolios_trans.destroy', $translation) }}" method="POST">
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

                <div class="bg-gray-100 px-2 pb-8 rounded-b-lg">

                    <!-- Language -->
                    <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.language') }}</h2>

                    <div class="relative">
                        <input placeholder="{{ $translation->language->name }}" readonly disabled
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-language  bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    <!-- Category -->
                    <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.category') }}</h2>

                    <div class="relative">
                        <input placeholder="{{ $translation->category->name }}" readonly disabled
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-list  bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    <!-- Type -->
                    <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.type') }}</h2>

                    <div class="relative">
                        <input placeholder="{{ $translation->type->name }}" readonly disabled
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-folder-tree  bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    <!-- Tags -->
                    <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.tags') }}</h2>

                    <div class="relative">
                        @foreach ($translation->tags as $tag)
                            <input placeholder="{{ $tag->name }}" readonly disabled
                                class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                            <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                                <i class="fa-solid fa-tag  bg-gray-200 p-3 rounded-l-md"></i>
                            </div>
                        @endforeach
                    </div>

                    <!-- Title -->
                    <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.title') }}</h2>

                    <div class="relative">
                        <input placeholder="{{ $translation->title }}" readonly disabled
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-pencil  bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    <!-- SubTitle -->
                    <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.subtitle') }}</h2>

                    <div class="relative">
                        <input placeholder="{{ $translation->subtitle }}" readonly disabled
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-pencil  bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex flex-col justify-start items-start w-full sm:w-2/3 gap-4 py-2">
                        <span class="text-lg font-semibold capitalize px-2">{{ __('generic.content') }}</span>
                        <textarea class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg w-full p-2 {{ $focusColor }}"
                            readonly disabled>{{ $translation->content }}</textarea>
                    </div>

                    <!-- Year -->
                    <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.year') }}</h2>

                    <div class="relative">
                        <input placeholder="{{ $translation->year }}" readonly disabled
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-calendar-days  bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    <!-- Location -->
                    <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.location') }}</h2>

                    <div class="relative">
                        <input placeholder="{{ $translation->location }}" readonly disabled
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-location-dot  bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    <!-- Client -->
                    <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.client') }}</h2>

                    <div class="relative">
                        <input placeholder="{{ $translation->client }}" readonly disabled
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-helmet-safety  bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    <!-- Project -->
                    <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.project') }}</h2>

                    <div class="relative">
                        <input placeholder="{{ $translation->project }}" readonly disabled
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-wrench  bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                </div>

                <!-- Big Actions Buttons in SMALL SCREENS -->
                <div class="flex flex-col sm:hidden justify-start gap-2 mt-4">
                    <!-- Edit -->
                    <button
                        class="bg-blue-600 hover:bg-slate-700 text-white capitalize p-2 rounded-md shadow-none transition duration-500 ease-in-out w-full sm:w-fit">
                        <a href="{{ route('portfolios_trans.edit', $translation) }}">
                            {{ __('generic.edit') }}
                        </a>
                    </button>
                    <!-- Delete -->
                    <form action="{{ route('portfolios_trans.destroy', $translation) }}" method="POST">
                        <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                        @csrf
                        <!-- Directive to Override the http method -->
                        @method('DELETE')
                        <button
                            class="bg-red-600 hover:bg-slate-700 text-white capitalize p-2 rounded-md shadow-none transition duration-500 ease-in-out w-full sm:w-fit"
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
            <div class="w-1/3 text-left"><a href="{{ route('portfolios.show', $translation->portfolio) }}">
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
