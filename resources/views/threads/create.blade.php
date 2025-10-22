@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <nav class="text-sm text-gray-500 mb-6">
            <a href="{{ route('forums.index') }}" class="hover:text-purple-600">Forums</a>
            <span class="mx-2">></span>
            <a href="{{ route('forums.threads.index', $forum) }}" class="hover:text-purple-600">{{ $forum->name }}</a>
            <span class="mx-2">></span>
            <span class="text-purple-600 font-semibold">New Thread</span>
        </nav>

        <h1 class="text-3xl font-bold text-gray-900 mb-6">📝 Create New Thread in "{{ $forum->name }}"</h1>

        <form action="{{ route('forums.threads.store', $forum) }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Thread Title <span class="text-red-500">*</span>
                </label>
                <input type="text" id="title" name="title"
                       value="{{ old('title') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500"
                       placeholder="Enter a descriptive title for your thread..."
                       required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                    Thread Content <span class="text-red-500">*</span>
                </label>
                <textarea id="content" name="content"
                          rows="8"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500"
                          placeholder="Share your thoughts, start a discussion, or ask a question..."
                          required>{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('forums.threads.index', $forum) }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    ← Back to Forum
                </a>

                <button type="submit"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">
                    📝 Create Thread
                </button>
            </div>
        </form>
    </div>
</div>
@endsection