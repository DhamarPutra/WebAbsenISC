<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen font-sans">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <div class="flex border-b border-gray-300 mb-6">
            <button id="login-tab"
                class="flex-1 py-3 text-center text-blue-600 border-b-2 border-blue-600 font-semibold focus:outline-none">
                Login
            </button>
            <button id="register-tab"
                class="flex-1 py-3 text-center text-gray-600 hover:text-blue-600 border-b-2 border-transparent focus:outline-none">
                Register
            </button>
        </div>

        <!-- Login Section -->
        <div id="login-section" class="form-section">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Login</h2>
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="login-id_isc" class="block mb-2 font-medium text-gray-700">ID ISC</label>
                    <input type="text" id="login-id_isc" name="id_isc" required placeholder="Masukkan ID ISC"
                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="login-password" class="block mb-2 font-medium text-gray-700">Password</label>
                    <input type="password" id="login-password" name="password" required placeholder="Masukkan password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="remember" name="remember"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                    <label for="remember" class="text-gray-700">Remember Me</label>
                </div>
                <button type="submit"
                    class="w-full py-3 bg-blue-600 text-white rounded-md font-semibold hover:bg-blue-700 transition">Login</button>
            </form>
            <p class="mt-2 text-center text-sm text-gray-600">
                <a href="{{ route('password.request.change.create') }}" class="text-blue-600 hover:underline">Forgot
                    Password?</a>
            </p>
        </div>

        <!-- Register Section -->
        <div id="register-section" class="form-section hidden">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Register</h2>
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="register-id_isc" class="block mb-2 font-medium text-gray-700">ID ISC</label>
                    <input type="text" id="register-id_isc" name="id_isc" required placeholder="Masukkan ID ISC"
                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="register-password" class="block mb-2 font-medium text-gray-700">Password</label>
                    <input type="password" id="register-password" name="password" required placeholder="Buat password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="register-confirm-password" class="block mb-2 font-medium text-gray-700">Konfirmasi
                        Password</label>
                    <input type="password" id="register-confirm-password" name="password_confirmation" required
                        placeholder="Konfirmasi password Anda"
                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 mb-5" />
                </div>
                <button type="submit"
                    class="w-full py-3 bg-blue-600 text-white rounded-md font-semibold hover:bg-blue-700 transition">Register</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const loginTab = document.getElementById("login-tab");
            const registerTab = document.getElementById("register-tab");
            const loginSection = document.getElementById("login-section");
            const registerSection = document.getElementById("register-section");

            function switchForm(showLogin) {
                if (showLogin) {
                    loginSection.classList.remove("hidden");
                    registerSection.classList.add("hidden");

                    loginTab.classList.add("text-blue-600", "border-blue-600", "font-semibold");
                    loginTab.classList.remove("text-gray-600", "border-transparent");

                    registerTab.classList.remove("text-blue-600", "border-blue-600", "font-semibold");
                    registerTab.classList.add("text-gray-600", "border-transparent");
                } else {
                    loginSection.classList.add("hidden");
                    registerSection.classList.remove("hidden");

                    registerTab.classList.add("text-blue-600", "border-blue-600", "font-semibold");
                    registerTab.classList.remove("text-gray-600", "border-transparent");

                    loginTab.classList.remove("text-blue-600", "border-blue-600", "font-semibold");
                    loginTab.classList.add("text-gray-600", "border-transparent");
                }
            }

            loginTab.addEventListener("click", () => switchForm(true));
            registerTab.addEventListener("click", () => switchForm(false));

            // Default to login form active
            switchForm(true);
        });
    </script>
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
</body>

</html>
