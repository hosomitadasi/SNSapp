<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

    public function indexPost()
    {
        $posts = Post::with('user')
                    ->withCount(['likes', 'comments'])
                    ->latest()
                    ->get();
        return response()->json($posts);
    }

    public function storePost(Request $request)
    {
        $post = Post::create([
            'user_id' => $request->user_id,
            'content' => $request->content,
        ]);

        return response()->json($post, 201);
    }

    public function destroyPost(string $id)
    {
        // 投稿の削除に使用予定
    }
}
