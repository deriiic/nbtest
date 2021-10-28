@extends('layouts.home')

@section('content')
    <div class="flex h-screen" style="background: url({{ asset('storage/images/movie_image.jpg') }}); background-size: cover;">
        <form class="md:w-2/5 sm:w-full m-auto" method="GET" action="{{ route('omdb.search') }}">
            @if(session()->has('error'))
                <div class="text-center py-4 lg:px-4">
                    <div class="text-center py-4 lg:px-4">
                        <div class="p-2 bg-red-800 items-center text-white leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                            <span class="flex rounded-full bg-red-500 uppercase px-2 py-1 text-xs font-bold mr-3">Error</span>
                            <span class="font-semibold mr-2 text-left flex-auto">{{ session()->get('error') }}</span>
                        </div>
                    </div>
                </div>
            @endif
            <div class="bg-white shadow rounded-xl p-4 flex">
                <input class="focus:outline-none w-full rounded border-0 p-2 mx-2" type="text" name="title" placeholder="Search by title..." autofocus>

                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <div class="relative">
                        <select name="type" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                            <option value="movie">Movie</option>
                            <option value="series">TV-show</option>
                        </select>
                    </div>
                </div>

                <button class="bg-red-400 hover:bg-red-300 rounded text-white p-2 pl-4 pr-4" type="submit">
                    Search
                </button>
            </div>
        </form>
    </div>
@endsection
