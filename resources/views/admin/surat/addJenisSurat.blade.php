@extends('layouts.admin')

@section('title', 'Tambah Jenis Surat')
@section('content')
    <style>
        .nomor-surat {
            font-family: serif;
        }
    </style>

    <div class="max-w-xl mx-auto bg-white p-4 sm:p-6 rounded shadow">
        <form action="{{ route('jenis-surat.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="kode_jenis" class="block font-medium text-gray-700">Kode Jenis</label>
                <select name="kode_jenis" id="kode_jenis" class="w-full border rounded px-3 py-2 mt-1 text-sm" required>
                    <option value="" selected hidden>--Pilih Kode Surat--</option>
                    <option value="A.I">A.I - Surat Kegiatan Organisasi</option>
                    <option value="B.I">B.I - Surat Kegiatan Bidang</option>
                    <option value="C.I">C.I - Surat Kegiatan Non-Formal/Lainnya</option>
                </select>
            </div>
            <div>
                <label for="nama_jenis" class="block font-medium text-gray-700">Nama Jenis</label>
                <input type="text" name="nama_jenis" id="nama_jenis" class="w-full border rounded px-3 py-2 mt-1 text-sm"
                    required>
            </div>
            <div>
                <label for="level_surat" class="block font-medium text-gray-700">Level Surat</label>
                <select name="level_surat" id="level_surat" class="w-full border rounded px-3 py-2 mt-1 text-sm" required>
                    <option value="" selected hidden>--Pilih Level Surat--</option>
                    <option value="I">I - Sangat Penting dan Bersifat Mendesak</option>
                    <option value="II">II - Penting dan Bersifat Rutin</option>
                    <option value="III">III - Tidak Mendesak (Opsional)</option>
                </select>
            </div>
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 w-full sm:w-auto">
                Simpan
            </button>
        </form>

        <!-- Tabel Keterangan -->
        <div class="mt-6 overflow-x-auto">
            <table class="w-full min-w-[400px] table-auto bg-white rounded-lg shadow-md">
                <thead class="bg-blue-600 text-white text-sm">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Kode/Level Surat</th>
                        <th class="px-4 py-3 text-left font-semibold">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    <tr class="border-b hover:bg-blue-100">
                        <td class="px-4 py-3 nomor-surat">Kode: A.I</td>
                        <td class="px-4 py-3">Surat Kegiatan Organisasi</td>
                    </tr>
                    <tr class="border-b hover:bg-blue-100">
                        <td class="px-4 py-3 nomor-surat">Kode: B.I</td>
                        <td class="px-4 py-3">Surat Kegiatan Bidang</td>
                    </tr>
                    <tr class="border-b hover:bg-blue-100">
                        <td class="px-4 py-3 nomor-surat">Kode: C.I</td>
                        <td class="px-4 py-3">Surat Kegiatan Non-Formal/Lainnya</td>
                    </tr>
                    <tr class="border-b hover:bg-blue-100">
                        <td class="px-4 py-3 nomor-surat">Level: I</td>
                        <td class="px-4 py-3">Sangat Penting dan Bersifat Mendesak</td>
                    </tr>
                    <tr class="border-b hover:bg-blue-100">
                        <td class="px-4 py-3 nomor-surat">Level: II</td>
                        <td class="px-4 py-3">Penting dan Bersifat Rutin</td>
                    </tr>
                    <tr class="border-b hover:bg-blue-100">
                        <td class="px-4 py-3 nomor-surat">Level: III</td>
                        <td class="px-4 py-3">Tidak Mendesak (Opsional)</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
