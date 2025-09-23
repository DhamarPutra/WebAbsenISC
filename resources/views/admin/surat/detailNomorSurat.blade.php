@extends('layouts.admin')

@section('title', 'Detail Nomor Surat')
@section('content')
    <style>
        .nomor-surat {
            font-family: serif;
        }
    </style>
    <div class="max-w-3xl mx-auto bg-white p-4 sm:p-6 rounded shadow">
        <div class="mb-6">
            <h2 class="text-lg font-bold text-gray-700 mb-4">Data Surat</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm sm:text-base">
                <p><strong>Nomor Surat:</strong> <span class="nomor-surat">{{ $surat->nomor_surat }}</span></p>
                <p><strong>Jenis Surat:</strong> {{ $surat->jenisSurat->nama_jenis }}</p>
                <p><strong>Tanggal Pengajuan:</strong>
                    {{ \Carbon\Carbon::parse($surat->tanggal_pengajuan)->locale('id')->translatedFormat('d F Y') }}</p>
                <p><strong>Waktu Pengajuan:</strong> {{ $surat->waktu_pengajuan }}</p>
                <p><strong>Status:</strong> {{ ucfirst($surat->status) }}</p>
            </div>
        </div>

        <div>
            <h2 class="text-lg font-bold text-gray-700 mb-4">Data Pemohon</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm sm:text-base">
                <p><strong>Nama:</strong> {{ $surat->mahasiswa->nama_mahasiswa }}</p>
                <p><strong>NIM:</strong> {{ $surat->mahasiswa->nim }}</p>
                <p><strong>Peminatan:</strong> {{ $surat->mahasiswa->peminatan ?? '-' }}</p>
            </div>
        </div>
    </div>
@endsection
