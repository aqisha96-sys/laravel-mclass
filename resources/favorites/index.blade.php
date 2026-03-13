<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ❤️ My Favorites
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Flash Message --}}
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
            @endif

            {{-- Empty State --}}
            @if($favorites->isEmpty())
            <div class="text-center py-20 text-gray-400">
                <p class="text-5xl mb-4">🎬</p>
                <p class="text-lg mb-2">You have no favorites yet.</p>
                <a href="{{ route('movies.index') }}"
                    class="text-blue-600 hover:underline">
                    Browse movies and add some!
                </a>
            </div>

            @else
            <p class="text-gray-500 text-sm mb-4">
                {{ $favorites->count() }} movie(s) saved
            </p>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach($favorites as $fav)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">

                    {{-- Poster --}}
                    <a href="{{ route('movies.show', $fav->movie_id) }}">
                        @if($fav->poster_path)
                        <img
                            src="https://image.tmdb.org/t/p/w342{{ $fav->poster_path }}"
                            alt="{{ $fav->title }}"
                            class="w-full h-64 object-cover"
                            loading="lazy">
                        @else
                        <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-400">
                            No Image
                        </div>
                        @endif
                    </a>

                    {{-- Info --}}
                    <div class="p-3">
                        <h3 class="font-semibold text-sm truncate mb-1">
                            <a href="{{ route('movies.show', $fav->movie_id) }}"
                                class="hover:text-blue-600">
                                {{ $fav->title }}
                            </a>
                        </h3>
                        <div class="flex justify-between text-xs text-gray-500 mb-2">
                            <span>⭐ {{ number_format($fav->vote_average, 1) }}</span>
                            <span>{{ $fav->release_year }}</span>
                        </div>

                        {{-- Remove Button --}}
                        <form action="{{ route('favorites.destroy', $fav->movie_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full text-xs bg-red-100 hover:bg-red-500 hover:text-white text-red-600 py-1 rounded transition">
                                Remove ✕
                            </button>
                        </form>
                    </div>

                </div>
                @endforeach
            </div>
            @endif

        </div>
    </div>
</x-app-layout>