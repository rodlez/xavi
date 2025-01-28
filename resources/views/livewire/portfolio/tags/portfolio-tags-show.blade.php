<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">

    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500 capitalize">
        <a href="{{route('pf_tags')}}"
            class="text-black {{ $textMenuHeader }}">{{ __('admin/portfolio/portfolioTags.menuIndex') }}</a> /
        <a href="{{route('pf_tags.show', $tag)}}"
            class="font-bold text-black {{ $underlineMenuHeader }}">{{ $tag->name }}</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <!-- HEADER -->
        <div class="flex flex-row justify-start items-center py-4 {{ $bgMenuColor }}">
            <span class="text-lg text-white capitalize px-4">{{ __('generic.portfolio') }} {{ __('generic.tag') }}</span>
        </div>

        <div class="mx-auto w-11/12 my-4 px-2">

            <!-- ORIGINAL TAG INFORMATION -->
            <div class="flex flex-col capitalize">

                <div class="flex flex-row justify-between">
                    <div class="w-fit {{ $bgInfoTab }} text-white text-lg rounded-t-md capitalize mb-0 p-2">
                        {{ __('generic.tag') }}
                    </div>
                    <!-- File Tabs / Visible only in Larger Screens -->
                    <div class="flex flex-row gap-1 max-sm:hidden">
                        <!-- Edit Tag -->
                        <div class="w-fit bg-blue-600 text-white text-lg rounded-t-md capitalize mb-0 p-2">
                            <a href="{{ route('pf_tags.edit', $tag) }}">
                                {{ __('generic.edit') }}
                            </a>
                        </div>
                        <!-- Delete Tag -->
                        <div class="w-fit bg-red-600 text-white text-lg rounded-t-md capitalize mb-0 p-2">
                            <form action="{{ route('pf_tags.destroy', $tag) }}" method="POST">
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
                <!-- Info Tag -->
                <div class="flex flex-col text-black bg-gray-100">
                    <span class="{{ $menuInfo }} p-2">Id</span>
                    <span class="p-2">{{ $tag->id }}</span>
                    <span class="{{ $menuInfo }} p-2">{{ __('generic.name') }}</span>
                    <span class="{{$tagName}} p-2">{{ $tag->name }}</span>
                    <span class="{{ $menuInfo }} p-2">{{ __('generic.description') }}</span>
                    <span class="p-2 normal-case">{{ $tag->description ? $tag->description : '-' }}</span>
                </div>

                <!-- Big Actions Buttons in SMALL SCREENS -->
                <div class="flex flex-col sm:hidden justify-start gap-1 py-2">
                    <!-- Edit -->
                    <button
                        class="bg-blue-600 hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-md shadow-none transition duration-500 ease-in-out w-full sm:w-fit">
                        <a href="{{ route('pf_tags.edit', $tag) }}">
                            {{ __('generic.edit') }}
                        </a>
                    </button>
                    <!-- Delete -->
                    <form action="{{ route('pf_tags.destroy', $tag) }}" method="POST">
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

            <!-- Check for Languges in the App -->
            @if ($languages->count() > 0)

                <!-- Translations -->
                <div class="flex flex-col my-8">

                    <!-- Translations Text / Number of Translations and Pending Translations -->
                    <div class="mb-2">

                        <div class="w-fit {{ $bgTranslationTab }} text-white text-lg rounded-t-md capitalize mb-0 p-2">
                            {{ __('generic.translations') }}
                            ({{ $tag->translations->count() }}/{{ $languages->count() }})
                        </div>       

                        @if ($tag->translations->count() == $languages->count())
                            <div class="flex justify-start items-center font-bold bg-gray-100 p-2 gap-2">{{ __('generic.doneTranslations') }}
                                <i class="fa-solid fa-check text-green-600"></i>
                            </div>
                        @else
                            <div class="text-red-600 font-bold bg-gray-100 p-2">{{ $missingTranslations->count() }}
                                {{ $missingTranslations->count() > 1 ? __('generic.missingTranslations') : __('generic.missingTranslation') }}                                
                            </div>
                        @endif

                    </div>

                    <!-- Translations Table -->
                    <div class="w-full overflow-x-auto">

                        <table class="table-auto w-full border text-sm capitalize">
                            <thead class="text-sm text-center text-white {{ $bgTranslationTab }}">
                                <th class="p-2">{{ __('generic.translation') }}</th>
                                <th class="p-2 max-lg:hidden">{{ __('generic.language') }}</th>
                                <th class="p-2">{{ __('generic.code') }}</th>
                                <th class="p-2 max-sm:hidden">{{ __('generic.created') }}</th>
                                <th class="p-2 max-sm:hidden">{{ __('generic.updated') }}</th>
                                <th></th>
                            </thead>

                            @foreach ($tag->translations as $translation)
                                <tr class="bg-green-200 border-b text-center">
                                    <td class="p-2">{{ $translation->name }}</td>
                                    <td class="p-2 max-lg:hidden">{{ $translation->language->name }}</td>
                                    <td class="p-2">{{ $translation->language->code }}</td>
                                    <td class="p-2 max-sm:hidden">{{ $translation->created_at->format('d-m-Y') }}</td>
                                    <td class="p-2 max-sm:hidden">{{ $translation->updated_at->format('d-m-Y') }}</td>
                                    <td class="p-2">
                                        <div class="flex justify-center items-center gap-2">
                                            <!-- Show -->
                                            <a href="{{ route('pf_tags_trans.show', $translation) }}">
                                                <i class="fa-solid fa-circle-info text-blue-600 hover:text-black transition duration-1000 ease-in-out"></i>
                                            </a>
                                            <!-- Edit -->
                                            <a href="{{ route('pf_tags_trans.edit', $translation) }}"
                                                title="{{ __('generic.edit') }}">
                                                <i class="fa-solid fa-pen-to-square text-blue-800 hover:text-black transition duration-1000 ease-in-out"></i>
                                            </a>
                                            <!-- Delete -->
                                            <form action="{{ route('pf_tags_trans.destroy', $translation) }}"
                                                method="POST">
                                                <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                                                @csrf
                                                <!-- Directive to Override the http method -->
                                                @method('DELETE')
                                                <button onclick="return confirm('{{ __('generic.confirmDelete') }}')"
                                                    title="{{ __('generic.delete') }}">
                                                    <i class="fa-solid fa-trash text-red-600 hover:text-black transition duration-1000 ease-in-out"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            <!-- Check Missing Translations -->
                            @foreach ($missingTranslations as $missing)
                            
                                <tr class="bg-red-200 text-red-600 border-b text-center">                                    
                                    <td class="p-2 font-bold">{{ __('generic.pending') }}</td>
                                    <td class="p-2 max-lg:hidden">{{ $missing->name }}</td>
                                    <td class="p-2">{{ $missing->code }}</td>
                                    <td class="p-2 max-sm:hidden">-</td>
                                    <td class="p-2 max-sm:hidden">-</td>
                                    <td class="p-2">
                                        <a href="{{ route('pf_tags_trans.create', ['tag' => $tag, 'missingTranslationId' => $missing->id]) }}"
                                            title="New Translation">
                                            <i class="fa-solid fa-circle-plus text-green-600 hover:text-green-400 transition duration-1000 ease-in-out"></i>
                                        </a>
                                    </td>                                
                                </tr>
                            
                            @endforeach

                        </table>

                    </div>

                </div>
            @else
                <!-- Still No Languages created -->
                <div class="flex flex-col sm:flex-row justify-start items-start gap-2 my-4 mx-8 lg:mx-14">
                    <div class="text-md text-red-600 font-bold p-2 bg-red-200 rounded-md w-full">
                        {{ __('generic.noLanguages') }}
                    </div>
                    <button
                        class="bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-sm shadow-none transition duration-500 ease-in-out w-full sm:w-fit">
                        <a href="{{ route('languages') }}">
                            {{ __('generic.languages') }}
                        </a>
                    </button>
                </div>
            @endif

        </div>              

        <!-- FOOTER -->
        <div
            class="flex flex-row justify-between items-center text-white text-center p-4 {{ $bgMenuColor }} sm:rounded-b-lg">
            <div class="w-1/3 text-left"><a href="{{ route('pf_tags') }}">
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
