<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">

    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500 capitalize">
        <a href="/portfolios"
            class="font-bold text-black {{ $underlineMenuHeader }}">{{ __('admin/portfolio/portfolio.menuIndex') }}</a>
    </div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        <!-- Header -->
        <div class="flex flex-row justify-between items-center py-4 {{ $bgMenuColor }}">
            <div>
                <span class="text-lg text-white capitalize px-4">{{ __('admin/portfolio/portfolio.titleHeader') }} <span
                        class="text-sm">({{ $search != '' ? $found : $total }})</span></span>
            </div>
            <!-- New Portfolio -->
            <div class="px-4">
                <a href="{{ route('portfolios.create') }}"
                    class="text-white text-sm capitalize sm:text-md rounded-lg py-2 px-4 bg-black hover:bg-gray-600 transition duration-1000 ease-in-out"
                    title="Create New Language">{{ __('generic.new') }}
                </a>
            </div>
        </div>
        <!-- Search -->
        <div class="flex flex-col sm:flex-row justify-between items-start px-2 sm:px-4 py-4 gap-4">
            <!-- Search -->
            <div class="relative w-full">
                <div class="absolute top-2.5 bottom-0 left-4 text-slate-700">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <input wire:model.live="search" type="search"
                    class="w-full rounded-lg pl-10 font-sm placeholder-zinc-400 {{ $focusColor }} border-2 border-zinc-200"
                    placeholder="{{ __('generic.searchPlaceholder') }}">
            </div>
            <!-- Pagination -->
            <div class="relative w-32">
                <div class="absolute top-2.5 bottom-0 left-4 text-slate-700">
                    <i class="fa-solid fa-book-open"></i>
                </div>
                <select wire:model.live="perPage"
                    class="w-full rounded-lg text-end {{ $focusColor }} border-2 border-zinc-200 ">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
        <!-- Bulk Actions -->
        @if (count($selections) > 0)
            <div class="px-2 sm:px-4">
                <div class="flex flex-row justify-start items-center gap-4 py-2 px-4 mb-2 rounded-lg bg-zinc-200">
                    <span class="text-sm font-semibold capitalize">{{ __('generic.bulkActions') }}</span>
                    <a wire:click.prevent="bulkClear" class="cursor-pointer"
                        title="{{ __('generic.bulkActionsClear') }}">
                        <span><i class="fa-solid fa-rotate-right text-green-600 hover:text-green-500"></i></span>
                    </a>
                    <a wire:click.prevent="bulkDelete" wire:confirm="{{ __('generic.confirmDelete') }}"
                        class="cursor-pointer text-red-600 hover:text-red-500"
                        title="{{ __('generic.bulkActionsDelete') }}">
                        <span><i class="fa-sm fa-solid fa-trash"></i></span>
                        <span>({{ count($selections) }})</span>
                    </a>
                </div>
            </div>
        @endif
        <!-- Table -->
        <div class="px-0 sm:px-4 pb-0 ">
            <div class="overflow-x-auto">

                @if ($portfolios->count())
                    <table class="min-w-full ">
                        <thead>
                            <tr class="text-black text-left text-sm font-normal uppercase">
                                <th></th>
                                <th wire:click="sorting('portfolios.id')" scope="col"
                                    class="p-2 hover:cursor-pointer hover:{{ $menuTextColor }} {{ $column == 'portfolios.id' ? $menuTextColor : '' }}">
                                    id {!! $sortLink !!}</th>
                                <th wire:click="sorting('name')" scope="col"
                                    class="p-2 hover:cursor-pointer hover:{{ $menuTextColor }} {{ $column == 'name' ? $menuTextColor : '' }}">
                                    {{ __('generic.name') }} {!! $sortLink !!}</th>
                                <th wire:click="sorting('portfolios.id')" scope="col"
                                    class="p-2 hover:cursor-pointer hover:{{ $menuTextColor }} {{ $column == 'published' ? $menuTextColor : '' }}">
                                    {{ __('generic.published') }} {!! $sortLink !!}</th>
                                <th wire:click="sorting('portfolios.id')" scope="col"
                                    class="p-2 hover:cursor-pointer hover:{{ $menuTextColor }} {{ $column == 'status' ? $menuTextColor : '' }}">
                                    {{ __('generic.status') }} {!! $sortLink !!}</th>
                                <th wire:click="sorting('portfolios.created_at')" scope="col"
                                    class="p-2 hover:cursor-pointer hover:{{ $menuTextColor }} {{ $column == 'portfolios.created_at' ? $menuTextColor : '' }}">
                                    {{ __('generic.created') }} {!! $sortLink !!}</th>
                                <th wire:click="sorting('portfolios.updated_at')" scope="col"
                                    class="p-2 hover:cursor-pointer hover:{{ $menuTextColor }} {{ $column == 'portfolios.updated_at' ? $menuTextColor : '' }}">
                                    {{ __('generic.updated') }} {!! $sortLink !!}</th>

                                <th scope="col" class="p-2 text-center capitalize">{{ __('generic.translations') }}
                                </th>
                                <th scope="col" class="p-2 text-center capitalize">{{ __('generic.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($portfolios as $portfolio)
                                <tr
                                    class="text-black text-sm leading-6 even:bg-zinc-200 odd:bg-gray-300 transition-all duration-1000 hover:bg-yellow-400">
                                    <td class="p-2 text-center"><input wire:model.live="selections" type="checkbox"
                                            class="text-green-600 outline-none focus:ring-0 checked:bg-green-500"
                                            value={{ $portfolio->id }}></td>
                                    <td class="p-2">{{ $portfolio->id }}</td>
                                    <td class="p-2"><a
                                            href="{{ route('portfolios.show', $portfolio) }}">{{ $portfolio->name }}</a>
                                    </td>
                                    <td class="p-2">{{ publishedText($portfolio->published) }}</td>
                                    <td class="p-2">{{ statusText($portfolio->status) }}</td>
                                    <td class="p-2">{{ date('d-m-Y', strtotime($portfolio->created_at)) }}</td>
                                    <td class="p-2">{{ date('d-m-Y', strtotime($portfolio->updated_at)) }}</td>
                                    <td class="p-2 text-center uppercase">
                                        {{-- @foreach ($portfolio->translations as $translation)
                                            {{ $translation->language->code }}
                                        @endforeach --}}
                                    </td>
                                    <td class="p-2">
                                        <div class="flex justify-center items-center gap-2">
                                            <!-- Show -->
                                            <a href="{{ route('portfolios.show', $portfolio) }}"
                                                title="{{ __('generic.show') }}">
                                                <i
                                                    class="fa-solid fa-circle-info text-blue-600 hover:text-black transition duration-1000 ease-in-out"></i>
                                            </a>
                                            <!-- Edit -->
                                            <a href="{{ route('portfolios.edit', $portfolio) }}"
                                                title="{{ __('generic.edit') }}">
                                                <i
                                                    class="fa-solid fa-pen-to-square text-green-600 hover:text-black transition duration-1000 ease-in-out"></i>
                                            </a>
                                            <!-- Delete -->
                                            <form action="{{ route('portfolios.destroy', $portfolio) }}" method="POST">
                                                <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                                                @csrf
                                                <!-- Dirtective to Override the http method -->
                                                @method('DELETE')
                                                <button onclick="return confirm('{{ __('generic.confirmDelete') }}')"
                                                    title="{{ __('generic.delete') }}">
                                                    <i
                                                        class="fa-solid fa-trash text-red-600 hover:text-black transition duration-1000 ease-in-out"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div
                        class="flex flex-row justify-between items-center bg-black text-white rounded-lg p-4 mx-2 sm:mx-0">
                        <span>{{ __('generic.elementNotFound') }}</span>
                        <a wire:click.prevent="clearSearch" title={{ __('generic.close') }}>
                            <i
                                class="fa-lg fa-solid fa-circle-xmark cursor-pointer px-2 text-red-600 hover:text-red-400 transition duration-1000 ease-in-out"></i>
                        </a>
                        </span>
                    </div>
                @endif

            </div>

        </div>
        <!-- Pagination Links -->
        <div class="py-2 px-4">
            {{ $portfolios->links() }}
        </div>
        <!-- Footer -->
        <div class="flex flex-row justify-end items-center py-4 px-4 {{ $bgMenuColor }} sm:rounded-b-lg">
            <a href="{{ route('dashboard') }}">
                <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out"
                    title="{{ __('generic.back') }}"></i>
            </a>
        </div>

    </div>

</div>

</div>