<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{

    public function run(): void
    {
        $user1 = User::create([
            'name' => 'test1',
            'email' => 'user1@example.com',
            'password' => Hash::make('password'),
            'firebase_uid' => 'dummy-uid-test1',
        ]);

        $post = Post::create([
            'user_id' => $user1->id,
            'content' => 'test',
        ]);

        Comment::create([
            'user_id' => $user1->id,
            'post_id' => $post->id,
            'content' => 'comment',
        ]);
    }
}
