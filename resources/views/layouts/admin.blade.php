<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/img/isc192.png" type="image/x-icon">
    <title>ISC | @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .scrollbar-custom::-webkit-scrollbar {
            width: 6px;
        }

        .scrollbar-custom::-webkit-scrollbar-track {
            background: transparent;
        }

        .scrollbar-custom::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .scrollbar-custom::-webkit-scrollbar-thumb:hover {
            background-color: rgba(255, 255, 255, 0.6);
        }
    </style>
</head>

<body x-data="{ sidebarOpen: false }" class="bg-gray-100 h-screen overflow-hidden flex">
    <!-- Sidebar -->
    <aside
        class="fixed inset-y-0 left-0 z-30 w-64 bg-blue-600 text-white flex flex-col p-4 transform transition-transform duration-300 ease-in-out
        lg:translate-x-0 lg:static lg:inset-0"
        :class="{ '-translate-x-full': !sidebarOpen }" @click.away="sidebarOpen = false">
        <div class="text-xl font-bold mb-8">
            ISC | Admin
        </div>
        <nav class="flex-1 overflow-y-auto px-2 space-y-2 scrollbar-custom">
            <a href="{{ route('dashboard.admin') }}" class="block p-2 rounded hover:bg-blue-700">Dashboard</a>
            <div x-data="{ openDropdown: null }" class="space-y-2">
                <!-- Input ABSEN -->
                <div class="relative">
                    <button @click="openDropdown === 'absen' ? openDropdown = null : openDropdown = 'absen'"
                        class="block w-full text-left p-2 rounded hover:bg-blue-700 focus:outline-none">
                        Absen ▾
                    </button>
                    <div x-show="openDropdown === 'absen'" @click.away="openDropdown = null"
                        class="bg-blue-500 rounded shadow mt-2 space-y-2 p-2 absolute left-0 w-full z-10">
                        <a href="{{ route('absen.scan') }}" class="block p-2 rounded hover:bg-blue-700">Scan</a>
                        <a href="{{ route('absen.manual') }}" class="block p-2 rounded hover:bg-blue-700">Manual</a>
                    </div>
                </div>
                <!-- Input CMS -->
                <div class="relative">
                    <button @click="openDropdown === 'cms' ? openDropdown = null : openDropdown = 'cms'"
                        class="block w-full text-left p-2 rounded hover:bg-blue-700 focus:outline-none">
                        Input CMS ▾
                    </button>
                    <div x-show="openDropdown === 'cms'" @click.away="openDropdown = null"
                        class="bg-blue-500 rounded shadow mt-2 space-y-2 p-2 absolute left-0 w-full z-10">
                        <a href="{{ route('acara.create') }}" class="block p-2 rounded hover:bg-blue-700">Input Berita
                            Acara</a>
                        <a href="{{ route('kegiatan.create') }}" class="block p-2 rounded hover:bg-blue-700">Input
                            Kegiatan</a>
                    </div>
                </div>

                <!-- List Mahasiswa -->
                <div class="relative">
                    <button @click="openDropdown === 'mahasiswa' ? openDropdown = null : openDropdown = 'mahasiswa'"
                        class="block w-full text-left p-2 rounded hover:bg-blue-700 focus:outline-none">
                        List Mahasiswa ▾
                    </button>
                    <div x-show="openDropdown === 'mahasiswa'" @click.away="openDropdown = null"
                        class="bg-blue-500 rounded shadow mt-2 space-y-2 p-2 absolute left-0 w-full z-10">
                        <a href="{{ route('bidang.index') }}" class="block p-2 hover:bg-blue-600 rounded">All</a>
                        <a href="{{ route('bidang.index', ['bidang' => 'Website Development']) }}"
                            class="block p-2 hover:bg-blue-600 rounded">Web Development</a>
                        <a href="{{ route('bidang.index', ['bidang' => 'Data Science']) }}"
                            class="block p-2 hover:bg-blue-600 rounded">Data Science</a>
                        <a href="{{ route('bidang.index', ['bidang' => 'UI/UX Design']) }}"
                            class="block p-2 hover:bg-blue-600 rounded">UI/UX Design</a>
                        <a href="{{ route('admin.password.requests') }}"
                            class="block p-2 hover:bg-blue-600 rounded">Request Password</a>
                    </div>
                </div>

                <!-- Tool Sekertaris -->
                <div class="relative">
                    <button @click="openDropdown === 'sekretaris' ? openDropdown = null : openDropdown = 'sekretaris'"
                        class="block w-full text-left p-2 rounded hover:bg-blue-700 focus:outline-none">
                        Tool Sekretaris ▾
                    </button>
                    <div x-show="openDropdown === 'sekretaris'" @click.away="openDropdown = null"
                        class="bg-blue-500 rounded shadow mt-2 space-y-2 p-2 absolute left-0 w-full z-10">
                        <a href="{{ route('jenis-surat.create') }}" class="block p-2 rounded hover:bg-blue-700">Input
                            Jenis Surat</a>
                        <a href="{{ route('nomor-surat.create') }}" class="block p-2 rounded hover:bg-blue-700">Request
                            Nomor Surat</a>
                        <a href="{{ route('nomor-surat.index') }}" class="block p-2 rounded hover:bg-blue-700">List
                            Nomor Surat</a>
                    </div>
                </div>

                <!-- Tool Modul -->
                <div class="relative">
                    <button @click="openDropdown === 'modul' ? openDropdown = null : openDropdown = 'modul'"
                        class="block w-full text-left p-2 rounded hover:bg-blue-700 focus:outline-none">
                        Tool Modul ▾
                    </button>
                    <div x-show="openDropdown === 'modul'" @click.away="openDropdown = null"
                        class="bg-blue-500 rounded shadow mt-2 space-y-2 p-2 absolute left-0 w-full z-10">
                        <a href="{{ route('modul.create') }}" class="block p-2 rounded hover:bg-blue-700">Upload
                            Modul</a>
                        <a href="{{ route('modul.index') }}" class="block p-2 rounded hover:bg-blue-700">List Modul</a>
                    </div>
                </div>

                <!-- Tool Event -->
                <div class="relative">
                    <button @click="openDropdown === 'event' ? openDropdown = null : openDropdown = 'event'"
                        class="block w-full text-left p-2 rounded hover:bg-blue-700 focus:outline-none">
                        Tool Event ▾
                    </button>
                    <div x-show="openDropdown === 'event'" @click.away="openDropdown = null"
                        class="bg-blue-500 rounded shadow mt-2 space-y-2 p-2 absolute left-0 w-full z-10">
                        <a href="{{ route('event.create') }}" class="block p-2 rounded hover:bg-blue-700">Buat
                            Event</a>
                        <a href="{{ route('event.index') }}" class="block p-2 rounded hover:bg-blue-700">List Event</a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="mt-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left p-2 mt-4 bg-red-500 rounded hover:bg-red-600">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col h-screen overflow-y-auto transition-all duration-300">
        <!-- Topbar -->
        <header class="bg-white shadow p-4 flex justify-between items-center sticky top-0 z-40">
            <!-- Tombol sandwich menu -->
            <button @click="$nextTick(() => sidebarOpen = !sidebarOpen)" class="text-gray-700 lg:hidden z-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <h1 class="text-xl font-semibold">@yield('title')</h1>
        </header>

        <div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-50 z-20 lg:hidden"
            @click="sidebarOpen = false">
        </div>

        <!-- Content -->
        <main class="flex-1 p-6">
            @yield('content')
            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session('success') }}',
                        showConfirmButton: false,
                        timer: 3000
                    });
                </script>
            @endif

            @if (session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: '{{ session('error') }}',
                        showConfirmButton: false,
                        timer: 3000
                    });
                </script>
            @endif
        </main>

        <!-- Footer -->
        <footer class="bg-gray-200 p-4 text-center text-gray-600">
            &copy;{{ date('Y') }} ISC | Dhamar Putra Pangestu
        </footer>
    </div>
</body>

</html>
