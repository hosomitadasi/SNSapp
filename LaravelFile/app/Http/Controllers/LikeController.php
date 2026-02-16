<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function toggleLike(Request $request)
    {
        $userId = $request->user_id;
        $postId = $request->post_id;

        $post = \App\Models\Post::find($postId);
        if ($post->user_id == $userId) {
            return response()->json(['message' => '自分の投稿にはいいねできません'], 400);
        }

        $existingLike = Like::where('user_id', $userId)->where('post_id', $postId)->first();

        if ($existingLike) {
            $existingLike->delete();
            return response()->json(['message' => 'いいねを解除しました', 'is_liked' => false]);
        } else {
            Like::create(['user_id' => $userId, 'post_id' => $postId]);
            return response()->json(['message' => 'いいねしました', 'is_liked' => true]);
        }

    }
}
