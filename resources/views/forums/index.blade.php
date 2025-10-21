@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">🎪 Forum Categories</h1>
            <a href="{{ route('forums.create') }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Create Forum
            </a>
        </div>

        <div class="grid gap-6">
            @forelse($forums as $forum)
                <div class="bg-gradient-to-r from-purple-50 to-blue-50 border border-purple-200 rounded-lg p-6 hover:shadow-lg transition duration-300">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-purple-800 mb-2">
                                <a href="{{ route('forums.show', $forum) }}" class="hover:text-purple-600">
                                    {{ $forum->name }}
                                </a>
                            </h2>
                            <p class="text-gray-600 mb-4">{{ $forum->description }}</p>

                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span>📊 {{ $forum->threads->count() }} threads</span>
                                <span>💬 {{ $forum->threads->sum(fn($thread) => $thread->posts->count()) }} posts</span>
                                <span>📅 Updated {{ $forum->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        <div class="ml-4 flex space-x-2">
                            <a href="{{ route('forums.threads.index', $forum) }}"
                               class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded text-sm">
                                View Threads
                            </a>
                            <a href="{{ route('forums.edit', $forum) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded text-sm">
                                Edit
                            </a>
                            <form action="{{ route('forums.destroy', $forum) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm"
                                        onclick="return confirm('Are you sure you want to delete this forum?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">🎪</div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">No forums yet!</h3>
                    <p class="text-gray-500 mb-4">Be the first to create a forum category.</p>
                    <a href="{{ route('forums.create') }}"
                       class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded">
                        Create First Forum
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection