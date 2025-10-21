@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="mb-6">
            <nav class="text-sm text-gray-500 mb-4">
                <a href="{{ route('forums.index') }}" class="hover:text-purple-600">Forums</a>
                <span class="mx-2">></span>
                <a href="{{ route('forums.threads.index', $forum) }}" class="hover:text-purple-600">{{ $forum->name }}</a>
                <span class="mx-2">></span>
                <span class="text-purple-600 font-semibold">{{ $thread->title }}</span>
            </nav>

            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <span class="text-2xl">📌</span>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-semibold text-blue-800">{{ $thread->title }}</h3>
                        <p class="text-blue-700 mt-1">{{ $thread->content }}</p>
                        <div class="text-sm text-blue-600 mt-2">
                            Posted by {{ $thread->user->name ?? 'Anonymous' }} • {{ $thread->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-900">💬 Posts ({{ $posts->count() }})</h2>
                <a href="{{ route('forums.threads.posts.create', [$forum, $thread]) }}"
                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    + Add Reply
                </a>
            </div>
        </div>

        <div class="space-y-6">
            @forelse($posts as $post)
                <div class="border border-gray-200 rounded-lg p-6 bg-gray-50">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                                {{ substr($post->user->name ?? 'A', 0, 1) }}
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">{{ $post->user->name ?? 'Anonymous' }}</div>
                                <div class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</div>
                            </div>
                        </div>

                        <div class="flex space-x-2">
                            <a href="{{ route('forums.threads.posts.edit', [$forum, $thread, $post]) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                Edit
                            </a>
                            <form action="{{ route('forums.threads.posts.destroy', [$forum, $thread, $post]) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm"
                                        onclick="return confirm('Are you sure you want to delete this post?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="prose max-w-none mb-4">
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $post->content }}</p>
                    </div>

                    @if($post->attachments->count() > 0)
                        <div class="border-t pt-4">
                            <h4 class="text-sm font-semibold text-gray-600 mb-3">📎 Attachments ({{ $post->attachments->count() }})</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($post->attachments as $attachment)
                                    <div class="border border-gray-300 rounded-lg p-3 bg-white">
                                        @if(str_contains($attachment->mime_type, 'image/'))
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $attachment->path) }}"
                                                     alt="{{ $attachment->original_filename }}"
                                                     class="w-full h-32 object-cover rounded">
                                            </div>
                                        @elseif(str_contains($attachment->mime_type, 'video/'))
                                            <div class="mb-2">
                                                <video class="w-full h-32 object-cover rounded" controls>
                                                    <source src="{{ asset('storage/' . $attachment->path) }}" type="{{ $attachment->mime_type }}">
                                                </video>
                                            </div>
                                        @else
                                            <div class="mb-2 flex items-center justify-center w-full h-32 bg-gray-100 rounded">
                                                <span class="text-4xl">📄</span>
                                            </div>
                                        @endif

                                        <div class="text-sm">
                                            <p class="font-medium text-gray-900 truncate" title="{{ $attachment->original_filename }}">
                                                {{ $attachment->original_filename }}
                                            </p>
                                            <p class="text-gray-500 text-xs">
                                                {{ number_format($attachment->size / 1024, 1) }} KB • {{ $attachment->mime_type }}
                                            </p>
                                            <div class="mt-2 flex space-x-2">
                                                <a href="{{ route('attachments.download', $attachment) }}"
                                                   class="text-blue-600 hover:text-blue-800 text-xs">Download</a>
                                                @if(str_contains($attachment->mime_type, 'image/') || str_contains($attachment->mime_type, 'video/'))
                                                    <a href="{{ route('attachments.show', $attachment) }}"
                                                       class="text-green-600 hover:text-green-800 text-xs" target="_blank">View</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @empty
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">💭</div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">No posts yet!</h3>
                    <p class="text-gray-500 mb-4">Be the first to reply to this thread.</p>
                    <a href="{{ route('forums.threads.posts.create', [$forum, $thread]) }}"
                       class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded">
                        Add First Reply
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection