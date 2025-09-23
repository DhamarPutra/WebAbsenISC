<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-sm p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center">change Password</h2>
        <form method="POST" action="{{ route('password.request.change.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="text" name="id_isc" placeholder="ID ISC" required
                class="mb-2 w-full border p-2">
            <input type="password" name="new_password" placeholder="Password baru" required
                class="mb-2 w-full border p-2">
            <input type="password" name="new_password_confirmation" placeholder="Konfirmasi password baru" required
                class="mb-4 w-full border p-2">

            <div class="mb-2">
                <video id="camera" width="100%" autoplay></video>
                <canvas id="snapshot" style="display:none;"></canvas>
                <input type="hidden" name="selfie_image" id="selfieImage">
                <button type="button" onclick="captureSelfie()" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Ambil
                    Selfie</button>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded w-full">Kirim Permintaan Ganti
                Password</button>
        </form>

        <script>
            const video = document.getElementById('camera');
            const canvas = document.getElementById('snapshot');
            const selfieInput = document.getElementById('selfieImage');

            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(stream => {
                    video.srcObject = stream;
                });

            function captureSelfie() {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                canvas.getContext('2d').drawImage(video, 0, 0);
                selfieInput.value = canvas.toDataURL('image/png');
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Selfie berhasil diambil!',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
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
