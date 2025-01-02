<x-xavi-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <h2>Lang -> {{ $language }}</h2>

    <div class="flex flex-col w-full bg-yellow-400">

        <h2>CATEGORY - {{ $category->name }}</h2>

        <br />

        <p class="text-sm my-4">{{ $portfolios }}</p>

        <br />

        <div class="flex flex-row flex-wrap gap-4 bg-red-400">
            @foreach ($portfolios as $portfolio)
                <div class="flex flex-col">
                    {{ $portfolio->subtitle }}
                </div>
                @foreach ($portfolio->portfolio->files as $file)
                    {{-- Break to take only the first image and which is in the first position, to show in the Portfolio Gallery --}}
                    @if ($file->type == 'image' && $file->position == 0)
                        <div class="flex flex-col bg-emerald-600 my-4 p-2 w-48">
                            <div class="flex bg-white">
                                <img src="{{ asset('storage/' . $file->path) }}">
                            </div>
                            <div class="flex bg-black">
                                <a href="/portfolio/{{ $portfolio->portfolio_id }}">
                                    <span class="text-sm uppercase text-red-600">{{ $portfolio->title }}</span>
                                </a>
                            </div>
                        </div>
                    @break
                @endif
            @endforeach
        @endforeach
    </div>

</div>

</x-xavi-layout>
