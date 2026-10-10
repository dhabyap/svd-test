@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <section class="card">
        <h1>Edit User</h1>
        <form method="POST" action="{{ route('web.users.update', $user) }}">
            @csrf
            @method('PUT')
            @include('users._form', ['submitLabel' => 'Simpan Perubahan'])
        </form>
    </section>
@endsection