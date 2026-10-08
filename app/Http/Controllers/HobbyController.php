<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HobbyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json($request->user()->hobbies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $hobby = $request->user()->hobbies()->create($request->all());

        return response()->json($hobby, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $user = $request->user();

        if ($user->getKey() != $id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($user->load('hobbies'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = $request->user();

        if ($user->getKey() != $id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $user->getKey(),
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user->update($validator->validated());

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $user, string $hobby)
    {
        $hobby = $request->user()->hobbies()->findOrFail($hobby);

        $hobby->delete();
        return response()->json(['message' => 'Hobby deleted successfully']);
    }
}
