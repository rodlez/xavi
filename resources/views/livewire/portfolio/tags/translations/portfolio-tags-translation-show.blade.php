<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">

    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500 capitalize">
        <a href="/pf_tags/{{ $translation->tag->id }}" class="{{ $textMenuHeader }}">{{ $translation->tag->name }}</a> /
        <a href="/pf_tags_trans/{{ $translation->id }}"
            class="font-bold text-black {{ $underlineMenuHeader }}">{{ __('generic.info') }}</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <!-- HEADER -->
        <div class="flex flex-row justify-between items-center py-4 {{ $bgMenuColor }}">
            <div>
                <span class="text-lg text-white px-4 capitalize">{{ __('generic.edit') }} {{ __('generic.translation') }}
                    ({{ $translation->language->name }})</span>
            </div>
        </div>

        <!-- TAG INFO -->
        <div class="flex flex-col capitalize mt-4 mx-8 pb-0 lg:mx-14">
            <div class="w-fit bg-black text-white text-lg capitalize mb-1 p-2">
                {{ __('generic.info') }}
            </div>
            <div class="flex flex-col text-white bg-slate-800">
                <span class="bg-orange-600 py-1 px-2">Id</span>
                <span class="text-sm p-2">{{ $translation->tag->id }}</span>
                <span class="bg-orange-600 py-1 px-2">{{ __('generic.tag') }}</span>
                <span class="font-bold p-2">{{ $translation->tag->name }}</span>
                <span class="bg-orange-600 py-1 px-2">{{ __('generic.description') }}</span>
                <span
                    class="text-sm p-2">{{ $translation->tag->description ? $translation->tag->description : '-' }}</span>
            </div>
        </div>

        <!-- EDIT TRANSLATION -->
        <div class="mx-auto w-11/12 py-2 px-2">

            <form action="{{ route('pf_tags_trans.update', $translation) }}" method="POST">
                <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                @csrf
                <!-- Dirtective to Override the http method -->
                @method('PUT')

                <div class="italic p-2 rounded-md {{ $bgInfoColor }}">{{ __('generic.editTranslation') }}
                </div>

                <!-- Translations -->
                <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.translations') }}</h2>

                <div class="relative">
                    @foreach ($translation->translations as $trans)
                        <input placeholder="{{ $trans->title }}" readonly disabled
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-folder-tree  bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    @endforeach
                </div>

                <!-- Language -->
                <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.language') }}</h2>

                <div class="relative">
                    <input placeholder="{{ $translation->language->name }}" readonly disabled
                        class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                    <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                        <i class="fa-solid fa-language  bg-gray-200 p-3 rounded-l-md"></i>
                    </div>
                </div>

                <!-- Name -->
                <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.translation') }} <span
                        class="text-red-600">*</span></h2>

                <div class="relative">
                    <input placeholder="{{ $translation->name }}" readonly disabled
                        class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                    <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                        <i class="fa-solid fa-language  bg-gray-200 p-3 rounded-l-md"></i>
                    </div>
                </div>

                <!-- Save -->
                <div class="py-4">
                    <!-- Edit -->
                    <button
                        class="bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-sm shadow-none transition duration-500 ease-in-out">
                        <a href="{{ route('pf_tags_trans.edit', $translation) }}">
                            {{ __('generic.edit') }}
                            <i class="fa-solid fa-pen-to-square text-blue-800 px-1"></i>
                        </a>
                    </button>
                    <!-- Delete -->
                    <form action="{{ route('pf_tags_trans.destroy', $translation) }}" method="POST">
                        <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                        @csrf
                        <!-- Dirtective to Override the http method -->
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

        </form>

        <!-- Footer -->
        <div class="flex flex-row justify-end items-center py-4 px-4 {{ $bgMenuColor }} sm:rounded-b-lg">
            <a href="{{ route('pf_tags.show', $translation->tag) }}">
                <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out"
                    title="{{ __('generic.back') }}"></i>
            </a>
        </div>

    </div>

</div>
