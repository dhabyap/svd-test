@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
    <section class="card" style="max-width: 520px; margin: 32px auto;">
        <h1>Buat akun</h1>
        <p class="muted">Daftar untuk mulai mengelola hobby Anda.</p>

        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <label for="name">Nama</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" maxlength="255" required autocomplete="name" autofocus>
            @error('name') <div class="error">{{ $message }}</div> @enderror

            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email') <div class="error">{{ $message }}</div> @enderror

            <label for="password">Password</label>
            <input id="password" name="password" type="password" required minlength="8" autocomplete="new-password">
            @error('password') <div class="error">{{ $message }}</div> @enderror

            <label for="password_confirmation">Konfirmasi password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required minlength="8" autocomplete="new-password">

            <p style="margin-top: 22px"><button type="submit">Daftar</button></p>
        </form>
        <p class="muted">Sudah punya akun? <a class="link" href="{{ route('login') }}">Login</a></p>
    </section>
@endsection
