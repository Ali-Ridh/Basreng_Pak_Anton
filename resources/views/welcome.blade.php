@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-purple-600 mb-4">
                🎮 Welcome to Anime & Gaming Forum! 🎮
            </h1>
            <p class="text-xl text-gray-600 mb-8">
                The ultimate destination for anime discussions, gaming talk, and pop culture debates!
            </p>

            <div class="grid md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gradient-to-br from-blue-500 to-purple-600 text-white p-6 rounded-lg">
                    <div class="text-3xl mb-2">🎌</div>
                    <h3 class="text-xl font-semibold mb-2">Anime Discussion</h3>
                    <p>Talk about your favorite anime series, characters, and episodes with fellow otaku!</p>
                </div>

                <div class="bg-gradient-to-br from-green-500 to-blue-600 text-white p-6 rounded-lg">
                    <div class="text-3xl mb-2">🎮</div>
                    <h3 class="text-xl font-semibold mb-2">Video Games</h3>
                    <p>Share gaming experiences, discuss latest releases, and connect with gamers worldwide!</p>
                </div>

                <div class="bg-gradient-to-br from-pink-500 to-red-600 text-white p-6 rounded-lg">
                    <div class="text-3xl mb-2">🎬</div>
                    <h3 class="text-xl font-semibold mb-2">Pop Culture</h3>
                    <p>Debate movies, TV shows, music, and all things trending in entertainment!</p>
                </div>
            </div>

            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <span class="text-2xl">🕵️‍♂️</span>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm">
                            <strong>Pro Tip:</strong> There's a hidden Easter egg somewhere on this site!
                            Can you find the Konami code route? Up, Up, Down, Down, Left, Right, Left, Right, B, A, Start!
                        </p>
                    </div>
                </div>
            </div>

            <a href="{{ route('forums.index') }}"
               class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition duration-300">
                🚀 Enter the Forum
            </a>
        </div>
    </div>
</div>
@endsection
