<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">

    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500">
        <a href="/pf_categories" class="text-black hover:text-blue-600">Portfolio Categories</a> /
        <a href="/pf_categories/create" class="font-bold text-black border-b-2 border-b-blue-600">New</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

            <!-- HEADER -->
            <div class="flex flex-row py-4 bg-blue-600">
                <span class="text-lg text-white capitalize px-4">Portfolio Category </span>
            </div>

            <!--CATEGORY -->
            <div class="mx-auto w-11/12 py-4 px-2">

                <span class="text-slate-800 font-bold px-2">Create a new PortFolio Category, description is optional.</span>

                <form wire:submit="save">
                    <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                    @csrf
                    <!-- Name -->
                    <h2 class="text-lg font-bold pt-2 pb-1 px-2">Name <span class="text-red-600">*</span></h2>

                    <div class="relative">
                        <input wire:model="name" name="name" id="name" type="text"
                            value="{{ old('name') }}" maxlength="100"
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-tag  bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    <div class="text-sm text-red-600 font-bold py-1">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>

                    <!-- Description -->
                    <h2 class="text-lg font-bold pt-2 pb-1 px-2">Description</h2>

                    <div class="relative">
                        <input wire:model="description" name="description" id="description" type="text"
                            value="{{ old('description') }}" maxlength="200"
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-align-justify bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    <div class="text-sm text-red-600 font-bold py-1">
                        @error('description')
                            {{ $message }}
                        @enderror
                    </div>

                    <!-- Save -->
                    <div class="py-4">
                        <button wire:click.prevent="save"
                            class="w-full sm:w-fit bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-lg shadow-none transition duration-500 ease-in-out">
                            Save
                            <i class="fa-solid fa-floppy-disk px-2"></i>
                        </button>
                    </div>
                </form>

            </div>
            <!-- FOOTER -->
            <div class="flex flex-row justify-end items-center py-4 px-4 bg-blue-600 sm:rounded-b-lg">
                <a href="{{ route('pf_categories') }}">
                    <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out"
                        title="Go Back"></i>
                </a>
            </div>

    </div>

</div>
