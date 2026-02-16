<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

    public function indexPost(Request $request)
    {
        $userId = $request->query('user_id');

        $posts = Post::with('user')
                    ->withCount(['likes', 'comments'])
                    ->withExists(['likes as is_liked' =>function($query) use ($userId) {
                        $query->where('user_id', $userId);
                    }])
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

    public function destroyPost(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
        if ($post->user_id != $request->query('user_id')) {
            return response()->json(['message' => '権限がありません'], 403);
        }
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }
}
