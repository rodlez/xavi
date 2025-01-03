<x-xavi-layout>

    <x-slot name="title">{{ $portfolio->title }}</x-slot>

    <div class="border-2 border-black rounded-lg p-4">

        {{-- {{ $portfolio }} --}}

        <div class="flex flex-col gap-2 w-full my-4">
            <span class="text-lg font-bold">{{ $portfolio->title }}</span>
            <span class="text-md">{{ $portfolio->subtitle }}</span>
            <span class="text-sm">{{ $portfolio->content }}</span>

            <div class="flex flex-row justify-start gap-2">
                <span><i class="fa-solid fa-calendar-days"></i></span>
                <span>{{ $portfolio->year }}</span>
            </div>
            <div class="flex flex-row justify-start gap-2">
              <span><i class="fa-solid fa-location-dot"></i></span>
                <span>{{ $portfolio->location }}</span>
            </div>
            <div class="flex flex-row justify-start gap-2">
              <span><i class="fa-solid fa-helmet-safety"></i></span>
                <span>{{ $portfolio->client }}</span>
            </div>
            <div class="flex flex-row justify-start gap-2">
              <span><i class="fa-solid fa-wrench"></i></span>
                <span>{{ $portfolio->project }}</span>
            </div>

            <div class="flex flex-row flex-wrap justify-start py-2 gap-1">

                <a href="/portfolio/type/{{ $portfolio->type->pf_type_id }}">
                    <span
                        class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded w-fit dark:bg-blue-900 dark:text-blue-300">{{ $portfolio->type->name }}</span>
                </a>

                <a href="/portfolio/cat/{{ $portfolio->category->pf_cat_id }}">
                    <span
                        class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded w-fit dark:bg-red-900 dark:text-red-300">{{ $portfolio->category->name }}</span>
                </a>

                @foreach ($portfolio->tags as $tag)
                    <a href="/portfolio/tag/{{ $tag->tag->id }}">
                        <span
                            class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded w-fit dark:bg-green-900 dark:text-green-300">{{ $tag->name }}</span>
                    </a>
                @endforeach
            </div>

        </div>

        <div class="flex flex-col w-full my-2 border-b-2 capitalize">
          {{ __('generic.images') }}
        </div>

        <div class="columns-1 gap-5 sm:columns-2 sm:gap-2 lg:columns-3 xl:columns-4 [&>img:not(:first-child)]:mt-8 p-0">

            @foreach ($files as $file)
                {{-- <div class="grid gap-4 bg-violet-400"> --}}
                @if ($file->type == 'image')
                    <div class="flex flex-col py-2">
                        <img class="h-auto max-w-full rounded-sm object-cover object-center"
                            src="{{ asset('storage/' . $file->path) }}" alt="gallery-photo" />
                    </div>
                @endif
                {{-- </div> --}}
            @endforeach

        </div>

        <div class="flex flex-col w-full my-2 border-b-2 capitalize">
          {{ __('generic.documents') }}
        </div>

        <div class="flex flex-col gap-2 w-full my-4">

          @foreach ($files as $file)
              {{-- <div class="grid gap-4 bg-violet-400"> --}}
              @if ($file->type == 'document')
                  <div class="flex flex-row justify-start gap-2 py-0">
                    
                    <div class="flex"><a href="{{ asset('storage/' . $file->path) }}" title="{{ __('generic.open') }} PDF {{$file->original_filename}}" target="_blank">
                      <i class="fa-2x fa-regular fa-file-pdf"></i>
                  </a>
                </div>
                  <span class="py-2">{{$file->original_filename}}</span>
                
                  </div>
                  
              @endif
              {{-- </div> --}}
          @endforeach

      </div>



    </div>

</x-xavi-layout>
