    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Your favorites
                    </div>
                    <div class="p-6 bg-white">
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
                        @foreach($feed as $data)
                            <div class="overflow-auto flex justify-center bg-white rounded-3xl shadow-sm py-20">
                                <div class="m-2">
                                    <img src="{{ $data['Poster'] }}" width="100%" alt="Poster">
                                </div>
                                <div class="md:w-2/6 m-2 w-full">
                                    <form action="{{ route('movies.destroy', $data['imdbID']) }}" class="flex justify-end" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <i class="fas fa-star text-yellow-500 hover:text-yellow-700"></i>
                                        </button>
                                    </form>
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
                        @endforeach
                        {{ $titles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

