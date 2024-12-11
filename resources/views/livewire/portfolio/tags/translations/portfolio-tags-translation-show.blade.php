<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">

    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500 capitalize">
        <a href="/pf_tags" class="{{ $textMenuHeader }}">{{ __('admin/portfolio/portfolioTags.menuIndex') }}</a> /
        <a href="/pf_tags/{{ $translation->tag->id }}" class="{{ $textMenuHeader }}">{{ $translation->tag->name }}</a> /
        <a href="/pf_tags_trans/{{ $translation->id }}"
            class="font-bold text-black {{ $underlineMenuHeader }}">{{ __('generic.info') }}
            {{ __('generic.translation') }} ({{ $translation->language->code }})</a>
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
                    <span class="p-2">{{ $translation->tag->id }}</span>
                    <span class="{{ $menuInfo }} p-2">{{ __('generic.tag') }}</span>
                    <span class="{{$tagName}} p-2">{{ $translation->tag->name }}</span>
                    <span class="{{ $menuInfo }} p-2">{{ __('generic.description') }}</span>
                    <span
                        class="text-sm p-2">{{ $translation->tag->description ? $translation->tag->description : '-' }}</span>
                </div>

            </div>

            <!-- SHOW TRANSLATION -->
            <div class="flex flex-col capitalize my-8">

                <div class="flex flex-row justify-between">
                    <div class="w-fit {{$bgTranslationTab}} text-white text-lg rounded-t-md capitalize mb-0 p-2">
                        {{ __('generic.translation') }}
                    </div>
                    <!-- File Tabs / Visible only in Larger Screens -->
                    <div class="flex flex-row gap-1 max-sm:hidden">
                        <!-- Edit Tag -->
                        <div class="w-fit bg-blue-600 text-white text-lg rounded-t-md capitalize mb-0 p-2">
                            <a href="{{ route('pf_tags_trans.edit', $translation) }}">
                                {{ __('generic.edit') }}
                            </a>
                        </div>
                        <!-- Delete Tag -->
                        <div class="w-fit bg-red-600 text-white text-lg rounded-t-md capitalize mb-0 p-2">
                            <form action="{{ route('pf_tags_trans.destroy', $translation) }}" method="POST">
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
                <div class="flex flex-col text-black bg-gray-200">
                    <span class="{{ $menuTranslation }} p-2">Id</span>
                    <span class="p-2">{{ $translation->id }}</span>
                    <span class="{{ $menuTranslation }} p-2">{{ __('generic.language') }}</span>
                    <span class="{{$translationName}} p-2">{{ $translation->language->name }}</span>
                    <span class="{{ $menuTranslation }} p-2">{{ __('generic.translation') }}</span>
                    <span class="{{$translationName}} p-2">{{ $translation->name }}</span>
                </div>

                <!-- Big Actions Buttons in SMALL SCREENS -->
                <div class="flex flex-col sm:hidden justify-start gap-1 py-2">
                    <!-- Edit -->
                    <button
                        class="bg-blue-600 hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-md shadow-none transition duration-500 ease-in-out w-full sm:w-fit">
                        <a href="{{ route('pf_tags_trans.edit', $translation) }}">
                            {{ __('generic.edit') }}
                        </a>
                    </button>
                    <!-- Delete -->
                    <form action="{{ route('pf_tags_trans.destroy', $translation) }}" method="POST">
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

        </div>

        <!-- Footer -->
        <div class="flex flex-row justify-end items-center py-4 px-4 {{ $bgMenuColor }} sm:rounded-b-lg">
            <a href="{{ route('pf_tags.show', $translation->tag) }}">
                <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out"
                    title="{{ __('generic.back') }}"></i>
            </a>
        </div>

    </div>

</div>
