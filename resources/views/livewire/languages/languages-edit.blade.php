<div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">
    <!-- Sitemap -->
    <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500">
        <a href="/languages" class="hover:text-yellow-600">Languages</a> /
        <a href="/languages/{{$language->id}}" class="hover:text-yellow-600">Info</a> /
        <a href="/languages/edit/{{ $language->id }}" class="font-bold text-black border-b-2 border-b-yellow-600">Edit</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <!-- Header -->
        <div class="flex flex-row justify-between items-center py-4 bg-yellow-400">
            <div>
                <span class="text-lg text-white px-4">Language Edit</span>
            </div>
        </div>
        <!--Language -->
        <div class="mx-auto w-11/12 py-4 px-2">
            <form action="{{ route('languages.update', $language) }}" method="POST">
                <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                @csrf
                <!-- Dirtective to Override the http method -->
                @method('PUT')

                <!-- Name -->
                <div class="flex flex-col justify-start items-start w-full sm:w-2/3 gap-4 py-2">
                    <span class="text-md font-semibold px-2">Name</span>
                    <input name="name" id="name" type="text" value="{{ $language->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg w-full sm:w-2/3 p-2 focus:ring-yellow-500 focus:border-yellow-500">
                </div>
                <!-- Errors -->
                @error('name')
                    <div>
                        <span class="text-sm text-red-400 font-bold px-2">{{ $message }}</span>
                    </div>
                @enderror

                <!-- Code -->
                <div class="flex flex-col justify-start items-start w-full sm:w-2/3 gap-4 py-2">
                    <span class="text-md font-semibold px-2">Code</span>
                    <input name="code" id="code" type="text" value="{{ $language->code }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg w-full sm:w-2/3 p-2 focus:ring-yellow-500 focus:border-yellow-500">
                </div>
                <!-- Errors -->
                @error('code')
                    <div>
                        <span class="text-sm text-red-400 font-bold px-2">{{ $message }}</span>
                    </div>
                @enderror

                <!-- Save -->
                <div class="py-4">
                    <button type="submit" class="w-full sm:w-fit bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-lg shadow-none transition duration-500 ease-in-out">
                        Save
                        <i class="fa-solid fa-floppy-disk px-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Footer -->
    <div class="flex flex-row justify-end items-center py-4 px-4 bg-yellow-400 sm:rounded-b-lg">
        <a href="{{ route('languages.show', $language) }}">
            <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out" title="Go Back"></i>
        </a>
    </div>
</div>