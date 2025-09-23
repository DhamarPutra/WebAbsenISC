@php
$layout = match (auth()->user()->role) {
'admin' => 'layouts.admin',
'koor' => 'layouts.koor',
'user' => 'layouts.user',
};
@endphp

@extends($layout)

@section('title', 'Presensi Saya')

@section('content')
<style>
    [x-cloak] {
        display: none !important;
    }
</style>
<div class="max-w-5xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow">
    <p class="text-sm sm:text-base text-gray-500 mb-4">
        Hi <strong>{{ auth()->user()->nama_mahasiswa }}</strong>, berikut rekap presensi kamu.
    </p>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 text-sm text-center">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="py-2 px-2 border">Pertemuan</th>
                    <th class="py-2 px-2 border">Status</th>
                    <th class="py-2 px-2 border">Bar Code</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 14; $i++) @php $absen=$absens->firstWhere('pertemuan', $i);
                    $status = $absen->status ?? null;
                    $id_isc = auth()->user()->id_isc;

                    if ($status === 'Hadir') {
                    $label = '✅ Hadir';
                    $color = 'text-green-600';
                    } elseif ($status === 'Tidak Hadir') {
                    $label = '❌ Tidak Hadir';
                    $color = 'text-red-600';
                    } else {
                    $label = '⏳ Belum Presensi';
                    $color = 'text-gray-500';
                    }
                    @endphp

                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-2 sm:px-4 border whitespace-nowrap">Ke-{{ $i }}</td>
                        <td class="py-2 px-2 sm:px-4 border {{ $color }}">{{ $label }}</td>
                        @if ($status == 'Hadir')
                        <td class="py-2 px-2 sm:px-4 border text-gray-500 break-words">{{ $id_isc }}</td>
                        @else
                        <td class="py-2 px-2 sm:px-4 border">
                            <div x-data="{ open: false }" class="text-center">
                                <button @click="open = true" class="text-blue-600 hover:underline truncate max-w-[120px] sm:max-w-full mx-auto block">
                                    {{ $id_isc }}
                                </button>

                                <!-- Modal -->
                                <div x-show="open" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
                                    <div class="bg-white p-6 rounded shadow-lg max-w-sm w-full text-center relative">
                                        <h2 class="text-lg font-bold mb-4">Barcode ID ISC</h2>
                                        <img src="https://barcode.tec-it.com/barcode.ashx?data={{ $id_isc }}&translate-esc=on" alt="Barcode {{ $id_isc }}" class="mx-auto max-w-full h-auto" />

                                        <button @click="open = false" class="mt-4 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">
                                            Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endfor
            </tbody>
        </table>
    </div>
</div>
@endsection