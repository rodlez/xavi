<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">

    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500 capitalize">
        <a href="{{ route('portfolios') }}" class="{{ $textMenuHeader }}">{{ __('admin/portfolio/portfolio.menuIndex') }}</a> /
        <a href="{{ route('portfolios.show', $portfolio) }}" class="{{ $textMenuHeader }}">{{ $portfolio->name }}</a> /
        <a href="{{ route('portfolios.edit', $portfolio) }}"
            class="font-bold text-black {{ $underlineMenuHeader }}">{{ __('generic.edit') }}</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <!-- HEADER -->
        <div class="flex flex-row py-4 {{ $bgMenuColor }}">
            <span class="text-lg text-white capitalize px-4">{{ __('admin/portfolio/portfolio.titleHeader') }} </span>
        </div>

        <!-- EDIT PORTFOLIO -->
        <div class="mx-auto w-11/12 py-4 px-2">

            <!-- Edit Portfolio Message -->
            <div class="flex w-full sm:w-fit text-lg text-white bg-blue-600 font-light normal-case rounded-t-md p-2">
                <span>{{ __('admin/portfolio/portfolio.infoMessageEdit') }} > <span
                        class="font-bold">{{ $portfolio->name }}</span></span>
            </div>
            <!-- Mandatory Form Fields Message -->
            <div class="flex flex-col text-black normal-case bg-gray-200 sm:rounded-tr-lg">
                <span
                    class="{{ $menuInfo }} text-sm p-2 sm:rounded-tr-lg">{{ __('generic.mandatoryFields') }}</span>
            </div>

            <!-- Form -->
            <div class="bg-slate-100 rounded-md p-2">
                <form action="{{ route('portfolios.update', $portfolio) }}" method="POST">
                    <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                    @csrf
                    <!-- Directive to Override the http method -->
                    @method('PUT')
                    <!-- Published -->
                    <div
                        class="flex flex-row justify-start items-center mt-6 py-2 px-2 rounded-md gap-3 {{ $published == 0 ? 'bg-red-100' : 'bg-green-100' }}  ">
                        <div>
                            <h2 class="text-black text-lg capitalize font-semibold">{{ __('generic.published') }}</h2>
                        </div>
                        <div>
                            <label class="inline-flex cursor-pointer pt-2">
                                <input wire:model.live="published" name="published" id="published" type="checkbox"
                                    value="{{ $published }}" {{ $published == 1 ? 'checked' : '' }} class="sr-only peer">
                                <div
                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-white dark:peer-focus:ring-gray-600 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                                </div>
                            </label>
                        </div>
                    </div>
                    <!-- Status -->
                    <h2 class="text-lg font-bold capitalize pt-2 pb-1 px-2">{{ __('generic.status') }} <span
                            class="text-red-600">*</span></h2>
                    <div class="relative">
                        <select wire:model.live="status" name="status" id="status"
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                            <option value="0" class="text-green-600"
                                @if ($portfolio->status == 0) selected @endif>
                                {{ __('generic.done') }}</option>
                            <option value="1" class="text-green-600"
                                @if ($portfolio->status == 1) selected @endif>
                                {{ __('generic.process') }}</option>
                        </select>
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-wrench bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>
                    <div class="text-sm text-red-600 font-bold py-1">
                        @error('status')
                            {{ $message }}
                        @enderror
                    </div>

                    <!-- Position -->
                    <h2 class="text-lg font-bold capitalize pt-2 pb-1 px-2">{{ __('generic.position') }}</h2>

                    <div class="relative">
                        <input wire:model="position" name="position" id="position" type="number"
                            value="{{ $portfolio->position }}" maxlength="100"
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white {{ $focusColor }}">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-sort bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    @error('position')
                        <div class="text-sm text-red-600 font-bold py-1">
                            {{ $message }}
                        </div>
                    @enderror

                    <!-- Name -->
                    <h2 class="text-lg font-bold capitalize pt-2 pb-1 px-2">{{ __('generic.name') }} <span
                            class="text-red-600">*</span></h2>

                    <div class="relative">
                        <input wire:model="name" name="name" id="name" type="text"
                            value="{{ $portfolio->name }}" maxlength="100"
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white {{ $focusColor }}">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-house  bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    <div class="text-sm text-red-600 font-bold py-1">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="flex flex-col justify-start items-start w-full sm:w-2/3 gap-4 py-2">
                        <span class="text-lg font-semibold capitalize px-2">{{ __('generic.description') }}</span>
                        <textarea wire:model="description" rows="6" name="description" id="description"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg w-full p-2 {{ $focusColor }}">{{ $portfolio->description }}
                    </textarea>
                    </div>
                    <!-- Errors -->
                    <div class="text-sm text-red-600 font-bold py-1">
                        @error('description')
                            {{ $message }}
                        @enderror
                    </div>

                    <!-- Save -->
                    <div class="py-4">
                        <button type="submit"
                            class="w-full sm:w-fit bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-lg shadow-none transition duration-500 ease-in-out">
                            {{ __('generic.save') }}
                            <i class="fa-solid fa-floppy-disk px-2"></i>
                        </button>
                    </div>

                </form>

            </div>

        </div>

        <!-- FOOTER -->
        <div
            class="flex flex-row justify-between items-center text-white text-center p-4 {{ $bgMenuColor }} sm:rounded-b-lg">
            <div class="w-1/3 text-left"><a href="{{ route('portfolios.show', $portfolio) }}">
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
