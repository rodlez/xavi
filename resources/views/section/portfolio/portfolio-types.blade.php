<x-xavi-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <h2>Lang -> {{ $language }}</h2>

    <div class="flex flex-col w-full bg-yellow-400">

        <h2>TYPES - {{$type->name}}</h2>

        <br />

        <p class="text-sm my-4">{{ $portfolios }}</p>

        <br />

        <div class="flex flex-row flex-wrap gap-4 bg-red-400">
            @foreach ($portfolios as $portfolio)
                    {{$portfolio->subtitle}} <br />
            @endforeach
        </div>

    </div>

</x-xavi-layout>
