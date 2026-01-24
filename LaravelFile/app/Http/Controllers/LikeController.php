<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{

    public function storeLike(Request $request)
    {
        $like = Like::firstOrCreate([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
        ]);

        return response()->json([
            'message' => 'いいねしました！',
            'like' => $like
        ], 201);
    }

    public function destroyLike(Request $request, string $postId)
    {
        Like::where('post_id', $postId)
            ->where('user_id', $request->user_id)
            ->delete();

        return response()->json([
            'message' => 'いいねを削除しました！'
        ]);
    }
}
