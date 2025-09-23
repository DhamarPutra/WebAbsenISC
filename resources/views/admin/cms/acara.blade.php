@php
    $layout = match (auth()->user()->role) {
        'admin' => 'layouts.admin',
        'koor' => 'layouts.koor',
        'user' => 'layouts.user',
    };
@endphp

@extends($layout)

@section('title', 'Input Berita')

@section('content')
    <form action="{{ route('acara.store') }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-6 sm:p-8 rounded-lg shadow-lg max-w-md mx-auto">
        @csrf

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2" for="judul">Judul Berita Acara</label>
            <input type="text" name="judul" id="judul" required
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Judul Berita..." />
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2" for="deskripsi">Deskripsi Berita Acara</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" required
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Deskripsi lengkap..."></textarea>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2" for="tanggal">Tanggal Acara</label>
            <input type="date" name="tanggal" id="tanggal" required
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2" for="image_path">Upload Gambar Banner</label>
            <input type="file" name="image_path" id="image_path" accept="image/*" required
                class="w-full border p-2 rounded-lg" />
        </div>

        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300">
            Simpan Berita Acara
        </button>
    </form>
@endsection
