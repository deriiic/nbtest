@extends('layouts.home')

@section('content')
    <div class="container mx-auto md:my-20 my-10">
        <div class="overflow-auto flex justify-center bg-white rounded-3xl shadow-sm py-20">
            <div class="m-2">
                <img src="{{ $data['Poster'] }}" width="100%" alt="Poster">
            </div>
            <div class="md:w-2/6 m-2 w-full">
                <a href="#" class="flex justify-end">
                    <i class="fas fa-star text-yellow-500 hover:text-yellow-700"></i>
                </a>
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
            </div>
        </div>
    </div>
@endsection
