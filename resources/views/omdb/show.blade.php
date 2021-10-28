@extends('layouts.home')

@section('content')
    <div class="container mx-auto md:my-20 my-10">
        <div class="overflow-auto flex justify-center bg-white rounded-3xl shadow-sm py-20">
            <div class="m-2">
                <img src="{{ $data['Poster'] }}" width="100%" alt="Poster">
            </div>
            <div class="md:w-2/6 m-2 w-full">
                @if(session()->has('success'))
                    <div class="text-center py-4 lg:px-4">
                        <div class="text-center py-4 lg:px-4">
                            <div class="p-2 bg-green-800 items-center text-white leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                                <span class="flex rounded-full bg-green-500 uppercase px-2 py-1 text-xs font-bold mr-3">Completed</span>
                                <span class="font-semibold mr-2 text-left flex-auto">{{ session()->get('success') }}</span>
                            </div>
                        </div>
                    </div>
                @endif
                @auth
                    @if(!$movies->contains('movie_id', $data['imdbID']))
                        <form action="{{ route('movies.store') }}" class="flex justify-end" method="POST">
                            @csrf
                            <input type="text" class="hidden" value="{{ $data["imdbID"] }}" name="movie_id" readonly>
                            <button type="submit">
                                <i class="fas fa-star text-yellow-700 hover:text-yellow-500"></i>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('movies.destroy', $data['imdbID']) }}" class="flex justify-end" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class="fas fa-star text-yellow-500 hover:text-yellow-700"></i>
                            </button>
                        </form>
                    @endif
                @endauth

                <h1 class="font-bold">{{ $data['Title'] }} <span class="text-xs">({{ $data['Runtime'] }})</span></h1>
                <p class="text-xs">{{ $data['Genre'] }}</p>
                <p class="text-xs">Released: {{ $data['Released'] }}</p>
                <p class="mt-3">{{ $data['Plot'] }}</p>

                <p class="mt-5">
                    <span class="font-semibold">Actors: </span>
                    {{$data['Actors']}}
                </p>
                <p>
                    <span class="font-semibold">Awards: </span>
                    {{$data['Awards']}}
                </p>
                    @guest
                        <div class="md:my-5">
                            <a href ="{{ route('login') }}" class="bg-yellow-500 hover:bg-yellow-700 text-black font-bold py-2 px-4 rounded-full mt-2">
                                <i class="fas fa-star"></i> Login to use favorites
                            </a>
                        </div>
                    @endguest
            </div>
        </div>
    </div>
@endsection
