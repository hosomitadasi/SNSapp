<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

class PostsTableSeeder extends Seeder
{

    public function run(): void
    {
        $user1 = User::create([
            'name' => 'test1',
            'email' => 'user1@example.com',
            'password' => Hash::make('password'), // bcryptよりHash::makeが最近の主流です
        ]);

        $user2 = User::create([
            'name' => 'test2',
            'email' => 'user2@example.com',
            'password' => Hash::make('password'),
        ]);

        $post = Post::create([
            'user_id' => $user1->id, // IDを直接書くより変数から取るのが安全！
            'content' => 'test',
        ]);

        // test1(user1)がその投稿にコメント
        Comment::create(
            [
                'user_id' => $user1->id,
                'post_id' => $post->id,
                'content' => 'comment',
            ]
        );
    }
}
