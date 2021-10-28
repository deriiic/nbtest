@extends('layouts.home')

@section('content')
    <div class="container mx-auto ">

        <div class="w-full my-10">
            <div class="grid grid-cols-4 gap-4 mt-5">

                @if(isset($data))
                    @foreach($data['Search'] as $details)
                        <div class="text-center mb-5 bg-gray-200 p-3 rounded-lg shadow-sm">
                            <a href="{{ route('omdb.show', $details['imdbID']) }}">
                                <img src="{{ $details['Poster'] }}" alt="Poster" class="w-1/2 mx-auto p-0 rounded-3xl transition duration-500 ease-in-out hover:bg-red-600 transform hover:-translate-y-1 hover:scale-110">
                            </a>

                            <h2 class="font-semibold pt-2">
                                {{ $details['Title'] }}
                            </h2>

                            <p class="text-xs">
                                År: {{ $details["Year"] }}
                            </p>

                            <button class="bg-yellow-700 hover:bg-yellow-500 text-black font-bold py-2 px-4 rounded-full mt-2">
                                <i class="fas fa-star"></i> Favorit
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="flex justify-center">
                @if($previousPage != null)
                    <div class="mx-1">
                        <a href="http://localhost:8000/search?title=love&type=series&page={{ $previousPage }}">
                            <i class="fas fa-arrow-left bg-yellow-500 hover:bg-yellow-600 rounded-full p-2"></i>
                        </a>
                    </div>
                @endif

                <div class="mx-1">
                    <span class="bg-yellow-500 p-2 rounded-full">{{ $page }}</span>
                </div>

                @if($nextPage != null)
                    <div class="mx-1">
                        <a href="http://localhost:8000/search?title=love&type=series&page={{ $nextPage }}">
                            <i class="fas fa-arrow-right bg-yellow-500 hover:bg-yellow-600 rounded-full p-2"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
