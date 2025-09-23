@php
    $layout = match(auth()->user()->role) {
        'admin' => 'layouts.admin',
        'koor' => 'layouts.koor',
        'user' => 'layouts.user',
    };
@endphp

@extends($layout)

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl mb-6">Welcome, <span class="font-semibold">{{ auth()->user()->nama_mahasiswa }}</span></h1>
@endsection