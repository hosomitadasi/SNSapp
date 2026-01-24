<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{

    public function show(string $id)
    {
        $post = Post::with(['user', 'comments.user'])->findOrFail($id);

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
