@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
    <section class="card">
        <h1>Tambah User</h1>
        <form method="POST" action="{{ route('web.users.store') }}">
            @csrf
            @include('users._form', ['submitLabel' => 'Simpan User'])
        </form>
    </section>
@endsection