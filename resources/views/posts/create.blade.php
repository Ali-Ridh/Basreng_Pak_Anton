@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <nav class="text-sm text-gray-500 mb-6">
            <a href="{{ route('forums.index') }}" class="hover:text-purple-600">Forums</a>
            <span class="mx-2">></span>
            <a href="{{ route('forums.threads.index', $forum) }}" class="hover:text-purple-600">{{ $forum->name }}</a>
            <span class="mx-2">></span>
            <a href="{{ route('forums.threads.posts.index', [$forum, $thread]) }}" class="hover:text-purple-600">{{ $thread->title }}</a>
            <span class="mx-2">></span>
            <span class="text-purple-600 font-semibold">New Reply</span>
        </nav>

        <h1 class="text-3xl font-bold text-gray-900 mb-6">💬 Add Reply to "{{ $thread->title }}"</h1>

        <form action="{{ route('forums.threads.posts.store', [$forum, $thread]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                    Your Reply <span class="text-red-500">*</span>
                </label>
                <textarea id="content" name="content"
                          rows="6"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500"
                          placeholder="Share your thoughts, opinions, or contribute to the discussion..."
                          required>{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="attachments" class="block text-sm font-medium text-gray-700 mb-2">
                    📎 Attachments (Optional)
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-purple-400 transition duration-200">
                    <div class="text-4xl mb-2">📤</div>
                    <p class="text-gray-600 mb-2">Drag & drop files here, or click to select</p>
                    <p class="text-sm text-gray-500 mb-4">
                        Supported: Images (JPEG, PNG, GIF), Videos (MP4, MOV, AVI) • Max 20MB each
                    </p>
                    <input type="file" id="attachments" name="attachments[]" multiple
                           accept="image/*,video/*"
                           class="hidden"
                           onchange="updateFileList(this)">
                    <label for="attachments"
                           class="cursor-pointer inline-block bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                        Choose Files
                    </label>
                </div>

                <div id="file-list" class="mt-4 space-y-2"></div>

                @error('attachments.*')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('forums.threads.posts.index', [$forum, $thread]) }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    ← Back to Thread
                </a>

                <button type="submit"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">
                    📤 Post Reply
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function updateFileList(input) {
    const fileList = document.getElementById('file-list');
    fileList.innerHTML = '';

    if (input.files && input.files.length > 0) {
        Array.from(input.files).forEach((file, index) => {
            const fileItem = document.createElement('div');
            fileItem.className = 'flex items-center justify-between bg-gray-50 p-3 rounded';
            fileItem.innerHTML = `
                <div class="flex items-center space-x-3">
                    <span class="text-2xl">
                        ${file.type.startsWith('image/') ? '🖼️' :
                          file.type.startsWith('video/') ? '🎥' : '📄'}
                    </span>
                    <div>
                        <p class="font-medium text-gray-900">${file.name}</p>
                        <p class="text-sm text-gray-500">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                    </div>
                </div>
                <button type="button" onclick="removeFile(${index})"
                        class="text-red-500 hover:text-red-700">
                    ✕
                </button>
            `;
            fileList.appendChild(fileItem);
        });
    }
}

function removeFile(index) {
    const input = document.getElementById('attachments');
    const dt = new DataTransfer();

    Array.from(input.files).forEach((file, i) => {
        if (i !== index) dt.items.add(file);
    });

    input.files = dt.files;
    updateFileList(input);
}
</script>
@endsection