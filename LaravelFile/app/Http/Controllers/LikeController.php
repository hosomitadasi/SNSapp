<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function index()
    {
        // 今回は使用せず
    }

    public function store(Request $request)
    {
        // 投稿画面で「いいね」を追加するのに使用予定
    }

    public function show(string $id)
    {
        // 今回は使用せず
    }

    public function update(Request $request, string $id)
    {
        // 今回は使用せず
    }

    public function destroy(string $id)
    {
        // 投稿画面で「いいね」を削除するのに使用予定
    }
}
