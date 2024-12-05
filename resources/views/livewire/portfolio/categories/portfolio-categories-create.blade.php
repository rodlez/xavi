<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">

    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500 capitalize">
        <a href="/pf_categories" class="text-black {{$textMenuHeader}}">{{__("admin/portfolio/portfolioCategories.menuIndex")}}</a> /
        <a href="/pf_categories/create" class="font-bold text-black {{$underlineMenuHeader}}">{{__("generic.new")}}</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <!-- HEADER -->
        <div class="flex flex-row py-4 {{$bgMenuColor}}">
            <span class="text-lg text-white capitalize px-4">{{__("admin/portfolio/portfolioCategories.titleHeader")}} </span>
        </div>

        <!-- NEW CATEGORY -->
        <div class="mx-auto w-11/12 py-4 px-2">

            <div class="italic p-2 rounded-md {{$bgInfoColor}}">
                {{__("admin/portfolio/portfolioCategories.infoMessageCreate")}}
            </div>

            <form wire:submit="save">
                <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                @csrf
                <!-- Name -->
                <h2 class="text-lg font-bold capitalize pt-2 pb-1 px-2">{{__("generic.name")}} <span class="text-red-600">*</span></h2>

                <div class="relative">
                    <input wire:model="name" name="name" id="name" type="text" value="{{ old('name') }}"
                        maxlength="100"
                        class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white {{$focusColor}}">
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
                <div class="flex flex-col justify-start items-start w-full sm:w-2/3 gap-4 py-2">
                    <span class="text-lg font-semibold capitalize px-2">{{__("generic.description")}}</span>
                    <textarea wire:model="description" rows="6" name="description" id="description"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg w-full p-2 {{$focusColor}}"></textarea>
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
                        {{__("generic.save")}}
                        <i class="fa-solid fa-floppy-disk px-2"></i>
                    </button>
                </div>
                
            </form>

        </div>

        <!-- FOOTER -->
        <div class="flex flex-row justify-end items-center py-4 px-4 {{$bgMenuColor}} sm:rounded-b-lg">
            <a href="{{ route('pf_categories') }}">
                <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out"
                    title="{{__("generic.back")}}"></i>
            </a>
        </div>

    </div>

</div>