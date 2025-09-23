@extends('layouts.admin')
@section('title', 'List Event')
@section('content')
    @forelse($events as $event)
        <div class="border rounded-lg mb-4 p-4 flex items-center justify-between">
            <div class="flex items-start gap-4">
                @if ($event->image_path)
                    <img src="{{ asset('storage/' . $event->image_path) }}" alt="Event Image"
                        class="w-24 h-24 object-cover rounded">
                @else
                    <div class="w-24 h-24 bg-gray-200 rounded flex items-center justify-center text-sm text-gray-600">No
                        Image</div>
                @endif

                <div>
                    <h2 class="font-semibold text-lg">{{ $event->judul }}</h2>
                    <p class="text-sm text-gray-700">Tanggal:
                        {{ \Carbon\Carbon::parse($event->tanggal_mulai)->format('d M Y') }} -
                        {{ \Carbon\Carbon::parse($event->tanggal_selesai)->format('d M Y') }}</p>
                    <p class="text-sm text-gray-700">Harga: Rp{{ number_format($event->harga, 0, ',', '.') }}</p>
                </div>
            </div>

            <form action="{{ route('event.destroy', $event->id) }}" method="POST"
                onsubmit="return confirm('Yakin ingin menghapus event ini?')">
                @csrf
                @method('DELETE')
                <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Hapus</button>
            </form>
        </div>
    @empty
        <p class="text-gray-600">Belum ada event yang dibuat.</p>
    @endforelse
@endsection
