<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Thread;
use App\Models\Forum;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Forum $forum, Thread $thread)
    {
        $posts = $thread->posts()->with('attachments')->get();
        return view('posts.index', compact('forum', 'thread', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Forum $forum, Thread $thread)
    {
        return view('posts.create', compact('forum', 'thread'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Forum $forum, Thread $thread)
    {
        $request->validate([
            'content' => 'required',
            'attachments.*' => 'file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480', // 20MB max
        ]);

        $post = new Post($request->only('content'));
        $post->thread_id = $thread->id;
        $post->user_id = auth()->id(); // Assuming authentication is set up
        $post->save();

        // Handle file uploads
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('attachments', $filename, 'public');

                $post->attachments()->create([
                    'filename' => $filename,
                    'original_filename' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'path' => $path,
                    'size' => $file->getSize(),
                ]);
            }
        }

        return redirect()->route('forums.threads.posts.index', [$forum, $thread])
                        ->with('success','Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Forum $forum, Thread $thread, Post $post)
    {
        $post->load('attachments');
        return view('posts.show', compact('forum', 'thread', 'post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Forum $forum, Thread $thread, Post $post)
    {
        return view('posts.edit', compact('forum', 'thread', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Forum $forum, Thread $thread, Post $post)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $post->update($request->only('content'));

        return redirect()->route('forums.threads.posts.index', [$forum, $thread])
                        ->with('success','Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Forum $forum, Thread $thread, Post $post)
    {
        $post->delete();

        return redirect()->route('forums.threads.posts.index', [$forum, $thread])
                        ->with('success','Post deleted successfully.');
    }
}
