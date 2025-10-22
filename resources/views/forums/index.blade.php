@extends('layouts.app')

@section('content')
<div style="background-color: #f8f9fa; min-height: 100vh; padding: 40px 20px;">
    <div style="max-width: 1400px; margin: 0 auto;">

        <!-- Header Section -->
        <div style="text-align: center; margin-bottom: 50px;">
            <h1 style="font-size: 3.5rem; font-weight: bold; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 20px; text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">
                🎮 Anime & Gaming Forums
            </h1>
            <p style="font-size: 1.4rem; color: #64748b; max-width: 600px; margin: 0 auto; line-height: 1.6;">
                Join the ultimate community for anime discussions, gaming talk, and pop culture debates!
            </p>
        </div>

        <!-- Forums Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 30px; margin-bottom: 50px;">
            @foreach($forums as $forum)
            <div style="background: white; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); overflow: hidden; transition: all 0.3s ease; transform: translateY(0);">
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px 25px; position: relative;">
                    <div style="position: absolute; top: -20px; right: -20px; width: 80px; height: 80px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
                    <h2 style="font-size: 1.8rem; font-weight: bold; color: white; margin-bottom: 10px; position: relative; z-index: 1;">
                        {{ $forum->name }}
                    </h2>
                    <p style="color: rgba(255,255,255,0.9); line-height: 1.5; position: relative; z-index: 1;">
                        {{ $forum->description }}
                    </p>
                </div>

                <div style="padding: 25px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <div style="text-align: center;">
                            <div style="font-size: 1.5rem; margin-bottom: 5px;">📊</div>
                            <div style="font-weight: bold; color: #374151; font-size: 1.2rem;">{{ $forum->threads->count() }}</div>
                            <div style="color: #6b7280; font-size: 0.8rem;">threads</div>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 1.5rem; margin-bottom: 5px;">💬</div>
                            <div style="font-weight: bold; color: #374151; font-size: 1.2rem;">{{ $forum->threads->sum(fn($thread) => $thread->posts->count()) }}</div>
                            <div style="color: #6b7280; font-size: 0.8rem;">posts</div>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 1.5rem; margin-bottom: 5px;">👥</div>
                            <div style="font-weight: bold; color: #374151; font-size: 1.2rem;">{{ $forum->threads->pluck('user.name')->unique()->count() }}</div>
                            <div style="color: #6b7280; font-size: 0.8rem;">users</div>
                        </div>
                    </div>

                    <a href="{{ route('forums.show', $forum) }}" style="display: block; width: 100%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-weight: bold; padding: 15px; border-radius: 12px; text-align: center; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(102,126,234,0.3);">
                        🚀 Enter Forum
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Create Forum Section -->
        @auth
        <div style="text-align: center; margin-bottom: 50px;">
            <a href="{{ route('forums.create') }}" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; font-weight: bold; padding: 18px 40px; border-radius: 30px; text-decoration: none; font-size: 1.2rem; display: inline-block; box-shadow: 0 6px 20px rgba(16,185,129,0.3); transition: all 0.3s ease;">
                ➕ Create New Forum
            </a>
        </div>
        @endauth

        <!-- Stats Section -->
        <div style="background: white; border-radius: 20px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <h3 style="font-size: 2rem; font-weight: bold; text-align: center; color: #1f2937; margin-bottom: 30px;">
                📈 Community Stats
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px;">
                <div style="text-align: center;">
                    <div style="font-size: 3rem; margin-bottom: 10px;">🎯</div>
                    <div style="font-weight: bold; font-size: 2rem; color: #667eea;">{{ $forums->count() }}</div>
                    <div style="color: #6b7280; font-size: 1rem;">Active Forums</div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 3rem; margin-bottom: 10px;">📝</div>
                    <div style="font-weight: bold; font-size: 2rem; color: #10b981;">{{ $forums->sum(fn($forum) => $forum->threads->count()) }}</div>
                    <div style="color: #6b7280; font-size: 1rem;">Total Threads</div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 3rem; margin-bottom: 10px;">💬</div>
                    <div style="font-weight: bold; font-size: 2rem; color: #f59e0b;">{{ $forums->sum(fn($forum) => $forum->threads->sum(fn($thread) => $thread->posts->count())) }}</div>
                    <div style="color: #6b7280; font-size: 1rem;">Total Posts</div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 3rem; margin-bottom: 10px;">👥</div>
                    <div style="font-weight: bold; font-size: 2rem; color: #ef4444;">{{ $forums->pluck('threads')->flatten()->pluck('user.name')->unique()->count() }}</div>
                    <div style="color: #6b7280; font-size: 1rem;">Community Members</div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div style="text-align: center; margin-top: 50px; padding: 20px; background: rgba(255,255,255,0.8); border-radius: 15px;">
            <p style="color: #6b7280; margin-bottom: 10px;">
                🎮 Welcome to the ultimate anime and gaming community! 🎮
            </p>
            <p style="color: #9ca3af; font-size: 0.9rem;">
                Share your thoughts, discuss your favorite series, and connect with fellow enthusiasts.
            </p>
        </div>
    </div>
</div>
@endsection