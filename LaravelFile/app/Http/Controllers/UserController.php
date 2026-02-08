<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $user = User::firstOrCreate(
            ['firebase_uid' => $request->firebase_uid],
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => null,
            ]
        );

        return response()->json($user, 201);
    }

    public function show(Request $request)
    {
        $firebase_uid = $request->query('firebase_uid');

        $user = User::where('firebase_uid', $firebase_uid)->first();

        if (!$user) {
            return response()->json(['message' => 'ユーザーが見つかりません'], 404);
        }

        return response()->json($user);
    }
}
