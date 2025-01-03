<x-xavi-layout>

    <x-slot name="title">{{ __('generic.portfolio') }}</x-slot>
   

    <h2>Lang -> {{ $language }}</h2>


    <div class="flex flex-col w-full bg-yellow-400">

        {{-- TYPES --}}
        @foreach ($types as $type)
            {{ $type->type }}
            <div class="flex flex-col gap-1 bg-pink-200 p-2">
                <a href="/portfolio/type/{{ $type->pf_type_id }}">
                    <span
                        class="text-lg text-slate-800 font-bold uppercase hover:text-slate-400">{{ $type->name }}</span>
                </a>
                <span class="text-sm text-red-500">Add column description in the DB Table pf_type_trans</span>
            </div>

            <div class="flex flex-row flex-wrap justify-start gap-4 bg-violet-800">

                {{-- PORTFOLIOS for this TYPE --}}
                @foreach ($portfolios as $portfolio)
                    @if ($type->id == $portfolio->pf_type_trans_id)
                        @foreach ($portfolio->portfolio->files as $file)
                            {{-- Break to take only one image, which is in the first position, to show in the Portfolio Gallery --}}
                            @if ($file->type == 'image' && $file->position == 0)
                                <div class="flex flex-col bg-emerald-600 my-0 p-2 w-60 h-60">
                                    <a href="/portfolio/{{ $portfolio->portfolio_id }}">
                                        <img src="{{ asset('storage/' . $file->path) }}"
                                            class="bg-red-800 p-2 w-60 h-44" title="{{ $portfolio->subtitle }}">
                                    </a>
                                    <div class="flex justify-center bg-black p-2">
                                        <a href="/portfolio/{{ $portfolio->portfolio_id }}">
                                            <span
                                                class="text-sm capitalize text-red-600 hover:text-red-800">{{ $portfolio->title }}</span>
                                        </a>
                                    </div>
                                </div>
                            @break
                        @endif
                    @endforeach
                @endif
            @endforeach

        </div>
    @endforeach

</div>
   

</x-xavi-layout>
