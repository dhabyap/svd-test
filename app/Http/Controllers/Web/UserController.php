<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::with('hobbies')->latest()->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        return view('users.create', ['user' => null]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'hobbies' => ['nullable', 'array'],
                'hobbies.*' => ['string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => \Illuminate\Support\Facades\Hash::make($data['password']),
        ]);

        foreach (array_filter($data['hobbies'] ?? []) as $name) {
            $user->hobbies()->create(['name' => $name]);
        }

        return redirect()->route('web.users.index')->with('status', 'User dan daftar hobinya berhasil ditambahkan.');
    }

    public function edit(User $user): View
    {
        $user->load('hobbies');

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'hobbies' => ['nullable', 'array'],
                'hobbies.*' => ['string', 'max:255'],
        ]);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            ...(! empty($data['password']) ? ['password' => \Illuminate\Support\Facades\Hash::make($data['password'])] : []),
        ]);

        $user->hobbies()->delete();
        foreach (array_filter($data['hobbies'] ?? []) as $name) {
            $user->hobbies()->create(['name' => $name]);
        }

        return redirect()->route('web.users.index')->with('status', 'User dan daftar hobinya berhasil diperbarui.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->hobbies()->delete();
        $user->delete();

        return redirect()->route('web.users.index')->with('status', 'User beserta hobinya berhasil dihapus.');
    }
}