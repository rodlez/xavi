<x-xavi-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <h2>Lang -> {{ $language }}</h2>

    <div class="flex flex-col w-full bg-yellow-400">

        {{-- <br />TYPE<br /> --}}
        @foreach ($types as $type)
            <div class="flex flex-row justify-between bg-pink-200 p-4">
                <span class="text-lg text-slate-800 font-bold uppercase">{{ $type->name }} {{-- ID Trans {{ $type->id }} ID Original {{ $type->pf_type_id }} --}}</span>
                <span class="text-lg">oli</span>
            </div>
            <div class="flex flex-row justify-start gap-4 bg-violet-800">


                @foreach ($portfolios as $portfolio)
                    @if ($type->id == $portfolio->pf_type_trans_id)
                        @foreach ($portfolio->portfolio->files as $file)
                            {{-- Break to take only the first image in the Gallery --}}
                            @if ($file->type == 'image')
                                <div class="flex flex-col bg-emerald-600 my-4 p-2 w-48">
                                    <div class="flex bg-white">
                                        <img src="{{ asset('storage/' . $file->path) }}">
                                    </div>
                                    <div class="flex bg-black">
                                        <a href="/portfolio/{{ $portfolio->id }}">
                                            <span class="text-sm uppercase text-red-600">{{ $portfolio->title }}</span>
                                        </a>
                                    </div>
                                </div>
                            @break
                        @endif
                    @endforeach
                    {{-- PORTFOLIO -> {{ $portfolio->title }} <br /> --}}
                @endif
            @endforeach

        </div>
    @endforeach

</div>

</x-xavi-layout>
