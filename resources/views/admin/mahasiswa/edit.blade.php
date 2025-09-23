@php
    $layout = match(auth()->user()->role) {
        'admin' => 'layouts.admin',
        'koor' => 'layouts.koor',
        'user' => 'layouts.user',
    };
@endphp

@extends($layout)

@section('title', 'Edit Mahasiswa')

@section('content')
<form action="{{ route('mahasiswa.update', $mahasiswa->id_isc) }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
    @csrf
    @method('PUT')

    <div>
        <label class="block text-gray-700 font-semibold mb-2" for="id_isc">ID ISC</label>
        <input type="text" name="id_isc" id="id_isc" value="{{ $mahasiswa->id_isc }}" required
            class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" readonly>
    </div>

    <div>
        <label class="block text-gray-700 font-semibold mb-2" for="nama_mahasiswa">Nama Mahasiswa</label>
        <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" value="{{ $mahasiswa->nama_mahasiswa }}" required
            class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>

    <div>
        <label class="block text-gray-700 font-semibold mb-2" for="nim">NIM</label>
        <input type="text" name="nim" id="nim" value="{{ $mahasiswa->nim }}" required
            class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>

    <div>
        <label class="block text-gray-700 font-semibold mb-2" for="peminatan">Peminatan</label>
        <select name="peminatan" id="peminatan" required
            class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            <option value="Website Development" {{ $mahasiswa->peminatan == 'Website Development' ? 'selected' : '' }}>Web Development</option>
            <option value="Data Science" {{ $mahasiswa->peminatan == 'Data Science' ? 'selected' : '' }}>Data Science</option>
            <option value="UI/UX Design" {{ $mahasiswa->peminatan == 'UI/UX Design' ? 'selected' : '' }}>UI/UX Design</option>
        </select>
    </div>

    <div>
        <label class="block text-gray-700 font-semibold mb-2" for="role">Role</label>
        <select name="role" id="role" required
            class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            <option value="admin" {{ $role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="koor" {{ $role == 'koor' ? 'selected' : '' }}>Koor</option>
            <option value="user" {{ $role == 'user' ? 'selected' : '' }}>User</option>
        </select>
        @if (!$user)
        <p class="mt-2 text-sm text-gray-500 italic">* User ini belum terdaftar.</p>
        @endif
    </div>

    <div class="flex justify-end">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
            Simpan Perubahan
        </button>
    </div>
</form>
@endsection