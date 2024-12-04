<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">
    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500">
        <a href="/pf_types" class="text-black {{$textMenuHeader}}">PortFolio Types</a> /
        <a href="/pf_types/{{ $type->id }}" class="font-bold text-black {{$underlineMenuHeader}}">Info</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <!-- HEADER -->
        <div class="flex flex-row justify-between items-center py-4 {{$bgMenuColor}}">
            <div>
                <span class="text-lg text-white px-4">Portfolio Type - {{ $type->name }}</span>
            </div>
        </div>

        <!-- INFO -->
        <div class="flex flex-col mt-4 mx-8 pb-0 lg:mx-14">
            <!-- Type -->
            <div class="flex flex-col">
                <div class="w-fit bg-black text-white text-lg capitalize mb-1 p-2">
                    Information
                </div>
                <div class="flex flex-col text-white bg-slate-800">
                <span class="bg-orange-600 py-1 px-2">Id</span>
                <span class="text-sm p-2">{{ $type->id }}</span>
                <span class="bg-orange-600 py-1 px-2">Name</span>
                <span class="font-bold p-2">{{ $type->name }}</span>
                <span class="bg-orange-600 py-1 px-2">Description</span>
                <span class="text-sm p-2">{{ ($type->description) ? $type->description : '-' }}</span>
                </div>
            </div>
            <!-- Actions -->
            <div class="flex flex-row justify-between sm:justify-start gap-4 px-0 py-2">
                <!-- Edit -->
                <button
                    class="bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-sm shadow-none transition duration-500 ease-in-out">
                    <a href="{{ route('pf_types.edit', $type) }}">
                        Edit
                        <i class="fa-solid fa-pen-to-square text-blue-800 px-1"></i>
                    </a>
                </button>
                <!-- Delete -->
                <form action="{{ route('pf_types.destroy', $type) }}" method="POST">
                    <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                    @csrf
                    <!-- Dirtective to Override the http method -->
                    @method('DELETE')
                    <button
                        class="bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-sm shadow-none transition duration-500 ease-in-out"
                        onclick="return confirm('Are you sure you want to delete the type: {{ $type->name }}?')">
                        Delete
                        <i class="fa-solid fa-trash px-1 text-red-600" title="Delete"></i>
                    </button>
                </form>
            </div>
        </div>


        <!-- Translations -->
        <div class="flex flex-col mt-4 mx-8 pb-0 lg:mx-14">
            <div class="flex flex-col text-white bg-slate-800 p-0">
                <div class="uppercase bg-orange-600 p-2">Translations
                    ({{ $type->translations->count() }}/{{ $languages->count() }})
                </div>
                
                    @if ($type->translations->count() >= $languages->count())
                        <div class="text-green-600 font-bold bg-green-100 p-2">All Translations are done</div>
                    @else
                        <div class="text-red-600 font-bold bg-red-100 p-2">{{$missingTranslations->count()}} 
                            Missing Translation{{$missingTranslations->count() > 1 ? 's' : ''}} >
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

                    <table class="table-auto w-full border text-sm">
                        <thead class="text-sm text-center text-white bg-orange-600">
                            <th class="p-2">Translation</th>
                            <th class="p-2 max-sm:hidden">Language</th>
                            <th class="p-2">Code</th>
                            <th class="p-2 max-sm:hidden">Created</th>
                            <th class="p-2 max-sm:hidden">Updated</th>
                            <th></th>
                        </thead>

                        @foreach ($type->translations as $translation)
                            <tr class="bg-white border-b text-center">
                                <td class="p-2">
                                    {{ $translation->name }}
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
                                        <!-- Edit -->
                                        <a href="{{ route('pf_types_trans.edit', $translation) }}" title="Edit">
                                            <i
                                                class="fa-solid fa-pen-to-square text-blue-800 hover:text-black transition duration-1000 ease-in-out"></i>
                                        </a>
                                        <!-- Delete -->
                                        <form action="{{ route('pf_types_trans.destroy', $translation) }}"
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

                        <!-- Check Missing Translations -->
                        @foreach ($missingTranslations as $missing)
                            <tr class="bg-white text-red-600 border-b text-center">
                                <td class="p-2 bg-red-100 text-red-600">Pending</td>
                                <td class="p-2 bg-red-100 max-sm:hidden">{{ $missing->name }}</td>
                                <td class="p-2 bg-red-100">{{ $missing->code }}</td>
                                <td class="p-2 bg-red-100 max-sm:hidden">-</td>
                                <td class="p-2 bg-red-100 max-sm:hidden">-</td>
                                <td class="p-2 bg-red-100">
                                    <a href="{{ route('pf_types_trans.create', ['type' => $type, 'missingTranslationId' => $missing->id]) }}"
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

        <!-- Footer -->
        <div class="flex flex-row justify-end items-center py-4 px-4 {{$bgMenuColor}} sm:rounded-b-lg">
            <a href="{{ route('pf_types') }}">
                <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out"
                    title="Go Back"></i>
            </a>
        </div>

    </div>

</div>
