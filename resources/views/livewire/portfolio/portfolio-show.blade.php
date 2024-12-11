<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">
    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500 capitalize">
        <a href="/portfolios" class="text-black {{ $textMenuHeader }}">{{ __('admin/portfolio/portfolio.menuIndex') }}</a>
        /
        <a href="/portfolios/{{ $portfolio->id }}"
            class="font-bold text-black {{ $underlineMenuHeader }}">{{ __('generic.info') }}</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <!-- HEADER -->
        <div class="flex flex-row justify-between items-center py-4 {{ $bgMenuColor }}">
            <div>
                <span class="text-lg text-white capitalize px-4">{{ __('admin/portfolio/portfolio.titleHeader') }} -
                    {{ $portfolio->name }}</span>
            </div>
        </div>

        <!-- INFO -->
        <div class="flex flex-col mt-4 mx-8 pb-0 lg:mx-14">
            <!-- Portfolio -->
            <div class="flex flex-col capitalize">
                <div class="w-fit bg-black text-white text-lg capitalize mb-1 p-2">
                    {{ __('generic.info') }}
                </div>
                <div class="flex flex-col text-white bg-slate-800">
                    <span class="bg-orange-600 py-1 px-2">Id</span>
                    <span class="text-sm p-2">{{ $portfolio->id }}</span>
                    <span class="bg-orange-600 py-1 px-2">{{ __('generic.published') }}</span>
                    <span class="text-sm p-2">{{ publishedText($portfolio->published) }}</span>
                    <span class="bg-orange-600 py-1 px-2">{{ __('generic.status') }}</span>
                    <span class="text-sm p-2">{{ statusText($portfolio->status) }}</span>
                    <span class="bg-orange-600 py-1 px-2">{{ __('generic.name') }}</span>
                    <span class="font-bold p-2">{{ $portfolio->name }}</span>
                    <span class="bg-orange-600 py-1 px-2">{{ __('generic.description') }}</span>
                    <span class="text-sm p-2">{{ $portfolio->description ? $portfolio->description : '-' }}</span>
                </div>
            </div>
            <!-- Actions -->
            <div class="flex flex-row justify-between sm:justify-start gap-4 px-0 py-2">
                <!-- Edit -->
                <button
                    class="bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-sm shadow-none transition duration-500 ease-in-out">
                    <a href="{{ route('portfolios.edit', $portfolio) }}">
                        {{ __('generic.edit') }}
                        <i class="fa-solid fa-pen-to-square text-blue-800 px-1"></i>
                    </a>
                </button>
                <!-- Delete -->
                <form action="{{ route('portfolios.destroy', $portfolio) }}" method="POST">
                    <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                    @csrf
                    <!-- Directive to Override the http method -->
                    @method('DELETE')
                    <button
                        class="bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-sm shadow-none transition duration-500 ease-in-out"
                        onclick="return confirm('{{ __('generic.confirmDelete') }}')">
                        {{ __('generic.delete') }}
                        <i class="fa-solid fa-trash px-1 text-red-600"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Check for Languges in the App -->
        @if ($languages->count() != 0)

            <!-- Translations -->
            <div class="flex flex-col mt-4 mx-8 pb-0 lg:mx-14">
                <div class="flex flex-col text-white bg-slate-800 p-0">
                    <div class="uppercase bg-orange-600 p-2">{{ __('generic.translations') }}
                        ({{ $portfolio->translations->count() }}/{{ $languages->count() }})
                    </div>

                    @if ($portfolio->translations->count() >= $languages->count())
                        <div class="text-green-600 font-bold bg-green-100 p-2">{{ __('generic.doneTranslations') }}
                        </div>
                    @else
                        <div class="text-red-600 font-bold bg-red-100 p-2">{{ $missingTranslations->count() }}
                            {{ $missingTranslations->count() > 1 ? __('generic.missingTranslations') : __('generic.missingTranslation') }}
                            >
                            <span>
                                @foreach ($missingTranslations as $missing)
                                    {{ $missing->name }}
                                @endforeach
                            </span>
                        </div>
                    @endif

                </div>

                <div class="flex flex-col sm:flex-row my-6 px-0 gap-1">

                    <!-- Translations Table -->
                    <div class="w-full overflow-x-auto">

                        <table class="table-auto w-full border text-sm capitalize">
                            <thead class="text-sm text-center text-white bg-orange-600">
                                <th class="p-2">{{ __('generic.translation') }}</th>
                                <th class="p-2 max-sm:hidden">{{ __('generic.language') }}</th>
                                <th class="p-2">{{ __('generic.code') }}</th>
                                <th class="p-2 max-sm:hidden">{{ __('generic.created') }}</th>
                                <th class="p-2 max-sm:hidden">{{ __('generic.updated') }}</th>
                                <th></th>
                            </thead>

                            @foreach ($portfolio->translations as $translation)
                                <tr class="bg-white border-b text-center">
                                    <td class="p-2">
                                        {{ $translation->title }}
                                    </td>
                                    <td class="p-2 max-lg:hidden">
                                        {{ $translation->language->name }}
                                    </td>
                                    <td class="p-2">
                                        {{ $translation->language->code }}
                                    </td>
                                    <td class="p-2 max-sm:hidden">{{ $translation->created_at->format('d-m-Y') }}
                                    </td>
                                    <td class="p-2 max-sm:hidden">{{ $translation->updated_at->format('d-m-Y') }}
                                    </td>
                                    <td class="p-2">
                                        <div class="flex justify-center items-center gap-2">
                                            <!-- Show -->
                                            <a href="{{ route('portfolios_trans.show', $translation) }}"
                                                title="{{ __('generic.show') }}">
                                                <i
                                                    class="fa-solid fa-eye text-orange-800 hover:text-black transition duration-1000 ease-in-out"></i>
                                            </a>
                                            <!-- Edit -->
                                            <a href="{{ route('portfolios_trans.edit', $translation) }}"
                                                title="{{ __('generic.edit') }}">
                                                <i
                                                    class="fa-solid fa-pen-to-square text-blue-800 hover:text-black transition duration-1000 ease-in-out"></i>
                                            </a>
                                            <!-- Delete -->
                                            <form action="{{ route('portfolios_trans.destroy', $translation) }}"
                                                method="POST">
                                                <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                                                @csrf
                                                <!-- Directive to Override the http method -->
                                                @method('DELETE')
                                                <button onclick="return confirm('{{ __('generic.confirmDelete') }}')"
                                                    title="{{ __('generic.delete') }}">
                                                    <i
                                                        class="fa-solid fa-trash text-red-600 hover:text-black transition duration-1000 ease-in-out"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach

                            <!-- Check Missing Translations -->
                            @foreach ($missingTranslations as $missing)
                                <tr class="bg-white text-red-600 border-b text-center">
                                    <td class="p-2 bg-red-100 text-red-600">{{ __('generic.pending') }}</td>
                                    <td class="p-2 bg-red-100 max-sm:hidden">{{ $missing->name }}</td>
                                    <td class="p-2 bg-red-100">{{ $missing->code }}</td>
                                    <td class="p-2 bg-red-100 max-sm:hidden">-</td>
                                    <td class="p-2 bg-red-100 max-sm:hidden">-</td>
                                    <td class="p-2 bg-red-100">
                                        <a href="{{ route('portfolios_trans.create', ['portfolio' => $portfolio, 'missingTranslationId' => $missing->id]) }}"
                                            title="New Translation">
                                            <i
                                                class="fa-solid fa-circle-plus text-green-600 hover:text-green-400 transition duration-1000 ease-in-out"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </table>

                    </div>
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

        <!-- Footer -->
        <div class="flex flex-row justify-end items-center py-4 px-4 {{ $bgMenuColor }} sm:rounded-b-lg">
            <a href="{{ route('portfolios') }}">
                <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out"
                    title="{{ __('generic.back') }}"></i>
            </a>
        </div>

    </div>

</div>
