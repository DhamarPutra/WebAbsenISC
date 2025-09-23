@php
    $layout = match (auth()->user()->role) {
        'admin' => 'layouts.admin',
        'koor' => 'layouts.koor',
        'user' => 'layouts.user',
    };
@endphp

@extends($layout)

@section('title', 'Scan Absen')

@section('content')
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg text-center">
        @csrf
        <div id="interactive" class="w-full h-64 border-2 border-gray-300 rounded mb-4 overflow-hidden"></div>

        <div id="resultArea" class="hidden">
            <div id="statusIcon" class="flex justify-center mb-2"></div>
            <h2 id="statusMessage" class="text-lg font-semibold"></h2>
        </div>

        <div id="scanning" class="text-gray-900">
            <span class="animate-pulse">Scanning...</span>
        </div>

        <div class="mt-4 mb-4">
            Pertemuan Terakhir: Ke-<span id="pertemuanTerakhir"></span>
            <label for="pertemuan" class="block text-gray-700 mb-2">Pilih Pertemuan:</label>
            <select id="pertemuan" class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="" disabled selected>Pilih pertemuan</option>
                @for ($i = 1; $i <= 14; $i++)
                    <option value="{{ $i }}">Pertemuan {{ $i }}</option>
                @endfor
            </select>
        </div>

        <a href="{{ route('absen.cek') }}" class="block text-white p-2 rounded bg-blue-500 hover:bg-blue-700 mt-2">Cek
            Absen</a>
        <form action="{{ route('absen.mark') }}" method="post">
            @csrf
            <input type="hidden" id="akhiriPertemuan" name="pertemuan">
            <button type="submit" class="block text-white p-2 rounded bg-red-500 hover:bg-red-700 mt-2">Akhiri
                Pertemuan</button>
        </form>
    </div>
    <script src="https://unpkg.com/@ericblade/quagga2@1.2.6/dist/quagga.min.js"></script>
    <script src="../assets/js/scanner.js"></script>
@endsection
