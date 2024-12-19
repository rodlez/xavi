<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">

    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500 capitalize">
        <a href="/portfolios" class="{{ $textMenuHeader }}">{{ __('admin/portfolio/portfolio.menuIndex') }}</a> /
        <a href="/portfolios/{{ $portfolio->id }}" class="{{ $textMenuHeader }}">{{ $portfolio->name }}</a> /
        <a href="/portfolios/upload/{{ $portfolio->id }}"
            class="font-bold text-black {{ $underlineMenuHeader }}">{{ __('generic.upload') }}</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <!-- HEADER -->
        <div class="flex flex-row justify-start items-center py-4 {{ $bgMenuColor }}">
            <span class="text-lg text-white capitalize px-4">{{ __('generic.portfolio') }}</span>
        </div>

        <!-- Upload File Information -->
        <div class="flex flex-col mx-4 my-2 pt-4 pb-1 {{ $underlineMenuHeader }}">
            <span class="text-lg capitalize">{{ $portfolio->name }}</span>
        </div>

        <!-- Files Associated to the Portfolio -->
        <div class="flex mx-4 mt-0 mb-4 text-slate-600 text-sm font-bold">{{ __('admin/portfolio/portfolio.filesIn') }}
            ({{ $portfolio->files->count() }})</div>

        @if ($portfolio->files->count() > 0)
            <div
                class="flex flex-row flex-wrap justify-start items-center w-fit mx-4 py-2 px-4 border-2 rounded-lg gap-4 bg-gray-200">
                
                
                {{-- TEST IMAGES --}}
                {{-- <br /><br />
                0 - entradas png vertical<br />
                2 - Megalopolis vertical<br />
                3 - Higuita horizontal<br />
                8 - Gatito coche horizontal<br />
                19 - Gatito png horizontal<br />
                <br /><br />
                {{$this->imageLab($portfolio->files[8])}} --}}

                @foreach ($portfolio->files as $file)                  

                    <!-- Check if the file is an jpg image, and if it is H or V -->
                    @if($file->media_type == 'image/jpeg' || $file->media_type == 'image/png')
                        @php $orientation = $this->isLandscape($file->path) @endphp
                    @endif

                    <div class="relative sm:p-2 p-1">

                        @include('partials.mediatypes-file', [
                            'file' => $file,
                            'iconSize' => 'sm:text-8xl text-6xl',
                            'imagesBig' => true,
                        ])
                        <!-- Delete file -->
                        <form action="{{ route('portfoliosfile.destroy', [$portfolio, $file]) }}" method="POST">
                            <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                            @csrf
                            <!-- Dirtective to Override the http method -->
                            @method('DELETE')
                            <button
                                class="absolute 
                            {{ $file->media_type == 'application/pdf' ? 'top-0 right-0' : '-top-1 -right-2' }}"
                                onclick="return confirm('{{ __('generic.confirmDelete') }}')"
                                title="{{ __('generic.delete') }}">
                                <span class="text-red-600 hover:text-red-400 transition-all duration-500"><i
                                        class="fa-solid fa-circle-xmark fa-md"></i></i></span>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Upload Form -->
        <div class="flex flex-col mx-4 my-4 py-4 px-2 bg-gray-100 rounded-lg">
            <form wire:submit.prevent="save">
                <label class="text-lg text-slate-800 font-semibold mb-2 block">{{ __('generic.uploadFiles') }} <span
                        class="text-xs font-bold">({{ __('generic.maximum') }} 2)</span></label>
                {{-- <input wire:model.live="files" multiple type="file" --}}
                <input wire:model.live="tempFiles" multiple type="file"
                    class="w-full text-gray-400 font-semibold text-sm bg-white border file:cursor-pointer cursor-pointer file:border-0 file:py-3 file:px-4 file:mr-4 file:bg-black file:hover:bg-slate-600 file:text-white rounded ease-linear transition-all duration-500" />
                <p class="text-xs text-black font-semibold mt-2">{{ __('admin/portfolio/portfolio.allowedFormats') }}
                </p>
                <p class="text-xs text-black font-semibold mt-0">{{ __('admin/portfolio/portfolio.maxSize') }}: 1Gb</p>

                <div wire:loading wire:target="tempFiles" 
                class="w-full sm:w-60 flex flex-col justify-center items-center bg-green-600  px-6 py-3 my-2 rounded shadow">
                <span class="text-white font-bold uppercase text-sm">Uploading...</span>
                </div>

                {{-- <div  
                class="w-full sm:w-60 flex flex-row justify-center items-center bg-green-600  px-6 py-3 my-2 rounded shadow">
                <span class="text-white font-bold uppercase text-sm">Uploading...</span>
                </div>

                <button
                        class="w-full sm:w-60 bg-black hover:bg-slate-600 text-white font-bold uppercase text-sm px-6 py-3 my-4 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-500"
                        type="submit">
                        <span>{{ __('generic.upload') }}</span>
                        <i class="fa-solid fa-file-arrow-up fa-lg px-1"></i>
                    </button> --}}

                <!-- To show the Upload Button, Must be files, inside the max limnit, and ALL files must have a valid format -->
                @if ($files && count($files) <= 2 && $this->filesWithValidFormats($files))
                <div class="flex flex-col">
                <button
                        class="w-full sm:w-60 bg-black hover:bg-slate-600 text-white font-bold uppercase text-sm px-6 py-3 my-4 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-500"
                        type="submit">
                        <span>{{ __('generic.upload') }}</span>
                        <i class="fa-solid fa-file-arrow-up fa-lg px-1"></i>
                    </button>
                </div>    
                @endif

                {{-- <br />Errors <br /> {{ var_dump($errors) }}<br />
                <br /> --}}

                <!-- Form Error Messages -->
                @error('files')
                    <div class="flex flex-col my-4 p-4 bg-red-200 rounded-lg">
                        <span class="text-lg text-slate-800 font-bold uppercase">{{ __('generic.error') }}</span>
                        <span class="text-sm text-red-600 font-bold">{{ $message }}</span>
                    </div>
                @enderror
                @error('files.*')
                    <div class="flex flex-col my-4 p-4 bg-red-200 rounded-lg">
                        <span class="text-lg text-slate-800 font-bold uppercase">{{ __('generic.error') }}</span>
                        <span class="text-sm text-red-600 font-bold">{{ $message }}</span>
                    </div>
                @enderror
            </form>
        </div>        

        <!-- Table with the Files to Upload -->
        <div class="flex flex-col mx-4 mb-12">
            @if (count($files) !== 0)
                <div class="py-2 {{ $underlineMenuHeader }}">
                    <span class="text-lg text-slate-800 font-semibold mb-4">{{ __('generic.filesSelected') }}</span>
                    <span class="text-sm {{ count($files) <= 2 ? 'text-green-600' : 'text-red-600' }}">
                        ({{ count($files) }})
                    </span>
                </div>

                <div class="flex flex-row items-center justify-start py-2 gap-2 text-xs">
                    <div><span class="font-bold">{{ __('generic.deleteAllFiles') }}</span></div>
                    <div>
                        <a wire:click="deleteAllFiles" class="cursor-pointer"
                            title="{{ __('generic.deleteAllFiles') }}">
                            <i class="fa-solid fa-trash text-red-600 hover:text-red-400 ease-linear transition-all duration-500"></i>
                        </a>
                    </div>
                </div>

                <!-- Upload Errors, maximum files and/or invalid format -->
                @if (count($files) > 2 || (!$this->filesWithValidFormats($files)))
                    <div class="flex flex-col my-2 p-4 bg-red-200 rounded-lg">
                        <span class="text-lg text-slate-800 font-bold uppercase">{{ __('generic.error') }}</span>
                        @if (count($files) > 2)
                            <span class="text-sm text-red-600 font-bold">(2) {{ __('generic.maxFiles') }}</span>
                        @endif
                        @if (!$this->filesWithValidFormats($files))
                            <span class="text-sm text-red-600 font-bold">{{ __('generic.noValidFormatFiles') }}</span>
                        @endif
                    </div>
                @endif
               

                <!-- Table Upload -->
                <table class="table-auto w-full">
                    <thead class="text-sm text-center text-white normal-case bg-black h-10">
                        <th class="rounded-tl-lg"></th>
                        <th>{{ __('generic.filename') }}</th>
                        <th class="max-md:hidden">{{ __('generic.size') }} <span class="text-xs">(KB)</span></th>
                        <th {{-- class="max-md:hidden" --}}>{{ __('generic.format') }}</th>
                        <th class="rounded-tr-lg"></th>
                    </thead>

                    <tbody>

                        @foreach ($files as $key => $file)
                            <tr
                                class="text-center 
                            {{ $this->isValidFormat($file->getClientOriginalExtension()) ? 'even:bg-zinc-200 odd:bg-white' : 'bg-red-200 text-red-600 font-bold' }}">

                                <td class="py-2">
                                    @include('partials.mediatypes-fileupload', [
                                        'file' => $file,
                                        'iconSize' => 'fa-2x',
                                    ])
                                </td>

                                <td class="py-2">{{ $file->getClientOriginalName() }}</td>
                                <td class="py-2 max-w-10 max-md:hidden">{{ round($file->getSize() / 1000) }}</td>
                                <td class="py-2 max-w-12 {{-- max-md:hidden --}}">{{ $file->getClientOriginalExtension() }}
                                </td>
                                <td class="py-2 px-2">
                                    <a wire:click="deleteFile({{ $key }})" class="cursor-pointer"
                                        title="{{ __('generic.delete') }}">
                                        <span
                                            class="text-red-600 hover:text-black ease-linear transition-all duration-500"><i
                                                class="fa-solid fa-trash"></i></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="h-6">
                        <tr class="bg-black ">
                            <td class="rounded-b-lg" colspan="5"></td>
                        </tr>
                    </tfoot>
                </table>
            @endif
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
