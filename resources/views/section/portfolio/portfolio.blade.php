<x-xavi-layout>

    <x-slot name="title">{{ __('generic.portfolio') }}</x-slot>

    {{-- @foreach ($tipos as $tipo)

        @foreach ($tipo->translations as $tipoTrans)
            @if ($tipoTrans->lang_id == $languageId)
                <h2>{{ $tipoTrans->name }}</h2>
            @endif
        @endforeach

        @foreach ($porfs as $porf)
            @foreach ($porf->translations as $pfTrans)
                @if ($pfTrans->lang_id == $languageId && $pfTrans->type->pf_type_id == $tipo->id)
                    <br />
                    {{ $pfTrans->title }} / {{ $pfTrans->id }}
                    <br />
                @endif
            @endforeach
        @endforeach
        <br />
    @endforeach --}}

    <div class="p-0 border-0 border-slate-600 shadow-lg shadow-black">

        <!-- TYPES -->
        @foreach ($types as $type)
            <!-- Check if the TYPE has yet any portfolio associated, Must have translations and at least one translation must have a portfolio associated -->
            <!-- Checking $type->translations[0]->portfoliotranslations, MUST HAVE AT LEAST ONE TRANSLATION IN SPANISH, BECAUSE IS THE LANGUAGE WITH THE SMALLER ID -->
            @if (count($type->translations[0]->portfoliotranslations) > 0)
            
                @foreach ($type->translations as $typeTrans)
                    @if ($typeTrans->lang_id == $languageId)
                        <!-- TYPE Info -->
                        <div class="flex flex-col gap-0 {{ $type->color }} text-white p-2">
                            <a href="/portfolio/type/{{ $typeTrans->pf_type_id }}">
                                <span class="text-lg  font-bold uppercase hover:text-black">{{ $typeTrans->name }}</span>
                            </a>
                            <span class="text-sm text-slate-600 font-normal">{{ $typeTrans->description }}</span>
                        </div>
                    @endif
                @endforeach
                <div
                    class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 bg-white p-2">

                    @foreach ($portfolios as $portfolio)
                        @foreach ($portfolio->translations as $pfTrans)
                            @if ($pfTrans->lang_id == $languageId && $pfTrans->type->pf_type_id == $type->id)
                                @foreach ($portfolio->files as $file)
                                    @if ($file->type == 'image' && $file->position == 0)
                                        <div class="flex flex-col gap-1">
                                            <!-- Portfolio Image -->
                                            <a href="/portfolio/{{ $pfTrans->portfolio_id }}">
                                                <img src="{{ asset('storage/' . $file->path) }}"
                                                    class="object-cover object-center w-full h-40 max-w-full rounded-sm"
                                                    title="{{ $pfTrans->subtitle }}">
                                            </a>
                                            <!-- Portfolio Title -->
                                            <div class="flex justify-center bg-black p-2 hover:bg-slate-800">
                                                <a href="/portfolio/{{ $pfTrans->portfolio_id }}">
                                                    <span
                                                        class="text-sm capitalize text-white hover:text-green-200">{{ $pfTrans->title }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    @endforeach

                </div>
            @endif
        @endforeach

    </div>

</x-xavi-layout>
