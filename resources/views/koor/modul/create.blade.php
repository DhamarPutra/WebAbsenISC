@php
    $layout = match (auth()->user()->role) {
        'admin' => 'layouts.admin',
        'koor' => 'layouts.koor',
        'user' => 'layouts.user',
    };
@endphp

@extends($layout)

@section('title', 'Input Modul')

@section('content')
    <form action="{{ route('modul.store') }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-6 sm:p-8 rounded-lg shadow-lg max-w-md mx-auto">
        @csrf

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2" for="judul">Judul Modul</label>
            <input type="text" name="judul" id="judul" required
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Judul Modul..." />
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2" for="deskripsi">Deskripsi Modul</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" required
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Deskripsi lengkap..."></textarea>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2" for="tanggal">Tanggal Modul</label>
            <input type="date" name="tanggal" id="tanggal" required
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2" for="file_path">Upload File Modul</label>
            <input type="file" name="file_path" id="file_path" accept=".docx,.ppt,.pptx,.doc,.pdf" required
                class="w-full border p-2 rounded-lg" />
        </div>

        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300">
            Simpan Modul
        </button>
    </form>
@endsection
