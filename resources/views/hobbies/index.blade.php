@extends('layouts.app')

@section('title', 'Hobby Saya')

@section('content')
    <section class="card">
        <div class="row">
            <div>
                <h1>Hobby Saya</h1>
                <p class="muted">Daftar ini hanya menampilkan hobby milik akun Anda.</p>
            </div>
            <a class="button" href="{{ route('hobbies.create') }}">Tambah hobby</a>
        </div>

        @forelse ($hobbies as $hobby)
            <article class="hobby row">
                <strong>{{ $hobby->name }}</strong>
                <div class="actions">
                    <a class="button secondary" href="{{ route('hobbies.edit', $hobby) }}">Edit</a>
                    <form method="POST" action="{{ route('hobbies.destroy', $hobby) }}" onsubmit="return confirm('Hapus hobby ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="button danger" type="submit">Hapus</button>
                    </form>
                </div>
            </article>
        @empty
            <p class="muted">Belum ada hobby. Tambahkan hobby pertama Anda.</p>
        @endforelse

        @if ($hobbies->hasPages())
            <div style="margin-top: 18px">{{ $hobbies->links() }}</div>
        @endif
    </section>
@endsection
