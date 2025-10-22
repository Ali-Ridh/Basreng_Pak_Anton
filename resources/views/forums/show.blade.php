@extends('layouts.app')

@section('content')
<div style="background-color: #f8f9fa; min-height: 100vh; padding: 20px;">
    <div style="max-width: 1200px; margin: 0 auto;">

        <!-- Forum Header -->
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; border-radius: 15px; margin-bottom: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <h1 style="font-size: 2.5rem; font-weight: bold; margin-bottom: 10px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                🎯 {{ $forum->name }}
            </h1>
            <p style="font-size: 1.2rem; opacity: 0.9; margin-bottom: 20px;">
                {{ $forum->description }}
            </p>
            <div style="display: flex; gap: 15px; align-items: center;">
                <span style="background: rgba(255,255,255,0.2); padding: 8px 15px; border-radius: 20px; font-size: 0.9rem;">
                    📊 {{ $forum->threads->count() }} Threads
                </span>
                <span style="background: rgba(255,255,255,0.2); padding: 8px 15px; border-radius: 20px; font-size: 0.9rem;">
                    💬 {{ $forum->threads->sum(fn($thread) => $thread->posts->count()) }} Posts
                </span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <a href="{{ route('forums.index') }}" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: bold; box-shadow: 0 4px 15px rgba(79,172,254,0.3);">
                ← Back to Forums
            </a>

            @auth
                <a href="{{ route('forums.threads.create', $forum) }}" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: bold; box-shadow: 0 4px 15px rgba(67,233,123,0.3);">
                    ➕ New Thread
                </a>
            @endauth
        </div>

        <!-- Threads List -->
        <div style="background: white; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); overflow: hidden;">
            @forelse($forum->threads as $thread)
                <div style="border-bottom: 1px solid #e9ecef; padding: 25px; transition: all 0.3s ease;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div style="flex: 1;">
                            <h3 style="font-size: 1.4rem; font-weight: bold; margin-bottom: 10px; color: #2d3748;">
                                <a href="{{ route('forums.threads.show', [$forum, $thread]) }}" style="color: #667eea; text-decoration: none; transition: color 0.3s ease;">
                                    {{ $thread->title }}
                                </a>
                            </h3>
                            <p style="color: #718096; margin-bottom: 15px; line-height: 1.6;">
                                {{ Str::limit($thread->content, 150) }}
                            </p>
                            <div style="display: flex; gap: 20px; align-items: center;">
                                <span style="color: #a0aec0; font-size: 0.9rem;">
                                    👤 {{ $thread->user->name }}
                                </span>
                                <span style="color: #a0aec0; font-size: 0.9rem;">
                                    📅 {{ $thread->created_at->format('M j, Y') }}
                                </span>
                                <span style="background: #edf2f7; color: #4a5568; padding: 4px 10px; border-radius: 12px; font-size: 0.8rem;">
                                    💬 {{ $thread->posts->count() }} replies
                                </span>
                            </div>
                        </div>
                        <div style="margin-left: 20px;">
                            @if($thread->posts->count() > 0)
                                <div style="text-align: center;">
                                    <div style="font-size: 1.5rem;">💬</div>
                                    <div style="font-weight: bold; color: #667eea;">{{ $thread->posts->count() }}</div>
                                    <div style="font-size: 0.8rem; color: #a0aec0;">replies</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 60px 20px;">
                    <div style="font-size: 4rem; margin-bottom: 20px;">📭</div>
                    <h3 style="font-size: 1.5rem; color: #4a5568; margin-bottom: 10px;">No threads yet!</h3>
                    <p style="color: #718096; margin-bottom: 30px;">Be the first to start a discussion in this forum.</p>
                    @auth
                        <a href="{{ route('forums.threads.create', $forum) }}" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 15px 30px; border-radius: 25px; text-decoration: none; font-weight: bold; display: inline-block; box-shadow: 0 4px 15px rgba(102,126,234,0.3);">
                            🚀 Start the First Thread
                        </a>
                    @else
                        <a href="{{ route('login') }}" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 15px 30px; border-radius: 25px; text-decoration: none; font-weight: bold; display: inline-block; box-shadow: 0 4px 15px rgba(102,126,234,0.3);">
                            🔐 Login to Start Thread
                        </a>
                    @endauth
                </div>
            @endforelse
        </div>

        <!-- Footer Stats -->
        <div style="text-align: center; margin-top: 40px; padding: 20px; background: white; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <div style="display: flex; justify-content: center; gap: 40px; flex-wrap: wrap;">
                <div>
                    <div style="font-size: 2rem; margin-bottom: 5px;">🎯</div>
                    <div style="font-weight: bold; color: #2d3748;">{{ $forum->name }}</div>
                    <div style="color: #718096; font-size: 0.9rem;">Forum</div>
                </div>
                <div>
                    <div style="font-size: 2rem; margin-bottom: 5px;">📊</div>
                    <div style="font-weight: bold; color: #2d3748;">{{ $forum->threads->count() }}</div>
                    <div style="color: #718096; font-size: 0.9rem;">Active Threads</div>
                </div>
                <div>
                    <div style="font-size: 2rem; margin-bottom: 5px;">💬</div>
                    <div style="font-weight: bold; color: #2d3748;">{{ $forum->threads->sum(fn($thread) => $thread->posts->count()) }}</div>
                    <div style="color: #718096; font-size: 0.9rem;">Total Posts</div>
                </div>
                <div>
                    <div style="font-size: 2rem; margin-bottom: 5px;">👥</div>
                    <div style="font-weight: bold; color: #2d3748;">{{ $forum->threads->pluck('user.name')->unique()->count() }}</div>
                    <div style="color: #718096; font-size: 0.9rem;">Contributors</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection