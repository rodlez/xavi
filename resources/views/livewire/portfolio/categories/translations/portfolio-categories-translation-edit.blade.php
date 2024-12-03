<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">

    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500">
        <a href="/pf_categories/{{ $translation->category->id }}" class="hover:text-violet-600">{{ $translation->category->name }}</a> /
        <a href="/pf_categories_trans/edit/{{ $translation->id }}"
            class="font-bold text-black border-b-2 border-b-violet-600">Edit</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <div>

            <!-- Header -->
            <div class="flex flex-row justify-between items-center py-4 bg-violet-400">
                <div>
                    <span class="text-lg text-white px-4 capitalize">Edit Translation ({{ $translation->language->name }})</span>
                </div>

            </div>

            <!-- Info -->
            <div class="flex flex-col mt-4 mx-8 pb-0 lg:mx-14">
                <div class="flex flex-col text-white bg-slate-800 p-0">
                    <span class="uppercase bg-orange-600 p-2">Category</span>
                    <span class="font-bold p-2">{{ $translation->category->name }}</span>
                    <span class="uppercase bg-orange-600 p-2">Description</span>
                    <span class="text-sm p-2">{{ $translation->category->description }}</span>
                </div>
            </div>

            <!-- Edit Translation -->
            <form action="{{ route('pf_categories_trans.update', $translation) }}" method="POST">
                <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                @csrf
                <!-- Dirtective to Override the http method -->
                @method('PUT')

                <!-- Edit Translation -->
                <div class="mx-auto w-11/12 py-2 px-2">

                    <!-- Language -->
                    <h2 class="text-lg font-bold pt-2 pb-1 px-2">Language </h2>

                    <div class="relative">
                        <input placeholder="{{ $translation->language->name }}" readonly disabled
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-language  bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>


                    {{-- <div class="relative">
                        <select wire:model.live="language_id" name="language_id" id="language_id"
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                            @foreach ($languages as $language)
                                <option value="{{ $language->id }}" class="text-green-600"
                                    @if ($language->id == $translation->lang_id) selected @endif>{{ $language->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-language bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>
                    <div class="text-sm text-red-600 font-bold py-1 pl-12">
                        @error('language_id')
                            {{ $message }}
                        @enderror
                    </div> --}}

                    <!-- Name -->
                    <h2 class="text-lg font-bold pt-2 pb-1 px-2">Translation <span class="text-red-600">*</span></h2>

                    <div class="relative">
                        <input wire:model="name" name="name" id="name" type="text"
                            value="{{ $translation->name }}" maxlength="100"
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-pen-to-square  bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    <div class="text-sm text-red-600 font-bold py-1 pl-12">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>

                    <!-- Save -->
                    <div class="py-4">
                        <button type="submit"
                            class="w-full sm:w-fit bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-lg shadow-none transition duration-500 ease-in-out">
                            Save
                            <i class="fa-solid fa-floppy-disk px-2"></i>
                        </button>
                    </div>

                </div>

            </form>

            <!-- Footer -->
            <div class="flex flex-row justify-end items-center py-4 px-4 bg-violet-400 sm:rounded-b-lg">
                <a href="{{ route('pf_categories.show', $translation->category) }}">
                    <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out"
                        title="Go Back"></i>
                </a>
            </div>

        </div>

    </div>

</div>
