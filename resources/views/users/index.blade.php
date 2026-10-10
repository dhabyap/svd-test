@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
    <section class="card">
        <div class="row">
            <div>
                <h1>Daftar User</h1>
                <p class="muted">Setiap user dilengkapi daftar hobi (one-to-many).</p>
            </div>
            <a class="button" href="{{ route('web.users.create') }}">＋ Tambah User</a>
        </div>

        @forelse ($users as $user)
            <article class="hobby row">
                <div>
                    <strong>{{ $user->name }}</strong>
                    <div class="muted">{{ $user->email }}</div>
                    @if ($user->hobbies->isEmpty())
                        <div class="muted">Belum ada hobi.</div>
                    @else
                        <div>
                            @foreach ($user->hobbies as $hobby)
                                <span class="inline">{{ $loop->first ? '' : ', ' }}{{ $hobby->name }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="actions">
                    <a class="button secondary" href="{{ route('web.users.edit', $user) }}">Edit</a>
                                        <form method="POST" action="{{ route('web.users.destroy', $user) }}" onsubmit="return confirm('Hapus user {{ $user->name }} beserta semua hobinya?')">
                        @csrf
                        @method('DELETE')
                        <button class="button danger" type="submit">Hapus</button>
                    </form>
                </div>
            </article>
        @empty
            <p class="muted">Belum ada user. <a class="link" href="{{ route('web.users.create') }}">Buat user pertama</a>.</p>
        @endforelse

        @if ($users->hasPages())
            <div style="margin-top: 18px">{{ $users->links() }}</div>
        @endif
    </section>
@endsection