<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">

    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500 capitalize">
        <a href="/portfolios" class="{{ $textMenuHeader }}">{{ __('admin/portfolio/portfolio.menuIndex') }}</a> /
        <a href="/portfolios/{{ $translation->portfolio->id }}"
            class="{{ $textMenuHeader }}">{{ $translation->portfolio->name }}</a> /
        <a href="/portfolios_trans/{{ $translation->id }}"
            class="font-bold text-black {{ $underlineMenuHeader }}">{{ __('generic.translation') }}</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <!-- HEADER -->
        <div class="flex flex-row justify-between items-center py-4 {{ $bgMenuColor }}">
            <div>
                <span class="text-lg text-white px-4 capitalize">{{ __('generic.edit') }}
                    ({{ $translation->portfolio->name }}) {{ __('generic.portfolio') }}</span>
            </div>
        </div>

        <!-- PORTFOLIO INFO -->
        <div class="flex flex-col mx-auto my-4 w-11/12">
            <div class="w-fit bg-black text-white text-lg capitalize mb-1 p-2">
                {{ __('generic.info') }}
            </div>
            <div class="flex flex-col text-white capitalize bg-slate-800">
                <span class="bg-orange-600 py-1 px-2">Id</span>
                <span class="text-sm p-2">{{ $translation->portfolio->id }}</span>
                <span class="bg-orange-600 py-1 px-2">User</span>
                <span class="text-sm p-2">{{ $translation->portfolio->user->name }}</span>
                <span class="bg-orange-600 py-1 px-2">{{ __('generic.published') }}</span>
                <span class="font-bold p-2">{{ publishedText($translation->portfolio->published) }}</span>
                <span class="bg-orange-600 py-1 px-2">{{ __('generic.status') }}</span>
                <span class="font-bold p-2">{{ statusText($translation->portfolio->status) }}</span>
                <span class="bg-orange-600 py-1 px-2">{{ __('generic.name') }}</span>
                <span class="font-bold p-2">{{ $translation->portfolio->name }}</span>
                <span class="bg-orange-600 py-1 px-2">{{ __('generic.description') }}</span>
                <span
                    class="text-sm p-2">{{ $translation->portfolio->description ? $translation->portfolio->description : '-' }}</span>
            </div>
        </div>

        <!-- Show TRANSLATION -->
        <div class="mx-auto w-11/12 my-4">

            
                <!-- Form Text Message -->
                <div class="italic p-2 rounded-md {{ $bgInfoColor }}">{{ __('generic.showTranslation') }}
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

                <!-- Category -->
                <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.category') }}</h2>

                <div class="relative">
                    <input placeholder="{{ $translation->category->name }}" readonly disabled
                        class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                    <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                        <i class="fa-solid fa-list  bg-gray-200 p-3 rounded-l-md"></i>
                    </div>
                </div>

                 <!-- Type -->
                 <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.type') }}</h2>

                 <div class="relative">
                     <input placeholder="{{ $translation->type->name }}" readonly disabled
                         class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                     <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                         <i class="fa-solid fa-folder-tree  bg-gray-200 p-3 rounded-l-md"></i>
                     </div>
                 </div>

                <!-- Title -->
                <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.title') }}</h2>

                <div class="relative">
                    <input placeholder="{{ $translation->title }}" readonly disabled
                        class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                    <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                        <i class="fa-solid fa-pencil  bg-gray-200 p-3 rounded-l-md"></i>
                    </div>
                </div>
               
                <!-- SubTitle -->
                <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.subtitle') }}</h2>

                <div class="relative">
                    <input placeholder="{{ $translation->subtitle }}" readonly disabled
                        class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                    <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                        <i class="fa-solid fa-pencil  bg-gray-200 p-3 rounded-l-md"></i>
                    </div>
                </div>                

                <!-- Content -->
                <div class="flex flex-col justify-start items-start w-full sm:w-2/3 gap-4 py-2">
                    <span class="text-lg font-semibold capitalize px-2">{{ __('generic.content') }}</span>
                    <textarea 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg w-full p-2 {{ $focusColor }}"
                        readonly disabled
                        >{{ $translation->content }}</textarea>
                </div>                

                <!-- Year -->
                <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.year') }}</h2>

                <div class="relative">
                    <input placeholder="{{ $translation->year }}" readonly disabled
                        class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                    <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                        <i class="fa-solid fa-calendar-days  bg-gray-200 p-3 rounded-l-md"></i>
                    </div>
                </div>                

                <!-- Location -->
                <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.location') }}</h2>

                <div class="relative">
                    <input placeholder="{{ $translation->location }}" readonly disabled
                        class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                    <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                        <i class="fa-solid fa-location-dot  bg-gray-200 p-3 rounded-l-md"></i>
                    </div>
                </div>                

                <!-- Client -->
                <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.client') }}</h2>

                <div class="relative">
                    <input placeholder="{{ $translation->client }}" readonly disabled
                        class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                    <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                        <i class="fa-solid fa-helmet-safety  bg-gray-200 p-3 rounded-l-md"></i>
                    </div>
                </div>               

                <!-- Project -->
                <h2 class="text-lg font-bold capitalize px-2">{{ __('generic.project') }}</h2>

                <div class="relative">
                    <input placeholder="{{ $translation->project }}" readonly disabled
                        class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                    <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                        <i class="fa-solid fa-wrench  bg-gray-200 p-3 rounded-l-md"></i>
                    </div>
                </div>     
                
                <div class="flex flex-col sm:flex-row gap-2 py-4">
                   <!-- Edit -->
                <button
                class="bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-sm shadow-none transition duration-500 ease-in-out">
                <a href="{{ route('portfolios_trans.edit', $translation) }}">
                    {{__("generic.edit")}}
                    <i class="fa-solid fa-pen-to-square text-blue-800 px-1"></i>
                </a>
            </button>
            <!-- Delete -->
            <form action="{{ route('portfolios_trans.destroy', $translation) }}" method="POST">
                <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                @csrf
                <!-- Dirtective to Override the http method -->
                @method('DELETE')
                <button
                    class="bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-sm shadow-none transition duration-500 ease-in-out"
                    onclick="return confirm('{{__('generic.confirmDelete')}}')">
                    {{__("generic.delete")}}
                    <i class="fa-solid fa-trash px-1 text-red-600"></i>
                </button>
            </form>
                </div>

        </div>

        <!-- Footer -->
        <div class="flex flex-row justify-end items-center py-4 px-4 {{ $bgMenuColor }} sm:rounded-b-lg">
            <a href="{{ route('portfolios.show', $translation->portfolio) }}">
                <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out"
                    title="{{ __('generic.back') }}"></i>
            </a>
        </div>


    </div>

</div>

