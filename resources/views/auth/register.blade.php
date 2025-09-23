<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-sm p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
        <form method="POST" action="{{ route('register') }}" class="space-y-4 mb-2">
            @csrf
            <input type="text" name="id_isc" placeholder="ID ISC" required class="w-full p-2 border rounded">
            <input type="password" name="password" placeholder="Password" required class="w-full p-2 border rounded">
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="w-full p-2 border rounded">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white p-2 rounded">Register</button>
        </form>
        <p class="mt-4 text-center text-sm">
            Already have an account? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a>
        </p>
    </div>
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
    @endif

    @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session("error") }}',
            showConfirmButton: false,
            timer: 3000
        });
    </script>
    @endif
</body>

</html>