@extends('layouts.home')

@section('content')
    <div class="container mx-auto ">

        <div class="w-full my-10">
            @if(session()->has('success'))
                <a href="{{ route('movies.index') }}">
                    <div class="text-center py-4 lg:px-4">
                        <div class="text-center py-4 lg:px-4">
                            <div class="p-2 bg-green-800 hover:bg-green-600 items-center text-white leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                                <span class="flex rounded-full bg-green-500 uppercase px-2 py-1 text-xs font-bold mr-3">Completed</span>
                                <span class="font-semibold mr-2 text-left flex-auto">{{ session()->get('success') }}</span>
                                <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
                            </div>
                        </div>
                    </div>
                </a>
            @endif
            <div class="grid grid-cols-4 gap-4 mt-5">

                @if(isset($shows))
                    @foreach($shows as $data)
                        <div class="text-center mb-5 bg-gray-200 p-3 rounded-lg shadow-sm">
                            <a href="{{ route('omdb.show', $data['imdbID']) }}">
                                <img src="{{ $data['Poster'] }}" alt="Poster" class="w-1/2 mx-auto p-0 rounded-3xl transition duration-500 ease-in-out hover:bg-red-600 transform hover:-translate-y-1 hover:scale-110">
                            </a>

                            <h2 class="font-semibold pt-2">
                                {{ $data['Title'] }}
                            </h2>

                            <p class="text-xs">
                                År: {{ $data["Year"] }}
                            </p>

                            @auth
                                @if(!$movies->contains('movie_id', $data['imdbID']))
                                    <form action="{{ route('movies.store') }}" method="POST">
                                        @csrf
                                        <input type="text" class="hidden" value="{{ $data["imdbID"] }}" name="movie_id" readonly>
                                        <button type="submit" class="bg-yellow-700 hover:bg-yellow-500 text-black font-bold py-2 px-4 rounded-full mt-2">
                                            <i class="fas fa-star"></i> Favorite
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('movies.destroy', [$data["imdbID"], auth()->id()]) }}">
                                        <input type="text" class="hidden" value="{{ $data["imdbID"] }}" name="movie_id" readonly>
                                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-black font-bold py-2 px-4 rounded-full mt-2">
                                            <i class="fas fa-star"></i> Remove Favorite
                                        </button>
                                    </form>
                                @endif
                            @endauth

                            @guest
                                <div class="md:mt-5">
                                    <a href ="{{ route('login') }}" class="bg-yellow-500 hover:bg-yellow-700 text-black font-bold py-2 px-4 rounded-full mt-2">
                                        <i class="fas fa-star"></i> Login to use favorites
                                    </a>
                                </div>
                            @endguest
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
