@php
    $layout = match (auth()->user()->role) {
        'admin' => 'layouts.admin',
        'koor' => 'layouts.koor',
        'user' => 'layouts.user',
    };
    $current = $mahasiswa->currentPage();
    $last = $mahasiswa->lastPage();
@endphp

@extends($layout)

@section('title', 'List Mahasiswa')

@section('content')
    <style>
        abbr {
            text-decoration: none;
            border-bottom: none;
            cursor: help;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
    <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        @if ($bidang)
            <h1 class="text-xl md:text-2xl font-bold text-blue-700">
                Bidang: {{ $bidang }} ({{ $count }} Orang)
            </h1>
        @else
            <h1 class="text-xl md:text-2xl font-bold text-blue-700">
                Bidang: ALL ({{ $count }} Orang)
            </h1>
        @endif

        <!-- Search box -->
        <form action="{{ route('bidang.index') }}" method="GET"
            class="flex flex-col sm:flex-row items-stretch gap-2 w-full md:w-auto">
            @if ($bidang)
                <input type="hidden" name="bidang" value="{{ $bidang }}">
            @endif

            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama mahasiswa..."
                class="border rounded px-4 py-2 w-full sm:w-64 focus:ring-2 focus:ring-blue-400" autocomplete="off" />

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded w-full sm:w-auto">
                Cari
            </button>
        </form>
    </div>

    @if ($mahasiswa->isEmpty())
        <div class="text-center text-gray-600">
            Belum ada mahasiswa di bidang ini.
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full table-auto bg-white rounded-lg shadow-md overflow-hidden">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            ID ISC
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            Nama Mahasiswa
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            NIM
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Peminatan</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold">Hadir</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($mahasiswa as $mhs)
                        <tr class="border-b hover:bg-blue-100">
                            <td class="px-6 py-4">
                                <abbr title="{{ $mhs->id_isc }}">{{ Str::mask($mhs->id_isc, '*', '-3') }}</abbr>
                            </td>
                            <td class="px-6 py-4">{{ Str::title($mhs->nama_mahasiswa) }}</td>
                            <td class="px-6 py-4">
                                <abbr title="{{ $mhs->nim }}">{{ Str::mask($mhs->nim, '*', '-4') }}</abbr>
                            </td>
                            <td class="px-6 py-4">{{ ucfirst($mhs->peminatan) }}</td>
                            <td class="px-6 py-4 text-center">{{ ucfirst($mhs->absens_hadir_count) }}/14</td>
                            <td class="px-6 py-4 space-x-2 flex justify-center">
                                @if (auth()->user()->has_access_mobile === 1)
                                <a href="{{ route('mahasiswa.edit', $mhs->id_isc) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-black p-2 rounded-full flex items-center justify-center"
                                    title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>
                                </a>
                                @endif
                                <form action="{{ route('mahasiswa.destroy', $mhs->id_isc) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin mau hapus mahasiswa ini?')"
                                        class="bg-red-500 hover:bg-red-600 text-white text-sm p-2 rounded-full"
                                        title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </form>
                                <div x-data="{ open: false }" class="text-center">
                                    <!-- Button -->
                                    <button @click="open = true"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-black p-2 rounded-full flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>

                                    <!-- Modal -->
                                    <div x-show="open" x-cloak
                                        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
                                        <div class="bg-white p-6 rounded shadow-lg max-w-sm w-full text-center relative">
                                            <h2 class="text-lg font-bold mb-4">Barcode ID ISC</h2>
                                            <img src="https://barcode.tec-it.com/barcode.ashx?data={{ $mhs->id_isc }}&translate-esc=on"
                                                alt="Barcode {{ $mhs->id_isc }}" class="mx-auto max-w-full h-auto" />
                                            <h4 class="text-m font-bold mt-4">{{ $mhs->nama_mahasiswa }}</h4>
                                            <button @click="open = false"
                                                class="mt-4 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">
                                                Tutup
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6 flex flex-wrap justify-center gap-2">
            {{-- Prev --}}
            @if ($mahasiswa->onFirstPage())
                <span class="px-3 py-2 border border-gray-300 bg-gray-200 text-gray-500 text-sm rounded cursor-not-allowed">
                    Prev
                </span>
            @else
                <a href="{{ $mahasiswa->previousPageUrl() }}"
                    class="px-3 py-2 border border-gray-300 bg-white hover:bg-blue-100 text-blue-600 text-sm rounded transition">
                    Prev
                </a>
            @endif

            {{-- Pagination logic for 7 items total (including Prev/Next and ...) --}}
            @if ($last <= 5) {{-- If total pages ≤ 5, show all --}} @for ($i = 1; $i <= $last; $i++)
                    @if ($i == $current)
                        <span class="px-3 py-2 border border-blue-500 bg-blue-500 text-white text-sm font-semibold rounded">
                            {{ $i }}
                        </span>
                    @else
                        <a href="{{ $mahasiswa->url($i) }}"
                            class="px-3 py-2 border border-gray-300 bg-white hover:bg-blue-100 text-blue-600 text-sm rounded transition">
                            {{ $i }}
                        </a>
                    @endif
                @endfor
            @else
                {{-- First part --}}
                @if ($current <= 3)
                    @for ($i = 1; $i <= 4; $i++)
                        @if ($i == $current)
                            <span
                                class="px-3 py-2 border border-blue-500 bg-blue-500 text-white text-sm font-semibold rounded">
                                {{ $i }}
                            </span>
                        @else
                            <a href="{{ $mahasiswa->url($i) }}"
                                class="px-3 py-2 border border-gray-300 bg-white hover:bg-blue-100 text-blue-600 text-sm rounded transition">
                                {{ $i }}
                            </a>
                        @endif
                    @endfor
                    <span class="px-2 py-2 text-gray-500">...</span>
                    {{-- Middle part --}}
                @elseif ($current > 3 && $current < $last - 2)
                    <span class="px-2 py-2 text-gray-500">...</span>
                    @for ($i = $current - 1; $i <= $current + 1; $i++)
                        @if ($i == $current)
                            <span
                                class="px-3 py-2 border border-blue-500 bg-blue-500 text-white text-sm font-semibold rounded">
                                {{ $i }}
                            </span>
                        @else
                            <a href="{{ $mahasiswa->url($i) }}"
                                class="px-3 py-2 border border-gray-300 bg-white hover:bg-blue-100 text-blue-600 text-sm rounded transition">
                                {{ $i }}
                            </a>
                        @endif
                    @endfor
                    <span class="px-2 py-2 text-gray-500">...</span>
                    {{-- Last part --}}
                @else
                    <span class="px-2 py-2 text-gray-500">...</span>
                    @for ($i = $last - 3; $i <= $last; $i++)
                        @if ($i == $current)
                            <span
                                class="px-3 py-2 border border-blue-500 bg-blue-500 text-white text-sm font-semibold rounded">
                                {{ $i }}
                            </span>
                        @else
                            <a href="{{ $mahasiswa->url($i) }}"
                                class="px-3 py-2 border border-gray-300 bg-white hover:bg-blue-100 text-blue-600 text-sm rounded transition">
                                {{ $i }}
                            </a>
                        @endif
                    @endfor
                @endif
            @endif

            {{-- Next --}}
            @if ($mahasiswa->hasMorePages())
                <a href="{{ $mahasiswa->nextPageUrl() }}"
                    class="px-3 py-2 border border-gray-300 bg-white hover:bg-blue-100 text-blue-600 text-sm rounded transition">
                    Next
                </a>
            @else
                <span
                    class="px-3 py-2 border border-gray-300 bg-gray-200 text-gray-500 text-sm rounded cursor-not-allowed">
                    Next
                </span>
            @endif
        </div>
    @endif
@endsection
