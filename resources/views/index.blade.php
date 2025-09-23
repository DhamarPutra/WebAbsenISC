<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ISC | Informatics Study Club</title>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="./assets/js/index.js"></script>
    <link rel="stylesheet" href="./assets/css/index.css" />
    <link
        rel="shortcut icon"
        href="./assets/img/icon/isc192.png"
        type="image/x-icon" />
    <!-- CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- CDN Swiper CSS -->
    <link
        href="https://unpkg.com/swiper/swiper-bundle.min.css"
        rel="stylesheet" />
    <!-- CDN Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</head>

<body class="bg-gray-50">
    <!-- Header Section -->
    <header class="bg-white shadow fixed top-0 left-0 w-full z-50">
        <div
            class="container mx-auto flex items-center justify-between py-2 px-6 relative">
            <!-- Logo and Title Container -->
            <a href="/">
                <div class="flex items-center space-x-2">
                    <img
                        loading="lazy"
                        src="./assets/img/icon/isc500.png"
                        alt="logo"
                        class="w-12" />
                    <h1 class="text-2xl font-bold text-blue-600 hidden sm:block">
                        ISC - Informatics Study Club
                    </h1>
                    <h1 class="text-2xl font-bold text-blue-600 sm:hidden">ISC</h1>
                </div>
            </a>

            <!-- Hamburger Menu Icon -->
            <div class="sm:hidden flex items-center">
                <button onclick="toggleMenu()" class="text-gray-600">
                    <i class="fas fa-bars text-2xl"></i>
                    <!-- Hamburger icon -->
                </button>
            </div>

            <!-- Navigation Menu (hidden on mobile) -->
            <nav class="hidden sm:flex" id="navbar">
                <ul class="flex space-x-6">
                    <li>
                        <a href="#home" class="text-gray-600 hover:text-blue-600">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="#about" class="text-gray-600 hover:text-blue-600">About
                        </a>
                    </li>
                    <li>
                        <a href="#bidang" class="text-gray-600 hover:text-blue-600">Bidang</a>
                    </li>
                    <li>
                        <a href="#acara" class="text-gray-600 hover:text-blue-600">Acara</a>
                    </li>
                </ul>
            </nav>

            <!-- Mobile Menu (hidden by default) -->
            <nav
                class="sm:hidden hidden absolute top-full left-0 right-0 bg-white shadow-lg"
                id="mobile-menu">
                <ul class="flex flex-col space-y-4 p-4">
                    <li>
                        <a href="#home" class="text-gray-600 hover:text-blue-600">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="#about" class="text-gray-600 hover:text-blue-600">About
                        </a>
                    </li>
                    <li>
                        <a href="#bidang" class="text-gray-600 hover:text-blue-600">Bidang</a>
                    </li>
                    <li>
                        <a href="#acara" class="text-gray-600 hover:text-blue-600">Acara</a>
                    </li>
                    <li>
                        <a href="#contact" class="text-gray-600 hover:text-blue-600">Contact</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Home Section -->
    <section
        id="home"
        class="relative pt-32 bg-cover bg-center text-white"
        style="background-image: url('./assets/img/background.webp')">
        <!-- Overlay Gradient -->
        <div class="absolute inset-0 bg-black bg-opacity-75"></div>

        <!-- Content -->
        <div
            class="container relative z-10 mx-auto flex flex-col md:flex-row items-center px-6 py-16">
            <!-- Side Kiri -->
            <div class="w-full md:w-1/2 text-center md:text-left mb-12 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">
                    Informatics Study Club
                </h1>
                <p class="text-lg mb-8">
                    Kelas tambahan untuk mengasah kemampuan Anda di bidang teknologi,
                    website, desain, dan data.
                </p>
                <a
                    href="{{ route('account') }}"
                    class="inline-flex items-center bg-blue-600 text-white py-3 px-6 rounded-full font-semibold hover:bg-blue-700 transition-all">
                    Get Started
                    <i class="fas fa-arrow-right ml-3"></i>
                </a>
            </div>

            <!-- Side Kanan -->
            <div class="w-full md:w-1/2">
                <img
                    loading="lazy"
                    src="./assets/img/grafik.png"
                    alt="Kompetisi Informatika"
                    class="rounded-lg shadow-lg mx-auto" />
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="pt-20 pb-4 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center">
                <!-- Text Content -->
                <div class="lg:w-1/2 text-center lg:text-left mb-8 lg:mb-0">
                    <h2 class="text-4xl font-bold text-blue-600 mb-4">Tentang Kami</h2>
                    <p class="text-lg text-gray-700 mb-6">
                        Informatics Study Club (ISC) Universitas Pamulang adalah komunitas
                        dinamis yang berdedikasi untuk menjelajahi, mengembangkan, dan
                        memajukan teknologi informasi. Kami berkomitmen untuk menciptakan
                        lingkungan inovatif di mana para anggota dapat belajar,
                        berkolaborasi, dan berbagi pengetahuan tentang dunia teknologi
                        yang terus berkembang.
                    </p>
                    <div class="flex flex-col lg:flex-row mb-6">
                        <!-- Visi Section -->
                        <div class="lg:w-1/2 mb-4 lg:mb-0 lg:pr-4">
                            <h3 class="text-xl font-semibold text-blue-600 mb-2">Visi</h3>
                            <p class="text-lg text-gray-700">
                                Mewujudkan mahasiswa Unpam yang berkarakter kuat, dan siap
                                bekerja serta berwirausaha dengan berbasis teknologi.
                            </p>
                        </div>

                        <!-- Misi Section -->
                        <div class="lg:w-1/2 lg:pl-4">
                            <h3 class="text-xl font-semibold text-blue-600 mb-2">Misi</h3>
                            <p class="text-lg text-gray-700 mb-2">
                                Menyediakan sarana dan prasarana yang interaktif dan
                                komunikasi bagi mahasiswa.
                            </p>
                            <p class="text-lg text-gray-700 mb-2">
                                Meningkatkan hubungan yang sinergi dan positif baik di dalam
                                maupun luar klub.
                            </p>
                            <p class="text-lg text-gray-700">
                                Menjadikan ISC sebagai wadah pengembangan bagi mahasiswa untuk
                                saling berkomunikasi dan berkolaborasi.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Image or Logo Section -->
                <div class="lg:w-1/2 items-center justify-center flex">
                    <img
                        loading="lazy"
                        src="./assets/img/icon/isc500.png"
                        alt="Logo ISC"
                        class="h-128 w-128 mx-auto lg:mx-0 transition-transform duration-300 hover:scale-105" />
                </div>
            </div>
        </div>
    </section>

    <section id="struktur" class="pt-20 pb-4 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h1 class="text-3xl font-bold mb-6 text-blue-600">
                    Struktur Organisasi
                </h1>
            </div>

            <!-- Struktur Organisasi -->
            <div
                class="flex flex-col lg:flex-row lg:justify-center lg:space-x-6 mb-6">
                <!-- Ketua 1 -->
                <div
                    class="bg-white p-6 rounded-lg shadow-lg mb-6 lg:w-1/4 text-center">
                    <img
                        loading="lazy"
                        src="./assets/img/pengurus/saldi.jpg"
                        alt="Ketua 1"
                        class="w-24 h-24 rounded-full mx-auto mb-4" />
                    <h3 class="text-xl font-semibold text-blue-600">Saldy Saputra</h3>
                    <p class="text-gray-700">Ketua</p>
                </div>

                <!-- Wakil 1 -->
                <div
                    class="bg-white p-6 rounded-lg shadow-lg mb-6 lg:w-1/4 text-center">
                    <img
                        loading="lazy"
                        src="./assets/img/pengurus/ali.jpg"
                        alt="Wakil 1"
                        class="w-24 h-24 rounded-full mx-auto mb-4" />
                    <h3 class="text-xl font-semibold text-blue-600">Muchtar Ali</h3>
                    <p class="text-gray-700">Wakil Ketua</p>
                </div>
            </div>

            <!-- Sekretaris 1 dan Bendahara 1 (wider container) -->
            <div
                class="flex flex-col lg:flex-row lg:justify-between lg:space-x-8 mb-6">
                <!-- Sekretaris 1 -->
                <div
                    class="bg-white p-6 rounded-lg shadow-lg mb-6 lg:w-1/2 text-center">
                    <img
                        loading="lazy"
                        src="./assets/img/pengurus/marsel.jpg"
                        alt="Sekretaris 1"
                        class="w-24 h-24 rounded-full mx-auto mb-4" />
                    <h3 class="text-xl font-semibold text-blue-600">Marsella Waty</h3>
                    <p class="text-gray-700">Sekretaris</p>
                </div>

                <!-- Bendahara 1 -->
                <div
                    class="bg-white p-6 rounded-lg shadow-lg mb-6 lg:w-1/2 text-center">
                    <img
                        loading="lazy"
                        src="./assets/img/pengurus/naira.jpg"
                        alt="Bendahara 1"
                        class="w-24 h-24 rounded-full mx-auto mb-4" />
                    <h3 class="text-xl font-semibold text-blue-600">Naira Aqeela</h3>
                    <p class="text-gray-700">Bendahara</p>
                </div>
            </div>

            <!-- Koordinator -->
            <div class="flex flex-wrap justify-center gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow-lg text-center lg:w-1/3">
                    <img
                        loading="lazy"
                        src="./assets/img/pengurus/iqbal.jpg"
                        alt="Koordinator 1"
                        class="w-24 h-24 rounded-full mx-auto mb-4" />
                    <h3 class="text-xl font-semibold text-blue-600">Iqbal Julyansah</h3>
                    <p class="text-gray-700">Koordinator Bidang</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg text-center lg:w-1/3">
                    <img
                        loading="lazy"
                        src="./assets/img/pengurus/janu.jpg"
                        alt="Koordinator 2"
                        class="w-24 h-24 rounded-full mx-auto mb-4" />
                    <h3 class="text-xl font-semibold text-blue-600">Janu Sari</h3>
                    <p class="text-gray-700">Koordinator Bidang</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg text-center lg:w-1/3">
                    <img
                        loading="lazy"
                        src="./assets/img/pengurus/ardila.jpg"
                        alt="Koordinator 3"
                        class="w-24 h-24 rounded-full mx-auto mb-4" />
                    <h3 class="text-xl font-semibold text-blue-600">Ardila</h3>
                    <p class="text-gray-700">Koordinator Bidang</p>
                </div>
            </div>
        </div>
    </section>

    <section id="logo-philosophy" class="pt-20 pb-4 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-blue-600 mb-4">
                    Filosofi Logo Kami
                </h2>
                <p class="text-lg text-gray-700 max-w-2xl mx-auto">
                    Kami dengan bangga mempersembahkan logo baru kami! Setiap elemen
                    dalam desain logo kami mencerminkan nilai dan semangat ISC. Logo ini
                    adalah representasi dari visi kami untuk inovasi, kolaborasi, dan
                    kemajuan teknologi. 💡🚀
                </p>
            </div>

            <div class="flex flex-col lg:flex-row items-center">
                <!-- Logo Image -->
                <div class="lg:w-1/2 mb-8 lg:mb-0">
                    <img
                        loading="lazy"
                        src="./assets/img/icon/isc500.png"
                        alt="Logo ISC"
                        class="mx-auto mb-4" />
                </div>

                <!-- Filosofi Section -->
                <div class="lg:w-1/2 text-center lg:text-left">
                    <ul class="text-lg text-gray-700 space-y-3">
                        <li
                            class="flex flex-col lg:flex-row items-center lg:items-center space-x-0 lg:space-x-4">
                            <img
                                loading="lazy"
                                src="./assets/img/icon/i.png"
                                alt="I"
                                class="filosofi mx-auto lg:mx-0" />
                            <span class="text-md leading-relaxed text-center lg:text-left">
                                <strong class="text-blue-600">Huruf I</strong>
                                sebagai singkatan dari
                                <strong class="text-blue-600">Information, Interaction, Innovation,</strong>
                                dan
                                <strong class="text-blue-600">Internet</strong>. Teknik
                                Informatika berfokus pada pengelolaan, pengolahan, dan
                                penyebaran informasi, sehingga huruf I menjadi simbol yang
                                mewakili inti dari bidang ini.
                            </span>
                        </li>
                        <li
                            class="flex flex-col lg:flex-row items-center lg:items-center space-x-0 lg:space-x-4">
                            <img
                                loading="lazy"
                                src="./assets/img/icon/s.png"
                                alt="S"
                                class="filosofi mx-auto lg:mx-0" />
                            <span class="text-md leading-relaxed text-center lg:text-left">
                                <strong class="text-blue-600">Huruf S</strong>
                                melambangkan perangkat lunak (<strong class="text-blue-600">Software</strong>), dan sistem, baik itu sistem operasi, sistem informasi,
                                atau sistem jaringan. Teknik Informatika mencakup desain,
                                implementasi, dan manajemen sistem ini untuk memastikan mereka
                                bekerja dengan efisien dan efektif.
                            </span>
                        </li>
                        <li
                            class="flex flex-col lg:flex-row items-center lg:items-center space-x-0 lg:space-x-4">
                            <img
                                loading="lazy"
                                src="./assets/img/icon/c.png"
                                alt="C"
                                class="filosofi mx-auto lg:mx-0" />
                            <span class="text-md leading-relaxed text-center lg:text-left">
                                <strong class="text-blue-600">Huruf C</strong>
                                melambangkan pemrograman dan penulisan kode. Huruf C adalah
                                inti dari istilah
                                <strong class="text-blue-600">Computing</strong>
                                yang mencakup seluruh spektrum Teknik Informatika, termasuk
                                pemrosesan data, algoritma, dan operasi komputer.
                            </span>
                        </li>
                        <li
                            class="flex flex-col lg:flex-row items-center lg:items-center space-x-0 lg:space-x-4">
                            <img
                                loading="lazy"
                                src="./assets/img/icon/sidik.png"
                                alt="Fingerprint"
                                class="filosofi mx-auto lg:mx-0" />
                            <span class="text-md leading-relaxed text-center lg:text-left">
                                <strong class="text-blue-600">Sidik Jari</strong>
                                memperlihatkan identitas unik pengguna dalam Teknik
                                Informatika. Logo sidik jari sering dipakai dalam desain
                                teknologi modern dan minimalis, mencerminkan inovasi dan
                                estetika kontemporer.
                            </span>
                        </li>
                        <li
                            class="flex flex-col lg:flex-row items-center lg:items-center space-x-0 lg:space-x-4">
                            <img
                                loading="lazy"
                                src="./assets/img/icon/pcb.png"
                                alt="PCB Design"
                                class="filosofi mx-auto lg:mx-0" />
                            <span class="text-md leading-relaxed text-center lg:text-left">
                                <strong class="text-blue-600">Desain PCB</strong>
                                menggambarkan jaringan yang menghubungkan sistem, seiring
                                dengan perkembangan teknologi dan inovasi dalam Teknik
                                Informatika.
                            </span>
                        </li>
                        <li
                            class="flex flex-col lg:flex-row items-center lg:items-center space-x-0 lg:space-x-4">
                            <img
                                loading="lazy"
                                src="./assets/img/icon/star.png"
                                alt="Star"
                                class="filosofi mx-auto lg:mx-0" />
                            <span class="text-md leading-relaxed text-center lg:text-left">
                                <strong class="text-blue-600">Bintang</strong>
                                melambangkan inspirasi dan inovasi dalam Teknik Informatika,
                                mendorong batasan teknologi, serta menciptakan solusi baru.
                                Program-program yang diadakan oleh Informatics Study Club
                                mencakup Business Digital, IoT Network Security, English
                                Upskill, Computational Intelligence, dan Software Development.
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Acara Section -->

    <!-- Bidang Section -->
    <section id="bidang" class="pt-20 pb-4">
        <div class="container mx-auto">
            <h3 class="text-3xl font-bold text-center mb-8">Bidang/Peminatan</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 shadow rounded-lg text-center">
                    <div class="text-blue-600 text-4xl mb-4">
                        <i class="fas fa-paint-brush"></i>
                        <!-- Icon UI/UX Designer -->
                    </div>
                    <h4 class="text-xl font-bold mb-2">UI/UX Designer</h4>
                    <p class="text-gray-600 mb-6">
                        Belajar men-desain sebuah aplikasi atau website menggunakan figma.
                    </p>
                    <a
                        href=""
                        class="bg-blue-600 text-white py-2 px-4 rounded-lg font-semibold hover:bg-blue-700">Chat Koordinator</a>
                </div>
                <div class="bg-white p-6 shadow rounded-lg text-center">
                    <div class="text-blue-600 text-4xl mb-4">
                        <i class="fas fa-laptop-code"></i>
                        <!-- Icon Web Development -->
                    </div>
                    <h4 class="text-xl font-bold mb-2">Web Development</h4>
                    <p class="text-gray-600 mb-6">
                        Belajar men-develop website, baik itu front-end maupun back-end.
                    </p>
                    <a
                        href=""
                        class="bg-blue-600 text-white py-2 px-4 rounded-lg font-semibold hover:bg-blue-700">Chat Koordinator</a>
                </div>
                <div class="bg-white p-6 shadow rounded-lg text-center">
                    <div class="text-blue-600 text-4xl mb-4">
                        <i class="fas fa-database"></i>
                        <!-- Icon Data Science -->
                    </div>
                    <h4 class="text-xl font-bold mb-2">Data Science</h4>
                    <p class="text-gray-600 mb-6">
                        Belajar mengelola data menggunakan beberapa bahasa pemrograman
                        seperti Python, R, dan SQL.
                    </p>
                    <a
                        href=""
                        class="bg-blue-600 text-white py-2 px-4 rounded-lg font-semibold hover:bg-blue-700">Chat Koordinator</a>
                </div>
            </div>
        </div>
    </section>

    <section id="acara" class="pt-20 pb-4 bg-gray-50">
        <div class="container mx-auto px-4 pb-4">
            <!-- Banner Section -->
            <div class="relative">
                @if ($acaraTerbaru)
                <img
                    loading="lazy"
                    src="{{ asset('storage/' . $acaraTerbaru->image_path) }}"
                    alt="{{ $acaraTerbaru->judul }}"
                    class="w-full h-72 object-cover rounded-xl mt-2" />
                <div
                    class="absolute inset-0 bg-black rounded-xl bg-opacity-40 flex text-center items-center justify-center">
                    <h2 class="text-xl md:text-4xl font-bold text-white">
                        {{ $acaraTerbaru->judul }}
                    </h2>
                </div>
                @endif
            </div>

            <!-- Content Section -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card Item -->
                @forelse ($acara as $listAcara)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img
                        loading="lazy"
                        src="{{ asset('storage/' . $listAcara->image_path) }}"
                        alt="{{ $listAcara->judul }}"
                        class="w-full h-40 object-cover" />
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-blue-600">
                            {{ $listAcara->judul }}
                        </h3>
                        <p class="text-gray-700 mt-2">
                            {{ Str::limit($listAcara->deskripsi, 100) }}
                        </p>
                        <a
                            href="https://www.instagram.com/stories/highlights/17926607366992342/"
                            class="block mt-4 text-blue-600 font-bold hover:underline">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
                @empty
                <p class="text-center text-gray-600">Belum ada berita acara.</p>
                @endforelse
            </div>
        </div>

        <h1 class="text-center text-3xl font-bold mb-6 text-blue-600">
            All About ISC
        </h1>
        <div class="container mx-auto">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <!-- Slide -->
                    @forelse ($kegiatan as $listKegiatan)
                    <div class="swiper-slide">
                        <div
                            class="bg-blue-500 text-white shadow-lg rounded-lg overflow-hidden relative">
                            <img
                                loading="lazy"
                                src="{{ asset('storage/' . $listKegiatan->image_path) }}"
                                alt="{{ $listKegiatan->judul }}"
                                class="w-128 h-128 object-cover object-center transition-transform duration-500 aspect-square" />
                            <div class="absolute inset-0 bg-black opacity-30"></div>
                            <span
                                class="absolute bottom-0 left-0 right-0 p-4 text-center text-lg font-semibold text-white z-10"
                                style="background: rgba(0, 0, 0, 0.5)">
                                {{ $listKegiatan->judul }} | {{ $listKegiatan->tanggal }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-gray-600">Belum ada kegiatan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <script>
        const swiper = new Swiper(".swiper-container", {
            loop: true, // Berulang
            autoplay: {
                delay: 1000,
                disableOnInteraction: false,
            },
            speed: 1000,
            direction: "horizontal",
            slidesPerView: 1, // Menampilkan 1 slide
            spaceBetween: 10, // Jarak antar slide
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                640: {
                    slidesPerView: 2, // Menampilkan 2 slide pada layar kecil
                    spaceBetween: 10,
                },
                768: {
                    slidesPerView: 3, // Menampilkan 3 slide pada layar besar
                    spaceBetween: 10,
                },
            },
        });
    </script>

    <!-- Floating WhatsApp Icon -->
    <a
        href="https://wa.me/6289629391222"
        target="_blank"
        class="fixed bottom-4 right-4 bg-green-500 text-white font-semibold py-1 px-2 rounded-full shadow-lg hover:bg-green-600 transition-colors flex items-center z-50">
        <span class="hidden sm:block mr-2">Contact Us</span>
        <i class="fab fa-whatsapp text-3xl"></i>
    </a>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6">
        <div class="container mx-auto px-6">
            <!-- Grid Footer -->
            <div
                class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6 text-center md:text-left">
                <!-- About Us -->
                <div>
                    <h5 class="text-lg font-bold mb-2">About Us</h5>
                    <p class="text-gray-400">
                        Informatics Study Club (ISC) Universitas Pamulang adalah komunitas
                        yang berfokus pada eksplorasi, pengembangan, dan inovasi teknologi
                        informasi.
                    </p>
                </div>

                <!-- Contact Us -->
                <div>
                    <h5 class="text-lg font-bold mb-2">Contact Us</h5>
                    <ul class="text-gray-400 space-y-2">
                        <li>
                            <a
                                href="mailto:isc.unpam1@gmail.com"
                                class="hover:text-blue-400 transition-colors">
                                📧 isc.unpam1@gmail.com
                            </a>
                        </li>
                        <li>
                            <a
                                href="https://wa.me/6289629391222"
                                class="hover:text-blue-400 transition-colors">
                                📞 +62 896-2939-1222
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Sosial Media -->
                <div>
                    <h5 class="text-lg font-bold mb-2">Follow Us</h5>
                    <div class="flex justify-center md:justify-start space-x-4">
                        <a
                            href="https://github.com/dhamarPutra/"
                            target="_blank"
                            class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-github text-2xl"></i>
                        </a>
                        <a
                            href="https://www.instagram.com/isc.unpam/"
                            target="_blank"
                            class="text-gray-400 hover:text-pink-500 transition-colors">
                            <i class="fab fa-instagram text-2xl"></i>
                        </a>
                        <a
                            href="https://www.tiktok.com/@randomisc1"
                            target="_blank"
                            class="text-gray-400 hover:text-cyan-300 transition-colors">
                            <i class="fab fa-tiktok text-2xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Garis Pembatas -->
            <hr class="border-gray-500 my-6" />

            <!-- Copyright -->
            <div class="text-center text-gray-300">
                <p>&copy; 2024 ISC. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>