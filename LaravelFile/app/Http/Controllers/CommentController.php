<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{

    public function show(Request $request, string $id)
    {
        $post = Post::with(['user', 'comments.user'])
            ->withCount('likes')
            ->findOrFail($id);

        $userId = $request->query('user_id');
        $post->is_liked = $userId
            ? $post->likes()->where('user_id', $userId)->exists()
            : false;

        return response()->json($post);
    }

    public function storeComment(Request $request)
    {
        $comment = Comment::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'content' => $request->content,
        ]);

        return response()->json($comment, 201);
    }

}
