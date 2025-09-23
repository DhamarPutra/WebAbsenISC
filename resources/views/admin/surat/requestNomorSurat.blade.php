@extends('layouts.admin')

@section('title', 'Request Nomor Surat')
@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 sm:p-8 rounded shadow">
        <form action="{{ route('nomor-surat.store') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="jenis_surat_id" class="block font-medium mb-2">Pilih Jenis Surat</label>
                <select name="jenis_surat_id" id="jenis_surat_id"
                    class="w-full border rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Pilih --</option>
                    @foreach ($jenisSurat as $jenis)
                        <option value="{{ $jenis->id }}">{{ $jenis->kode_jenis }} - {{ $jenis->nama_jenis }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white px-4 py-3 rounded font-semibold hover:bg-blue-700 transition">
                Simpan
            </button>
        </form>
    </div>
@endsection
