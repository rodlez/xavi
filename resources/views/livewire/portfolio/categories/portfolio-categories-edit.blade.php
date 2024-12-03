<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">

    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500">
        <a href="/pf_categories" class="hover:text-blue-800">Categories</a> /
        <a href="/pf_categories/{{ $category->id }}" class="hover:text-blue-800">Info</a> /
        <a href="/pf_categories/edit/{{ $category->id }}"
            class="font-bold text-black border-b-2 border-b-blue-800">Edit</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <!-- HEADER -->
        <div class="flex flex-row py-4 bg-blue-800">
            <span class="text-lg text-white capitalize px-4">Portfolio Category </span>
        </div>

        <!--EDIT CATEGORY -->
        <div class="mx-auto w-11/12 py-4 px-2">

            <div class="italic p-2 rounded-md bg-blue-100">Edit the PortFolio Category, description is optional.</div>

            <form action="{{ route('pf_categories.update', $category) }}" method="POST">
                <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                @csrf
                <!-- Dirtective to Override the http method -->
                @method('PUT')

                <!-- Name -->
                <h2 class="text-lg font-bold pt-2 pb-1 px-2">Name <span class="text-red-600">*</span></h2>

                <div class="relative">
                    <input wire:model="name" name="name" id="name" type="text" value="{{ $category->name }}"
                        maxlength="100"
                        class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                    <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                        <i class="fa-solid fa-tag  bg-gray-200 p-3 rounded-l-md"></i>
                    </div>
                </div>

                <div class="text-sm text-red-600 font-bold py-1 px-2">
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>

                <!-- Description -->
                <div class="flex flex-col justify-start items-start w-full sm:w-2/3 gap-4 py-2">
                    <span class="text-md font-semibold px-2">Description</span>
                    <textarea rows="6" name="description" id="description"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg w-full p-2 focus:ring-blue-500 focus:border-blue-500">{{ $category->description }}</textarea>
                </div>
                <!-- Errors -->
                @error('description')
                    <div>
                        <span class="text-sm text-red-600 font-bold px-2">{{ $message }}</span>
                    </div>
                @enderror

                <!-- Save -->
                <div class="py-4">
                    <button type="submit"
                        class="w-full sm:w-fit bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-lg shadow-none transition duration-500 ease-in-out">
                        Save
                        <i class="fa-solid fa-floppy-disk px-2"></i>
                    </button>
                </div>

            </form>
            
        </div>

        <!-- FOOTER -->
        <div class="flex flex-row justify-end items-center py-4 px-4 bg-blue-800 sm:rounded-b-lg">
            <a href="{{ route('pf_categories.show', $category) }}">
                <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out"
                    title="Go Back"></i>
            </a>
        </div>

    </div>

</div>
