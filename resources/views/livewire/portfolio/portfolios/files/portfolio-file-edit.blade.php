<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">

    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500 capitalize">
        <a href="{{ route('portfolios') }}"
            class="text-black {{ $textMenuHeader }}">{{ __('admin/portfolio/portfolio.menuIndex') }}</a>
        /
        <a href="{{ route('portfolios.show', $portfolio) }}"
            class="font-bold text-black {{ $textMenuHeader }}">{{ $portfolio->name }}</a>
        /
        <a href="{{ route('portfoliosfile.show', [$portfolio, $image]) }}"
            class="font-bold text-black {{ $textMenuHeader }}">{{ __('generic.image') }}</a>
        /
        <a href="{{ route('portfoliosfile.edit', [$portfolio, $image]) }}"
            class="font-bold text-black {{ $underlineMenuHeader }}">{{ __('generic.edit') }}</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <!-- HEADER -->
        <div class="flex flex-row justify-start items-center py-4 {{ $bgMenuColor }}">
            <span class="text-lg text-white capitalize px-4">{{ __('generic.portfolio') }}</span>
        </div>

        <!--EDIT TYPE -->
        <div class="mx-auto w-11/12 py-4 px-2">

            <!-- Edit Type Message -->
            <div class="flex w-full sm:w-fit text-lg text-white bg-blue-600 font-light normal-case rounded-t-md p-2">
                <span>{{ __('generic.edit') }} {{ __('generic.image') }} > <span
                        class="font-bold">{{ $image->original_filename }}</span></span>
            </div>


            <!-- Form -->
            <div class="bg-slate-100 rounded-md p-2">
                <form action="{{ route('portfoliosfile.update', [$portfolio, $image]) }}" method="POST">
                    <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                    @csrf
                    <!-- Directive to Override the http method -->
                    @method('PUT')

                    <!-- Name -->
                    <h2 class="text-lg font-bold capitalize pt-2 pb-1 px-2">{{ __('generic.title') }} </h2>

                    <div class="relative">
                        <input wire:model="title" name="title" id="title" type="text"
                            value="{{ $image->title }}" maxlength="100"
                            class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white {{ $focusColor }}">
                        <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                            <i class="fa-solid fa-tag  bg-gray-200 p-3 rounded-l-md"></i>
                        </div>
                    </div>

                    @error('title')
                        <div class="text-sm text-red-600 font-bold py-1">
                            {{ $message }}
                        </div>
                    @enderror

                    <!-- Description -->
                    <div class="flex flex-col justify-start items-start w-full sm:w-2/3 gap-4 py-2">
                        <span class="text-lg font-semibold capitalize px-2">{{ __('generic.description') }}</span>
                        <textarea rows="6" name="description" id="description"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg w-full p-2 {{ $focusColor }}">{{ $image->description }}</textarea>
                    </div>
                    @error('description')
                        <div class="text-sm text-red-600 font-bold py-1">
                            {{ $message }}
                        </div>
                    @enderror

                    <!-- Save -->
                    <div class="py-4">
                        <button type="submit"
                            class="w-full sm:w-fit bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-lg shadow-none transition duration-500 ease-in-out">
                            {{ __('generic.save') }}
                        </button>
                    </div>

                </form>

            </div>

        </div>

        <!-- FOOTER -->
        <div
            class="flex flex-row justify-between items-center text-white text-center p-4 {{ $bgMenuColor }} sm:rounded-b-lg">
            <div class="w-1/3 text-left"><a href="{{ route('portfoliosfile.show', [$portfolio, $image]) }}">
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
