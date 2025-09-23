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
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body x-data="{ sidebarOpen: false }" class="bg-gray-100 h-screen overflow-hidden flex">
    <!-- Sidebar -->
    <aside
        class="fixed inset-y-0 left-0 z-30 w-64 bg-blue-600 text-white flex flex-col p-4 transform transition-transform duration-300 ease-in-out
        lg:translate-x-0 lg:static lg:inset-0"
        :class="{ '-translate-x-full': !sidebarOpen }" @click.away="sidebarOpen = false">
        <div class="text-xl font-bold mb-8">
            ISC | Anggota
        </div>
        <nav class="flex-1 overflow-y-auto px-2 space-y-2 scrollbar-custom">
            <a href="{{ route('dashboard.user') }}" class="block p-2 rounded hover:bg-blue-700">Dashboard</a>
            <a href="{{ route('modul.index') }}" class="block p-2 rounded hover:bg-blue-700">List Modul</a>
            <a href="{{ route('absen.cek') }}" class="block p-2 rounded hover:bg-blue-700">Cek Absen</a>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
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
