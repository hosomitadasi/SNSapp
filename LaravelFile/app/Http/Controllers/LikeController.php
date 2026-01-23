<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{

    public function storeLike(Request $request)
    {
        // 投稿画面で「いいね」を追加するのに使用予定
    }

    public function destroyLike(string $id)
    {
        // 投稿画面で「いいね」を削除するのに使用予定
    }
}
