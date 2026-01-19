<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index()
    {
        // 今回は使用せず
    }

    public function store(Request $request)
    {
        // 投稿に対するコメント追加に使用予定
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
        // 今回は使用せず
    }
}
