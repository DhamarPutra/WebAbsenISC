@extends('layouts.admin')

@section('title', 'Daftar Nomor Surat')
@section('content')
    <style>
        .nomor-surat {
            font-family: serif;
        }
    </style>
    <div class="bg-white p-4 sm:p-6 rounded shadow overflow-x-auto">
        <table class="w-full border text-sm text-center min-w-[600px] sm:min-w-full">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="p-2 whitespace-nowrap">#</th>
                    <th class="p-2 whitespace-nowrap">Nomor Surat</th>
                    <th class="p-2 whitespace-nowrap">Jenis Surat</th>
                    <th class="p-2 whitespace-nowrap">Tanggal</th>
                    <th class="p-2 whitespace-nowrap">Status</th>
                    <th class="p-2 whitespace-nowrap">Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nomorSurat as $index => $surat)
                    <tr class="border hover:bg-gray-100">
                        <td class="p-2 whitespace-nowrap">{{ $index + 1 }}</td>
                        <td class="p-2 nomor-surat whitespace-nowrap">{{ $surat->nomor_surat }}</td>
                        <td class="p-2 whitespace-nowrap">{{ $surat->jenisSurat->nama_jenis }}</td>
                        <td class="p-2 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($surat->tanggal_pengajuan)->locale('id')->translatedFormat('d F Y') }}
                        </td>
                        <td class="p-2 whitespace-nowrap">{{ ucfirst($surat->status) }}</td>
                        <td class="p-2 whitespace-nowrap">
                            <a href="{{ route('nomor-surat.show', $surat->id) }}"
                                class="inline-block bg-blue-100 hover:bg-blue-200 text-blue-600 text-sm p-2 rounded-full"
                                title="Lihat">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
