@php
    $layout = match (auth()->user()->role) {
        'admin' => 'layouts.admin',
        'koor' => 'layouts.koor',
        'user' => 'layouts.user',
    };
@endphp

@extends($layout)

@section('title', 'Absensi Manual')

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
    <div class="max-w-6xl mx-auto bg-white shadow-md rounded p-6">

        <!-- Filter Dropdown -->
        <form method="GET" action="{{ route('absen.manual') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            {{-- List Bidang --}}
            <div>
                <label class="block font-semibold mb-1">Bidang</label>
                <select name="bidang" onchange="this.form.submit()" class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="">-- Semua Bidang --</option>
                    <option value="website development" {{ $bidang == 'website development' ? 'selected' : '' }}>Web
                        Development</option>
                    <option value="ui/ux design" {{ $bidang == 'ui/ux design' ? 'selected' : '' }}>UI/UX Design</option>
                    <option value="data science" {{ $bidang == 'data science' ? 'selected' : '' }}>Data Science</option>
                </select>
            </div>
            {{-- List Pertemuan --}}
            <div>
                <label class="block font-semibold mb-1">Pertemuan</label>
                <select name="pertemuan" onchange="this.form.submit()"
                    class="w-full border border-gray-300 rounded px-3 py-2">
                    @for ($i = 1; $i <= 14; $i++)
                        <option value="{{ $i }}" {{ $pertemuan == $i ? 'selected' : '' }}>Pertemuan
                            {{ $i }}</option>
                    @endfor
                </select>
            </div>
            {{-- Search Filter --}}
            <div class="mb-4">
                <label for="searchInput" class="block font-semibold mb-1">Cari Mahasiswa</label>
                <input type="text" id="searchInput" placeholder="Cari nama, NIM, atau ID ISC..."
                    class="w-full border border-gray-300 rounded px-3 py-2" autocomplete="off">
            </div>
        </form>

        <!-- Table Presensi -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-left text-sm font-semibold text-gray-700">
                        <th class="px-4 py-2 border">ID ISC</th>
                        <th class="px-4 py-2 border">Nama Mahasiswa</th>
                        <th class="px-4 py-2 border">NIM</th>
                        <th class="px-4 py-2 border">Peminatan</th>
                        <th class="px-4 py-2 border text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswa as $mhs)
                        @php
                            $absen = $mhs->absens->first();
                            $status = $absen->status ?? null;
                        @endphp
                        <tr class="text-sm border-t" data-id="{{ $mhs->id_isc }}">
                            <td class="px-4 py-2 border"><abbr
                                    title="{{ $mhs->id_isc }}">{{ Str::mask($mhs->id_isc, '*', '-3') }}</abbr></td>
                            <td class="px-4 py-2 border">{{ $mhs->nama_mahasiswa }}</td>
                            <td class="px-4 py-2 border"><abbr
                                    title="{{ $mhs->nim }}">{{ Str::mask($mhs->nim, '*', '-4') }}</abbr></td>
                            <td class="px-4 py-2 border">{{ $mhs->peminatan }}</td>
                            <td class="px-4 py-2 border text-center">
                                <div class="inline-flex gap-2">
                                    <button
                                        class="absen-btn px-3 py-1 rounded transition {{ $status === 'Hadir' ? 'bg-green-500 text-white font-semibold' : 'bg-gray-200 text-gray-800 hover:bg-green-100' }}"
                                        data-status="Hadir" data-pertemuan="{{ $pertemuan }}"
                                        data-id="{{ $mhs->id_isc }}">
                                        Hadir
                                    </button>
                                    <button
                                        class="absen-btn px-3 py-1 rounded transition {{ $status === 'Tidak Hadir' ? 'bg-red-500 text-white font-semibold' : 'bg-gray-200 text-gray-800 hover:bg-red-100' }}"
                                        data-status="Tidak Hadir" data-pertemuan="{{ $pertemuan }}"
                                        data-id="{{ $mhs->id_isc }}">
                                        Tidak Hadir
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Seacrh Filter
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('table tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Post Absen
        document.querySelectorAll('.absen-btn').forEach(button => {
            button.addEventListener('click', async function() {
                const idIsc = this.dataset.id;
                const status = this.dataset.status;
                const pertemuan = this.dataset.pertemuan;

                try {
                    const res = await fetch('/api/absen', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            id_isc: idIsc,
                            status: status,
                            pertemuan: pertemuan
                        })
                    });

                    const data = await res.json();

                    if (res.ok) {
                        const row = this.closest('tr');
                        const btns = row.querySelectorAll('.absen-btn');
                        btns.forEach(btn => {
                            btn.classList.remove('bg-green-500', 'bg-red-500', 'text-white',
                                'font-semibold');
                            btn.classList.add('bg-gray-200', 'text-gray-800');
                        });

                        if (status === 'Hadir') {
                            this.classList.add('bg-green-500', 'text-white', 'font-semibold');
                        } else {
                            this.classList.add('bg-red-500', 'text-white', 'font-semibold');
                        }

                        console.log('Absensi berhasil:', data.message);
                    } else {
                        alert('Gagal menyimpan absen: ' + data.message);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengirim data.');
                }
            });
        });
    </script>
@endsection
