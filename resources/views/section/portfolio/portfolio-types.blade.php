<x-xavi-layout>

    <x-slot name="title">{{ __('generic.portfolio') }} > {{ $type->name }}</x-slot>

    <!-- Sitemap -->
    <div class="flex gap-1 bg-black text-white rounded p-2 capitalize mb-2">
        <a href="/portfolio" class="hover:text-green-400">{{ __('generic.portfolio') }}
        </a> / 
        <span>{{ $type->name }}</span>
    </div>

    <div class="p-0 border-0 border-slate-600 shadow-sm shadow-slate-300">

        <!-- TYPE Info -->
        <div class="flex flex-col gap-0 {{$type->type->color}} p-2">            
            <span class="text-xl text-slate-800 font-semibold">{{ $type->name }}</span>
            <span class="text-md text-slate-600">{{ $type->description }}</span>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 bg-white p-2">

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

    </div>

</x-xavi-layout>
