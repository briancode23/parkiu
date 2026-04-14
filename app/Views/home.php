<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Parkify - SmartParkings</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.1.0/css/fontawesome.min.css">-->
    <script src="https://kit.fontawesome.com/e562ed0c4b.js" crossorigin="anonymous"></script>



    <style>
        body { font-family: 'Roboto', 'Inter', 'Nunito', sans-serif; }
        .index-page { scroll-behavior: smooth; }
    </style>

    <!-- =======================================================
          * Template Name: QuickStart
          * Template URL: https://bootstrapmade.com/quickstart-bootstrap-startup-website-template/
          * Updated: Aug 07 2024 with Bootstrap v5.3.3
          * Author: BootstrapMade.com
          * License: https://bootstrapmade.com/license/
          ======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="fixed top-0 w-full bg-slate-900 text-white shadow-lg z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">

            <a href="?url=home/index" class="flex items-center space-x-2">
                <i class="fas fa-parking text-2xl"></i>
                <h1 class="text-2xl font-bold">Parkify</h1>
            </a>

            <nav id="navmenu" class="hidden md:flex space-x-8">
                <ul class="flex space-x-8">
                    <li><a href="#hero" class="hover:text-blue-400 transition">Home</a></li>
                    <li><a href="#about" class="hover:text-blue-400 transition">About</a></li>
                    <li><a href="#features" class="hover:text-blue-400 transition">Features</a></li>
                    <li><a href="#contact" class="hover:text-blue-400 transition">Contact</a></li>
                </ul>
            </nav>

            <a class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold transition" href="<?= APP_URL ?>/auth/login">Login</a>

        </div>
    </header>

    <main class="main pt-20">

        <!-- Hero Section -->
        <section id="hero" class="pt-24 pb-12 px-4">
            <div class="max-w-6xl mx-auto text-center">
                <div class="flex flex-col justify-center items-center space-y-6">
                    <h1 class="text-5xl md:text-6xl font-bold text-slate-900" data-aos="fade-up">Welcome to <span class="text-blue-500">Parkify</span></h1>
                    <p class="text-xl text-gray-600 max-w-2xl" data-aos="fade-up" data-aos-delay="100">
                        Solusi Parkir Cerdas untuk Era Digital<br>
                    </p>
                </div>
            </div>
        </section>
        <!-- /Hero Section -->

        <!-- Featured Services Section -->
        <section id="featured-services" class="py-12 lg:py-16 bg-gray-50">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="100">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-4">
                                <i class="fas fa-briefcase text-3xl text-blue-500"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold text-slate-900 mb-2">Manajemen Kendaraan</h4>
                                <p class="text-gray-600">
                                    Catat kendaraan masuk dan keluar secara real-time dengan nomor polisi dan jenis kendaraan
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="200">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-4">
                                <i class="fas fa-calculator text-3xl text-emerald-500"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold text-slate-900 mb-2">Perhitungan Tarif Otomatis</h4>
                                <p class="text-gray-600">
                                    Sistem menghitung durasi parkir dan biaya secara otomatis tanpa kesalahan manual
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="300">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-4">
                                <i class="fas fa-receipt text-3xl text-indigo-500"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold text-slate-900 mb-2">Cetak Struk Parkir</h4>
                                <p class="text-gray-600">
                                    Cetak atau tampilkan struk parkir digital dengan detail waktu dan tarif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Featured Services Section -->

        <!-- About Section -->
        <section id="about" class="py-12 lg:py-16">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                    <div class="flex flex-col justify-center" data-aos="fade-up" data-aos-delay="100">
                        <p class="text-blue-500 font-semibold mb-2">Who We Are</p>
                        <h3 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">Tentang Parkify</h3>
                        <p class="text-gray-600 italic mb-6">
                            Parkify adalah aplikasi parkir berbasis web yang membantu pengelola parkir mencatat kendaraan, menghitung tarif, dan membuat laporan secara cepat, akurat dan efisien.
                        </p>
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-emerald-500 mr-3 mt-1 flex-shrink-0"></i>
                                <div>
                                    <span class="font-semibold text-slate-900">Pencatatan Kendaraan Otomatis</span><br>
                                    <span class="text-gray-600">Petugas dapat mencatat kendaraan masuk dan keluar dengan cepat berdasarkan nomor polisi dan jenis kendaraan.</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-emerald-500 mr-3 mt-1 flex-shrink-0"></i>
                                <div>
                                    <span class="font-semibold text-slate-900">Perhitungan Tarif Parkir Akurat</span><br>
                                    <span class="text-gray-600">Sistem menghitung durasi dan biaya parkir secara otomatis sehingga meminimalkan kesalahan manual.</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-emerald-500 mr-3 mt-1 flex-shrink-0"></i>
                                <div>
                                    <span class="font-semibold text-slate-900">Laporan & Rekap Parkir</span><br>
                                    <span class="text-gray-600">Menyediakan laporan parkir harian dan bulanan untuk memudahkan pengelolaan dan evaluasi pendapatan.</span>
                                </div>
                            </li>
                        </ul>
                        <a href="<?= APP_URL ?>/auth/login" class="inline-flex items-center bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition w-fit"><span>Masuk ke Sistem</span><i class="fas fa-arrow-right ml-2"></i></a>
                    </div>

                    <div class="grid grid-cols-2 gap-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-span-1">
                        </div>
                        <div class="col-span-1 flex flex-col gap-4">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /About Section -->

        <!-- Features Section -->
        <section id="features" class="py-12 lg:py-16">
            <!-- Section Title -->
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Fitur Parkify</h2>
                <p class="text-gray-600 text-lg">
                    Parkify menyediakan berbagai fitur untuk mempermudah pengelolaan parkir secara digital dan efisien.
                </p>
            </div>
            <!-- End Section Title -->

            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="flex flex-col">
                        <ul class="flex flex-col space-y-0 border border-gray-200 rounded-lg overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                            <li class="border-b border-gray-200 last:border-b-0">
                                <a class="nav-link active show flex items-start p-4 bg-blue-50 hover:bg-blue-100 transition cursor-pointer" data-bs-toggle="tab" data-bs-target="#features-tab-1">
                                    <i class="fas fa-car text-2xl text-blue-500 mr-4 mt-1"></i>
                                    <div>
                                        <h4 class="font-semibold text-slate-900">Pencatatan Kendaraan</h4>
                                        <p class="text-sm text-gray-600">Mencatat kendaraan masuk dan keluar secara otomatis</p>
                                    </div>
                                </a>
                            </li>

                            <li class="border-b border-gray-200 last:border-b-0">
                                <a class="nav-link flex items-start p-4 hover:bg-gray-50 transition cursor-pointer" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                                    <i class="fas fa-hourglass-half text-2xl text-orange-500 mr-4 mt-1"></i>
                                    <div>
                                        <h4 class="font-semibold text-slate-900">Durasi Realtime</h4>
                                        <p class="text-sm text-gray-600">Lama parkir dihitung otomatis</p>
                                    </div>
                                </a>
                            </li>

                            <li class="border-b border-gray-200 last:border-b-0">
                                <a class="nav-link flex items-start p-4 hover:bg-gray-50 transition cursor-pointer" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                                    <i class="fas fa-coins text-2xl text-emerald-500 mr-4 mt-1"></i>
                                    <div>
                                        <h4 class="font-semibold text-slate-900">Tarif Otomatis</h4>
                                        <p class="text-sm text-gray-600">Biaya parkir dihitung secara otomatis</p>
                                    </div>
                                </a>
                            </li>

                            <li class="border-b border-gray-200 last:border-b-0">
                                <a class="nav-link flex items-start p-4 hover:bg-gray-50 transition cursor-pointer" data-bs-toggle="tab" data-bs-target="#features-tab-1">
                                    <i class="fas fa-receipt text-2xl text-indigo-500 mr-4 mt-1"></i>
                                    <div>
                                        <h4 class="font-semibold text-slate-900">Cetak Struk</h4>
                                        <p class="text-sm text-gray-600">Bukti transaksi parkir dalam bentuk digital atau cetak</p>
                                    </div>
                                </a>
                            </li>

                            <li class="border-b border-gray-200 last:border-b-0">
                                <a class="nav-link flex items-start p-4 hover:bg-gray-50 transition cursor-pointer" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                                    <i class="fas fa-eye text-2xl text-purple-500 mr-4 mt-1"></i>
                                    <div>
                                        <h4 class="font-semibold text-slate-900">Dashboard Monitoring</h4>
                                        <p class="text-sm text-gray-600">Menampilkan data parkir secara realtime</p>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a class="nav-link flex items-start p-4 hover:bg-gray-50 transition cursor-pointer" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                                    <i class="fas fa-chart-bar text-2xl text-red-500 mr-4 mt-1"></i>
                                    <div>
                                        <h4 class="font-semibold text-slate-900">Laporan Data</h4>
                                        <p class="text-sm text-gray-600">Pencatatan riwayat parkir untuk analisis dan dokumentasi</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- End Tab Nav -->
                    </div>

                    <div class="flex items-center">
                        <div class="tab-content w-full" data-aos="fade-up" data-aos-delay="200">
                            <div class="tab-pane fade active show" id="features-tab-1">
                            </div>
                            <!-- End Tab Content Item -->

                            <div class="tab-pane fade" id="features-tab-2">
                            </div>
                            <!-- End Tab Content Item -->

                            <div class="tab-pane fade" id="features-tab-3">
                            </div>
                            <!-- End Tab Content Item -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Features Section -->

        <!-- Features Details Section -->
        <section id="features-details" class="py-12 lg:py-16 bg-gray-50">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center mb-12">
                    <div class="order-2 lg:order-1" data-aos="fade-up" data-aos-delay="100">
                    </div>

                    <div class="order-1 lg:order-2 flex flex-col justify-center" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="text-3xl font-bold text-slate-900 mb-4">Monitoring Parkir Secara Real-Time</h3>
                        <p class="text-gray-600 mb-6">
                            Parkify membantu petugas memantau kendaraan masuk dan keluar secara langsung. Data tercatat otomatis sehingga meminimalisir kesalahan pencatatan manual dan mempercepat operasional parkir.
                        </p>
                        <a href="#" class="inline-flex items-center bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition w-fit">Lihat Fitur</a>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                    <div class="flex flex-col justify-center" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="text-3xl font-bold text-slate-900 mb-4">Manajemen Data & Laporan Otomatis</h3>
                        <p class="text-gray-600 mb-6">
                            Kelola data kendaraan, hitung durasi parkir otomatis, dan cetak laporan kapan saja dengan sistem terintegrasi.
                        </p>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-emerald-500 mr-3"></i>
                                <span class="text-gray-600">Dashboard mudah digunakan</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-emerald-500 mr-3"></i>
                                <span class="text-gray-600">Perhitungan tarif otomatis</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-emerald-500 mr-3"></i>
                                <span class="text-gray-600">Export laporan parkir</span>
                            </li>
                        </ul>
                        <a href="#" class="inline-flex items-center bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition w-fit">Pelajari</a>
                    </div>

                    <div class="order-2" data-aos="fade-up" data-aos-delay="200">
                    </div>
                </div>
            </div>
        </section>
        <!-- /Features Details Section -->

        <!-- More Features Section -->
        <section id="more-features" class="py-12 lg:py-16">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                    <div class="order-2 lg:order-1 flex flex-col justify-center" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="text-3xl font-bold text-slate-900 mb-4">Fitur-Fitur Lengkap Parkify</h3>
                        <p class="text-gray-600 mb-8">
                            Dapatkan pengalaman pengelolaan parkir yang seamless dengan fitur-fitur canggih yang dirancang khusus untuk efisiensi operasional Anda.
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex items-start">
                                <i class="fas fa-cogs text-3xl text-blue-500 mr-4 flex-shrink-0 mt-1"></i>
                                <div>
                                    <h4 class="text-lg font-semibold text-slate-900 mb-2">Integrasi Sistem</h4>
                                    <p class="text-gray-600 text-sm">Sistem terintegrasi untuk kemudahan manajemen data kendaraan</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <i class="fas fa-check-double text-3xl text-emerald-500 mr-4 flex-shrink-0 mt-1"></i>
                                <div>
                                    <h4 class="text-lg font-semibold text-slate-900 mb-2">Akurat</h4>
                                    <p class="text-gray-600 text-sm">Perhitungan yang akurat dan transparan setiap saat</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <i class="fas fa-sun text-3xl text-yellow-500 mr-4 flex-shrink-0 mt-1"></i>
                                <div>
                                    <h4 class="text-lg font-semibold text-slate-900 mb-2">User-Friendly</h4>
                                    <p class="text-gray-600 text-sm">Interface yang mudah digunakan oleh semua orang</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <i class="fas fa-bolt text-3xl text-orange-500 mr-4 flex-shrink-0 mt-1"></i>
                                <div>
                                    <h4 class="text-lg font-semibold text-slate-900 mb-2">Cepat</h4>
                                    <p class="text-gray-600 text-sm">Proses yang cepat dan efisien tanpa hambatan</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="order-1 lg:order-2" data-aos="fade-up" data-aos-delay="200">
                    </div>
                </div>
            </div>
        </section>
        <!-- /More Features Section -->

        <!-- Contact Section -->
        <section id="contact" class="py-12 lg:py-16 bg-gray-50">
            <!-- Section Title -->
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Contact</h2>
                <p class="text-gray-600 text-lg">
                    Hubungi kami untuk informasi lebih lanjut tentang solusi parkir digital Parkify
                </p>
            </div>
            <!-- End Section Title -->

            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up" data-aos-delay="100">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition flex flex-col items-center text-center" data-aos="fade-up" data-aos-delay="200">
                        <i class="fas fa-map-marker-alt text-4xl text-blue-500 mb-4"></i>
                        <h3 class="text-xl font-semibold text-slate-900 mb-3">Address</h3>
                        <p class="text-gray-600">
                            Jl. Sangkuriang No. 76, Cimahi Utara, 40511
                        </p>
                    </div>

                    <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition flex flex-col items-center text-center" data-aos="fade-up" data-aos-delay="400">
                        <i class="fas fa-envelope text-4xl text-blue-500 mb-4"></i>
                        <h3 class="text-xl font-semibold text-slate-900 mb-3">Email Us</h3>
                        <p class="text-gray-600">
                            email@parkifytest.com
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="rounded-lg overflow-hidden shadow-lg" data-aos="fade-up" data-aos-delay="300">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus"
                            frameborder="0" style="border:0; width: 100%; height: 400px;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                    <div class="bg-white p-8 rounded-lg shadow-md" data-aos="fade-up" data-aos-delay="400">
                        <form action="forms/contact.php" method="post" class="php-email-form">
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <input type="text" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Your Name" required="">
                                    <input type="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Your Email" required="">
                                </div>

                                <input type="text" name="subject" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Subject" required="">

                                <textarea name="message" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Message" required=""></textarea>

                                <div class="text-center py-2">
                                    <div class="loading hidden text-gray-600 mb-2">Loading...</div>
                                    <div class="error-message hidden text-red-600 mb-2"></div>
                                    <div class="sent-message hidden text-emerald-600 mb-2">Your message has been sent. Thank you!</div>
                                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-semibold transition">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Contact Section -->

    </main>

    <footer id="footer" class="bg-slate-900 text-white py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h2 class="text-2xl font-bold mb-4">
                        <i class="fas fa-parking mr-2 text-blue-400"></i>Parkify
                    </h2>
                    <div class="space-y-3">
                        <p class="text-gray-400">Jl. Sangkuriang No. 76</p>
                        <p class="text-gray-400">Cimahi Utara, 40511</p>
                        <p class="text-gray-400"><strong>Email:</strong> email@parkifytest.com</p>
                    </div>
                    <div class="flex space-x-4 mt-6">
                        <a href="" class="text-gray-400 hover:text-blue-400 transition text-xl"><i class="fab fa-x-twitter"></i></a>
                        <a href="" class="text-gray-400 hover:text-blue-400 transition text-xl"><i class="fab fa-facebook"></i></a>
                        <a href="" class="text-gray-400 hover:text-blue-400 transition text-xl"><i class="fab fa-instagram"></i></a>
                        <a href="" class="text-gray-400 hover:text-blue-400 transition text-xl"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Useful Links</h4>
                    <ul class="space-y-2">
                        <li><a href="?url=home/index#hero" class="text-gray-400 hover:text-blue-400 transition">Home</a></li>
                        <li><a href="?url=home/index#about" class="text-gray-400 hover:text-blue-400 transition">About us</a></li>
                        <li><a href="?url=home/index#features" class="text-gray-400 hover:text-blue-400 transition">Features</a></li>
                        <li><a href="?url=home/index#contact" class="text-gray-400 hover:text-blue-400 transition">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">About Parkify</h4>
                    <p class="text-gray-400 text-sm">
                        Parkify adalah solusi parkir cerdas berbasis web yang membantu mengelola kendaraan, menghitung tarif, dan membuat laporan secara otomatis dan efisien.
                    </p>
                </div>
            </div>

            <div class="border-t border-slate-700 pt-8 text-center">
                <p class="text-gray-400">
                    © <span class="text-blue-400">Copyright</span> <strong>Parkify</strong> <span class="text-gray-500">All Rights Reserved</span>
                </p>
                <div class="mt-2 text-sm text-gray-500">
                    Designed by <a href="https://bootstrapmade.com/" class="text-blue-400 hover:text-blue-300 transition">BootstrapMade</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="fixed bottom-6 right-6 bg-blue-500 hover:bg-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition hidden md:flex"><i class="fas fa-arrow-up"></i></a>

    <!-- Preloader -->
    <div id="preloader" class="hidden fixed inset-0 bg-white bg-opacity-90 flex items-center justify-center z-50">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500"></div>
    </div>

    <script>
        // Scroll Top Button
        const scrollTop = document.getElementById('scroll-top');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                scrollTop.classList.remove('hidden');
                scrollTop.classList.add('md:flex');
            } else {
                scrollTop.classList.add('hidden');
                scrollTop.classList.remove('md:flex');
            }
        });

        scrollTop.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Initialize AOS
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 600,
                once: true,
                offset: 100
            });
        }
    </script>

</body>

</html>