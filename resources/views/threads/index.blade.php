@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="mb-6">
            <nav class="text-sm text-gray-500 mb-4">
                <a href="{{ route('forums.index') }}" class="hover:text-purple-600">Forums</a>
                <span class="mx-2">></span>
                <span class="text-purple-600 font-semibold">{{ $forum->name }}</span>
            </nav>

            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $forum->name }}</h1>
                    <p class="text-gray-600 mt-1">{{ $forum->description }}</p>
                </div>
                <a href="{{ route('forums.threads.create', $forum) }}"
                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    + New Thread
                </a>
            </div>
        </div>

        <div class="space-y-4">
            @forelse($threads as $thread)
                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition duration-200">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                <a href="{{ route('forums.threads.show', [$forum, $thread]) }}"
                                   class="hover:text-purple-600">
                                    {{ $thread->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 mb-3 line-clamp-2">{{ Str::limit($thread->content, 150) }}</p>

                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span>👤 {{ $thread->user->name ?? 'Anonymous' }}</span>
                                <span>💬 {{ $thread->posts->count() }} posts</span>
                                <span>📅 {{ $thread->created_at->diffForHumans() }}</span>
                                @if($thread->posts->count() > 0)
                                    <span>🔥 Last reply {{ $thread->posts->last()->created_at->diffForHumans() }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="ml-4 flex space-x-2">
                            <a href="{{ route('forums.threads.posts.index', [$forum, $thread]) }}"
                               class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-1 rounded text-sm">
                                View Posts
                            </a>
                            <a href="{{ route('forums.threads.edit', [$forum, $thread]) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                Edit
                            </a>
                            <form action="{{ route('forums.threads.destroy', [$forum, $thread]) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm"
                                        onclick="return confirm('Are you sure you want to delete this thread?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">🧵</div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">No threads yet!</h3>
                    <p class="text-gray-500 mb-4">Start the conversation by creating the first thread.</p>
                    <a href="{{ route('forums.threads.create', $forum) }}"
                       class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded">
                        Create First Thread
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection