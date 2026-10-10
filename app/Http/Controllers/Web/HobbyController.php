<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HobbyController extends Controller
{
    public function index(Request $request): View
    {
        $hobbies = $request->user()->hobbies()->latest()->paginate(10);

        return view('hobbies.index', compact('hobbies'));
    }

    public function create(): View
    {
        return view('hobbies.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $request->user()->hobbies()->create($data);

        return redirect()->route('hobbies.index')->with('status', 'Hobby berhasil ditambahkan.');
    }

    public function edit(Request $request, string $hobby): View
    {
        $record = $request->user()->hobbies()->findOrFail($hobby);

        return view('hobbies.edit', ['hobby' => $record]);
    }

    public function update(Request $request, string $hobby): RedirectResponse
    {
        $record = $request->user()->hobbies()->findOrFail($hobby);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        $record->update($data);

        return redirect()->route('hobbies.index')->with('status', 'Hobby berhasil diperbarui.');
    }

    public function destroy(Request $request, string $hobby): RedirectResponse
    {
        $request->user()->hobbies()->findOrFail($hobby)->delete();

        return redirect()->route('hobbies.index')->with('status', 'Hobby berhasil dihapus.');
    }
}
