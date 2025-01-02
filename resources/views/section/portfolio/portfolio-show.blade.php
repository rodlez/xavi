<x-xavi-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <h2>Lang -> {{ $language }}</h2>

    <div class="flex flex-col w-full bg-yellow-400">

        SHOW

        {{ $portfolio }}

        <div class="flex flex-col w-full my-4 bg-green-400">
            <br />
            ID {{ $portfolio->id }}
            <br />
            TITLE {{ $portfolio->title }}
            <br />
            TYPE {{ $portfolio->type->pf_type_id }} 
            <a href="/portfolio/type/{{ $portfolio->type->pf_type_id }}">
                <span class="text-sm uppercase text-red-600">{{ $portfolio->type->name }}</span>
            </a>
            <br />
            CATEGORY {{ $portfolio->category->pf_cat_id }}
            <a href="/portfolio/cat/{{ $portfolio->category->pf_cat_id }}">
                <span class="text-sm uppercase text-red-600">{{ $portfolio->category->name }}</span>
            </a>
            <br />
            TAGS
            @foreach ($portfolio->tags as $tag)
                {{ $tag->name }} 
            @endforeach
            <br />
            SUBTITLE {{ $portfolio->subtitle }}
            <br />
            YEAR {{ $portfolio->year }}
            <br />
            LOCATION {{ $portfolio->location }}

        </div>


        <div class="flex flex-row flex-wrap gap-4 bg-red-400">
            @foreach ($files as $file)
                @if ($file->type == 'image')
                    <div class="flex bg-emerald-600 my-4 p-2 w-48">
                        <div class="flex bg-white">
                            <img src="{{ asset('storage/' . $file->path) }}">
                        </div>

                    </div>
                @endif
            @endforeach
        </div>

    </div>

</x-xavi-layout>
