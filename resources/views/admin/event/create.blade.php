@extends('layouts.admin')
@section('title', 'Buat Event Baru')
@section('content')
    <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Judul Event</label>
            <input type="text" name="judul" required class="w-full border p-2 rounded" placeholder="Judul event...">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" required class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" required class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Harga Tiket (Rp)</label>
            <input type="number" name="harga" min="0" required class="w-full border p-2 rounded" placeholder="0">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Upload Poster</label>
            <input type="file" name="image" accept="image/*" class="w-full border p-2 rounded">
        </div>

        <button type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Simpan</button>
    </form>
@endsection
