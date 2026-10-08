<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HobbyController extends Controller
{
    public function index(Request $request, string $user)
    {
        $owner = $this->ownedUser($request, $user);

        return response()->json($owner->hobbies);
    }

    public function store(Request $request, string $user)
    {
        $owner = $this->ownedUser($request, $user);
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $hobby = $owner->hobbies()->create($data);

        return response()->json($hobby, 201);
    }

    public function show(Request $request, string $user, string $hobby)
    {
        $owner = $this->ownedUser($request, $user);

        return response()->json($owner->hobbies()->findOrFail($hobby));
    }

    public function update(Request $request, string $user, string $hobby)
    {
        $owner = $this->ownedUser($request, $user);
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $record = $owner->hobbies()->findOrFail($hobby);
        $record->update($data);

        return response()->json($record->fresh());
    }

    public function destroy(Request $request, string $user, string $hobby)
    {
        $owner = $this->ownedUser($request, $user);
        $record = $owner->hobbies()->findOrFail($hobby);
        $record->delete();

        return response()->json(['message' => 'Hobby deleted successfully']);
    }

    private function ownedUser(Request $request, string $user)
    {
        abort_unless((string) $request->user()->getKey() === $user, 404);

        return $request->user();
    }
}
