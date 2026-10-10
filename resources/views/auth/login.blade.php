@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <section class="card" style="max-width: 520px; margin: 32px auto;">
        <h1>Login</h1>
        <p class="muted">Masuk untuk mengelola hobby milik Anda.</p>

        <form method="POST" action="{{ route('login.store') }}">
            @csrf
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username" autofocus>
            @error('email') <div class="error">{{ $message }}</div> @enderror

            <label for="password">Password</label>
            <input id="password" name="password" type="password" required autocomplete="current-password">
            @error('password') <div class="error">{{ $message }}</div> @enderror

            <p style="margin-top: 22px"><button type="submit">Masuk</button></p>
        </form>
        <p class="muted">Belum punya akun? <a class="link" href="{{ route('register') }}">Daftar</a></p>
    </section>
@endsection
