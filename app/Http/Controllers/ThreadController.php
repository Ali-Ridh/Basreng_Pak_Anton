<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Forum;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Forum $forum)
    {
        $threads = $forum->threads()->get();
        return view('threads.index', compact('forum', 'threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Forum $forum)
    {
        return view('threads.create', compact('forum'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Forum $forum)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $thread = new Thread($request->all());
        $thread->forum_id = $forum->id;
        $thread->user_id = auth()->id(); // Assuming authentication is set up
        $thread->save();

        return redirect()->route('forums.threads.index', $forum)
                        ->with('success','Thread created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Forum $forum, Thread $thread)
    {
        return view('threads.show',compact('forum', 'thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Forum $forum, Thread $thread)
    {
        return view('threads.edit',compact('forum', 'thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forum $forum, Thread $thread)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $thread->update($request->all());

        return redirect()->route('forums.threads.index', $forum)
                        ->with('success','Thread updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forum $forum, Thread $thread)
    {
        $thread->delete();

        return redirect()->route('forums.threads.index', $forum)
                        ->with('success','Thread deleted successfully.');
    }
}