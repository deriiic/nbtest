@extends('layouts.home')

@section('content')
    <div class="flex justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <form class="w-2/5">
            <div class="bg-white shadow rounded-xl p-4 flex">
                <span class="w-auto flex justify-end items-center text-gray-500 p-2">
                    <i class="material-icons text-3xl">search</i>
                </span>
                <input class="w-full rounded p-2 mx-2" type="text" placeholder="Sök efter valfri titel">
                <button class="bg-red-400 hover:bg-red-300 rounded text-white p-2 pl-4 pr-4">
                    Sök
                </button>
            </div>
        </form>
    </div>

@endsection
