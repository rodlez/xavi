<x-xavi-layout>

    <x-slot name="title">{{ __('generic.portfolio') }}</x-slot>

    {{-- <h2>Lang -> {{ $language }}</h2> --}}

    <div class="p-0 border-0 border-slate-600 shadow-lg shadow-black">

        <!-- TYPES -->
        @foreach ($types as $type)
            <!-- Check if the TYPE has yet any portfolio associated, Must have translations and at least one translation must have a portfolio associated -->
            @if (count($type->type->translations[0]->portfoliotranslations) > 0)
                
                <!-- TYPE Info -->
                <div class="flex flex-col gap-0 bg-green-200 p-2">
                    <a href="/portfolio/type/{{ $type->pf_type_id }}">
                        <span
                            class="text-lg text-slate-800 font-bold uppercase hover:text-slate-400">{{ $type->name }}</span>
                    </a>
                    <span class="text-sm text-slate-600 font-normal">Add column description in the DB Table
                        pf_type_trans</span>
                </div>

                <div
                    class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 bg-white p-2">

                    <!-- PORTFOLIOS for this TYPE -->
                    @foreach ($portfolios as $portfolio)
                        @if ($type->id == $portfolio->pf_type_trans_id)
                            @foreach ($portfolio->portfolio->files as $file)
                                @if ($file->type == 'image' && $file->position == 0)
                                    
                                    <div class="flex flex-col gap-1">
                                        <!-- Portfolio Image -->
                                        <a href="/portfolio/{{ $portfolio->portfolio_id }}">
                                            <img src="{{ asset('storage/' . $file->path) }}"
                                                class="object-cover object-center w-full h-40 max-w-full rounded-sm"
                                                title="{{ $portfolio->subtitle }}">
                                        </a>
                                        <!-- Portfolio Title -->
                                        <div class="flex justify-center bg-black p-2 hover:bg-slate-800">
                                            <a href="/portfolio/{{ $portfolio->portfolio_id }}">
                                                <span
                                                    class="text-sm capitalize text-white hover:text-green-200">{{ $portfolio->title }}</span>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </div>
            @endif
        @endforeach

    </div>

</x-xavi-layout>
