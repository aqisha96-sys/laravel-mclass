<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🔍 Search Results
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Search Bar --}}
            <form action="{{ route('movies.search') }}" method="GET" class="mb-6">
                <div class="flex gap-2">
                    <input
                        type="text"
                        name="q"
                        value="{{ $query }}"
                        placeholder="Search for a movie..."
                        class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                        Search
                    </button>
                </div>
            </form>

            {{-- Result Count --}}
            <p class="text-gray-600 mb-4">
                Found <strong>{{ number_format($results['total_results'] ?? 0) }}</strong>
                results for: <strong>"{{ $query }}"</strong>
            </p>

            {{-- No Results --}}
            @if(empty($results['results']))
            <div class="text-center py-16 text-gray-400">
                <p class="text-4xl mb-4">🎬</p>
                <p class="text-lg">No movies found. Try a different keyword.</p>
                <a href="{{ route('movies.index') }}" class="text-blue-600 hover:underline mt-2 inline-block">
                    ← Back to Home
                </a>
            </div>

            @else
            {{-- Results Grid --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mb-8">
                @foreach($results['results'] as $movie)
                @include('movies._movie_card', ['movie' => $movie])
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="flex justify-center items-center gap-4 mt-6">
                @if($results['page'] > 1)
                <a
                    href="{{ route('movies.search', ['q' => $query, 'page' => $results['page'] - 1]) }}"
                    class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg transition">
                    ← Prev
                </a>
                @endif

                <span class="text-gray-600 text-sm">
                    Page {{ $results['page'] }} of {{ $results['total_pages'] }}
                </span>

                @if($results['page'] < $results['total_pages'])
                    <a
                    href="{{ route('movies.search', ['q' => $query, 'page' => $results['page'] + 1]) }}"
                    class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg transition">
                    Next →
                    </a>
                    @endif
            </div>
            @endif

        </div>
    </div>
</x-app-layout>