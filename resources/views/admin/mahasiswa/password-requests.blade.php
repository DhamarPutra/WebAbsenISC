@extends('layouts.admin')
@section('title', 'Permintaan Ganti Password')
@section('content')
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @forelse($requests as $req)
            <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center text-center">
                <img src="{{ asset('storage/' . $req->selfie_path) }}" alt="Selfie"
                    class="w-32 h-32 object-cover rounded-lg border mb-4">

                <p class="text-sm text-gray-600"><strong>ID ISC:</strong> {{ $req->id_isc }}</p>
                <p class="text-sm text-gray-600 mb-2"><strong>Tanggal:</strong>
                    {{ $req->created_at->format('d M Y H:i') }}</p>

                <div class="flex space-x-2 mt-4">
                    <form action="{{ route('admin.password.approve', $req->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                            Approve
                        </button>
                    </form>

                    <form action="{{ route('admin.password.reject', $req->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                            Reject
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-600 col-span-full text-center">Belum ada permintaan.</p>
        @endforelse
    </div>
@endsection
