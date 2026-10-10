@extends('layouts.app')

@section('title', 'Tambah Hobby')

@section('content')
    <section class="card">
        <h1>Tambah hobby</h1>
        <form method="POST" action="{{ route('hobbies.store') }}">
            @csrf
            @include('hobbies._form', ['hobby' => null, 'submitLabel' => 'Simpan'])
        </form>
    </section>
@endsection
