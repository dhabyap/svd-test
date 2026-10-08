<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return response()->json($request->user()->load('hobbies'));
    }

    public function store(Request $request, User $user)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create($validator->validated());
        return response()->json($user, 201);
    }

    public function show(string $id, Request $request)
    {
        $user = $request->user();


        if ($user->getKey() != $id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($user->load('hobbies'));
    }

    public function update(Request $request, string $id)
    {
        $user = $request->user();

        if ($user->getKey() != $id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $user->id,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user->update($validator->validated());

        return response()->json($user->fresh());
    }

    public function destroy(string $id, Request $request)
    {
        $user = $request->user();

        if ($user->getKey() != $id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
