<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        // 画面表示に使用予定
    }

    public function store(Request $request)
    {
        // 新しい投稿追加に使用予定
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
        // 投稿の削除に使用予定
    }
}
