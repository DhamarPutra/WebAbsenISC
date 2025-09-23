@php
    $layout = match (auth()->user()->role) {
        'admin' => 'layouts.admin',
        'koor' => 'layouts.koor',
        'user' => 'layouts.user',
    };
@endphp

@extends($layout)

@section('title', 'List Modul')

@section('content')
    <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-lg">
        @if ($modul->isEmpty())
            <div class="text-gray-600 text-center py-10">
                Belum ada modul yang tersedia.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg shadow-md text-sm">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="px-4 sm:px-6 py-3 text-left font-semibold">Judul Modul</th>
                            <th class="px-4 sm:px-6 py-3 text-left font-semibold">Bidang</th>
                            <th class="px-4 sm:px-6 py-3 text-left font-semibold">Uploader</th>
                            <th class="px-4 sm:px-6 py-3 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($modul as $item)
                            <tr class="border-b hover:bg-blue-100">
                                <td class="px-4 sm:px-6 py-3 whitespace-normal break-words max-w-xs sm:max-w-none">
                                    {{ $item->judul }}</td>
                                <td class="px-4 sm:px-6 py-3 capitalize whitespace-nowrap">
                                    {{ str_replace('_', '/', $item->bidang) }}</td>
                                <td class="px-4 sm:px-6 py-3 capitalize whitespace-nowrap">{{ $item->uploader }}</td>
                                <td class="px-4 sm:px-6 py-3 flex justify-center space-x-2 whitespace-nowrap">
                                    <a href="https://drive.google.com/uc?export=download&id={{ $item->gdrive_file_id }}"
                                        download
                                        class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-full flex items-center justify-center"
                                        title="Download File">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3" />
                                        </svg>
                                    </a>
                                    <a href="https://drive.google.com/file/d/{{ $item->gdrive_file_id }}/view"
                                        target="_blank"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-full flex items-center justify-center"
                                        title="Lihat File (Preview)">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    @if (auth()->user()->role == 'admin')
                                        <form action="{{ route('modul.destroy', $item->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin mau hapus modul ini?')"
                                                class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-full flex items-center justify-center"
                                                title="Hapus File">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0a2 2 0 012 2v0a2 2 0 01-2 2h-1M7 7h1" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
