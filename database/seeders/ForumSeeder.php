<?php

namespace Database\Seeders;

use App\Models\Forum;
use App\Models\Thread;
use App\Models\Post;
use App\Models\User;
use App\Models\Attachment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample forums
        $animeForum = Forum::create([
            'name' => 'Anime Discussion',
            'description' => 'Discuss your favorite anime series, characters, and episodes!'
        ]);

        $gamingForum = Forum::create([
            'name' => 'Video Games',
            'description' => 'Talk about video games, gaming news, and share your gaming experiences!'
        ]);

        $popCultureForum = Forum::create([
            'name' => 'Pop Culture',
            'description' => 'Everything about movies, TV shows, music, and trending topics!'
        ]);

        // Create sample users
        $user1 = User::factory()->create([
            'name' => 'AnimeFan123',
            'email' => 'animefan@example.com',
        ]);

        $user2 = User::factory()->create([
            'name' => 'GamerPro',
            'email' => 'gamer@example.com',
        ]);

        $user3 = User::factory()->create([
            'name' => 'PopCultureLover',
            'email' => 'popculture@example.com',
        ]);

        // Create threads
        $thread1 = $animeForum->threads()->create([
            'user_id' => $user1->id,
            'title' => 'Best Anime Openings of All Time',
            'content' => 'What are your favorite anime opening songs? Share your top picks!'
        ]);

        $thread2 = $gamingForum->threads()->create([
            'user_id' => $user2->id,
            'title' => 'Retro Gaming Nostalgia',
            'content' => 'Let\'s talk about classic games that shaped our childhood!'
        ]);

        $thread3 = $popCultureForum->threads()->create([
            'user_id' => $user3->id,
            'title' => 'Marvel vs DC: Who Wins?',
            'content' => 'The eternal debate continues! Which universe has better stories?'
        ]);

        // Create posts with attachments
        $post1 = $thread1->posts()->create([
            'user_id' => $user1->id,
            'content' => 'My absolute favorite is "Tank!" from Cowboy Bebop. The jazz fusion is incredible!'
        ]);

        $post2 = $thread2->posts()->create([
            'user_id' => $user2->id,
            'content' => 'Super Mario Bros 3 was my jam! The levels were so creative and challenging.'
        ]);

        $post3 = $thread3->posts()->create([
            'user_id' => $user3->id,
            'content' => 'Marvel has better character development, but DC has more iconic villains. Tough call!'
        ]);

        // Note: In a real application, you'd upload actual files and create attachment records
        // For seeding, we'll create sample attachment records without actual files
        $post1->attachments()->create([
            'filename' => 'sample_anime_image.jpg',
            'original_filename' => 'anime_wallpaper.jpg',
            'mime_type' => 'image/jpeg',
            'path' => 'attachments/sample_anime_image.jpg',
            'size' => 1024000,
        ]);

        $post2->attachments()->create([
            'filename' => 'sample_game_gif.gif',
            'original_filename' => 'mario_animation.gif',
            'mime_type' => 'image/gif',
            'path' => 'attachments/sample_game_gif.gif',
            'size' => 2048000,
        ]);

        $post3->attachments()->create([
            'filename' => 'sample_video.mp4',
            'original_filename' => 'marvel_trailer.mp4',
            'mime_type' => 'video/mp4',
            'path' => 'attachments/sample_video.mp4',
            'size' => 10485760,
        ]);
    }
}
