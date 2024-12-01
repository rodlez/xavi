<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">
    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500">
        <a href="/pf_categories" class="text-black hover:text-blue-600">Categories</a> /
        <a href="/pf_categories/{{ $category->id }}" class="font-bold text-black border-b-2 border-b-blue-600">Info</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <!-- Header -->
        <div class="flex flex-row justify-between items-center py-4 bg-blue-400">
            <div>
                <span class="text-lg text-white px-4">Category Info</span>
            </div>
        </div>

        <!-- Info -->
        <div class="mx-auto w-11/12 py-4 px-2">
            <div class="flex flex-col justify-start items-left gap-4 py-2">
                <!-- Name -->
                <div><span class="font-semibold px-2">Name</span></div>
                <input type="text" id="name"
                    class="bg-zinc-200 border border-zinc-300 text-gray-900 text-md rounded-lg w-full sm:w-1/2 pl-2 p-2  dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ $category->name }}" disabled>
                <!-- Description -->
                <span class="font-semibold px-2">Description</span>
                <input type="text" id="description"
                    class="bg-zinc-200 border border-zinc-300 text-gray-900 text-md rounded-lg w-full sm:w-1/2 pl-2 p-2  dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ $category->description }}" disabled>
                <div class="flex flex-row gap-4 px-4">
                    <!-- Edit -->
                    <a href="{{ route('pf_categories.edit', $category) }}">
                        <i class="fa-solid fa-pen-to-square text-blue-600 hover:text-black transition duration-1000 ease-in-out"
                            title="Edit"></i>
                    </a>
                    <!-- Delete -->
                    <form action="{{ route('pf_categories.destroy', $category) }}" method="POST">
                        <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                        @csrf
                        <!-- Dirtective to Override the http method -->
                        @method('DELETE')
                        <button
                            onclick="return confirm('Are you sure you want to delete the category: {{ $category->name }}?')">
                            <i class="fa-solid fa-trash text-red-600 hover:text-black transition duration-1000 ease-in-out"
                                title="Delete"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Translations -->
            <div class="flex flex-row justify-start items-center sm:items-start p-2 gap-2 border-t-2 border-t-blue-400">
                <div><span class="sm:text-lg font-bold sm:font-normal sm:w-24">Translations
                        ({{ $category->translations->count() }}/{{ $languages->count() }})</span></div>
                @if ($category->translations->count() >= $languages->count())
                    <span class="text-green-600 font-semibold">All Translations done</span>
                @else
                    <span class="text-red-600 font-semibold">Missing Translations:
                        <span class="uppercase">
                        @foreach ($missingTranslations as $missing)
                        {{$missing->code}}   
                        @endforeach
                        </span>
                    </span>
                @endif
            </div>

            <div class="flex flex-col sm:flex-row py-2 px-3 gap-1">

                <!-- Translations Table -->
                <div class="w-full overflow-x-auto">

                    <table class="table-auto w-full border text-sm">
                        <thead class="text-sm text-center text-white bg-black">
                            <th class="p-2 max-lg:hidden">Translation</th>
                            <th class="p-2 max-sm:hidden">Language</th>
                            <th class="p-2 max-sm:hidden">Code</th>
                            <th class="p-2 max-sm:hidden">Created</th>
                            <th class="p-2 max-sm:hidden">Updated</th>
                            <th></th>
                        </thead>

                        @foreach ($category->translations as $translation)
                            <tr class="bg-white border-b text-center">
                                <td class="p-2">
                                    {{ $translation->name }}
                                </td>
                                <td class="p-2 max-lg:hidden">
                                    {{ $translation->language->name }}
                                </td>
                                <td class="p-2 max-lg:hidden">
                                    {{ $translation->language->code }}
                                </td>
                                <td class="p-2 max-sm:hidden">{{ $translation->created_at->format('d-m-Y') }}
                                </td>
                                <td class="p-2 max-sm:hidden">{{ $translation->updated_at->format('d-m-Y') }}
                                </td>
                                <td class="p-2">
                                    <div class="flex justify-center items-center gap-2">
                                        <!-- Edit -->
                                        <a href="{{ route('pf_categories_trans.edit', $translation) }}" title="Edit">
                                            <i
                                                class="fa-solid fa-pen-to-square text-blue-600 hover:text-black transition duration-1000 ease-in-out"></i>
                                        </a>
                                        <!-- Delete -->
                                        <form action="{{ route('pf_categories_trans.destroy', $translation) }}"
                                            method="POST">
                                            <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                                            @csrf
                                            <!-- Dirtective to Override the http method -->
                                            @method('DELETE')
                                            <button
                                                onclick="return confirm('Are you sure you want to delete the translation: {{ $translation->name }}?')"
                                                title="Delete">
                                                <i
                                                    class="fa-solid fa-trash text-red-600 hover:text-black transition duration-1000 ease-in-out"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach

                        @foreach ($missingTranslations as $missing)
                            <tr class="bg-white border-b text-center">
                                <td class="p-2 bg-gray-300"></td>
                                <td class="p-2 bg-gray-300">{{ $missing->name }}</td>
                                <td class="p-2 bg-gray-300">{{ $missing->code }}</td>
                                <td class="p-2 bg-gray-300"></td>
                                <td class="p-2 bg-gray-300"></td>
                                <td class="p-2 bg-gray-300">
                                    <a href="{{ route('pf_categories_trans.create', $category) }}"
                                        title="New Translation">
                                        <i class="fa-solid fa-circle-plus text-green-600"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </table>

                </div>
            </div>

        </div>

        <!-- Footer -->
        <div class="flex flex-row justify-end items-center py-4 px-4 bg-blue-400 sm:rounded-b-lg">
            <a href="{{ route('pf_categories') }}">
                <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out"
                    title="Go Back"></i>
            </a>
        </div>

    </div>

</div>
