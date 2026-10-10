@extends('layouts.app')

@section('title', 'Edit Hobby')

@section('content')
    <section class="card">
        <h1>Edit hobby</h1>
        <form method="POST" action="{{ route('hobbies.update', $hobby) }}">
            @csrf
            @method('PUT')
            @include('hobbies._form', ['submitLabel' => 'Simpan perubahan'])
        </form>
    </section>
@endsection
