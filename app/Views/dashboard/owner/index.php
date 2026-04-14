<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parkify - Owner Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-slate-900 text-white flex flex-col">
            <div class="p-4 border-b border-slate-700">
                <div class="flex items-center">
                    <i class="fas fa-car-side text-2xl mr-2"></i>
                    <span class="text-xl font-bold">Parkify</span>
                </div>
            </div>
            <nav class="flex-1 p-4">
                <ul class="space-y-2">
                    <li><a href="<?= APP_URL ?>/dashboard" class="block py-2 px-4 rounded bg-slate-700 font-semibold"><i
                                class="fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
                    <li><a href="<?= APP_URL ?>/parkir/laporan" class="block py-2 px-4 rounded hover:bg-slate-700 transition"><i
                                class="fas fa-chart-line mr-2"></i>Laporan Parkir</a></li>
                </ul>
            </nav>
            <div class="p-4 border-t border-slate-700">
                <a href="?url=auth/logout"
                    class="block py-2 px-4 rounded hover:bg-red-600 transition text-center font-semibold">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </a>
            </div>
        </div>
        <!-- End of Sidebar -->

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <?php include VIEWS_PATH . '/partials/parkify/topbar.php'; ?>
            <!-- End of Header -->

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6 space-y-6">
                <!-- Status Cards: 2 kolom grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Card 1: Pendapatan (Bulanan) -->
                    <div class="bg-white p-8 rounded-lg shadow hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-semibold mb-2">Pendapatan (Bulanan)</p>
                                <p class="text-4xl font-bold text-slate-900">Rp
                                    <?= isset($pendapatanBulanan) ? number_format($pendapatanBulanan, 0, ',', '.') : '0' ?>
                                </p>
                            </div>
                            <div class="p-5 bg-blue-500 rounded-full">
                                <i class="fas fa-dollar-sign text-white text-3xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Pendapatan (Tahunan) -->
                    <div class="bg-white p-8 rounded-lg shadow hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-semibold mb-2">Pendapatan (Tahunan)</p>
                                <p class="text-4xl font-bold text-slate-900">Rp
                                    <?= isset($pendapatanTahunan) ? number_format($pendapatanTahunan, 0, ',', '.') : '0' ?>
                                </p>
                            </div>
                            <div class="p-5 bg-emerald-500 rounded-full">
                                <i class="fas fa-chart-line text-white text-3xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Laporan Bulanan -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center">
                        <i class="fas fa-calendar-alt text-blue-500 mr-3"></i>Laporan Pendapatan Bulanan
                    </h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="border-b-2 border-gray-300">
                                <tr>
                                    <th class="pb-3 font-semibold text-gray-700">Bulan</th>
                                    <th class="pb-3 font-semibold text-gray-700">Kendaraan Masuk</th>
                                    <th class="pb-3 font-semibold text-gray-700">Pendapatan</th>
                                    <th class="pb-3 font-semibold text-gray-700">Pertumbuhan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($laporanBulanan) && !empty($laporanBulanan)): ?>
                                    <?php foreach ($laporanBulanan as $bulan): ?>
                                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                                            <td class="py-3"><?= htmlspecialchars($bulan['bulan']) ?></td>
                                            <td class="py-3"><?= $bulan['total_masuk'] ?></td>
                                            <td class="py-3 font-semibold text-slate-900">Rp
                                                <?= number_format($bulan['pendapatan'], 0, ',', '.') ?></td>
                                            <td class="py-3">
                                                <?php if (isset($bulan['pertumbuhan'])): ?>
                                                    <span
                                                        class="<?= $bulan['pertumbuhan'] >= 0 ? 'text-emerald-600' : 'text-red-600' ?> font-semibold">
                                                        <?= $bulan['pertumbuhan'] >= 0 ? '+' : '' ?>            <?= $bulan['pertumbuhan'] ?>%
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="py-8 text-center text-gray-500">Tidak ada data laporan</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Download Laporan -->
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-8 rounded-lg shadow text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Unduh Laporan Lengkap</h3>
                            <p class="text-blue-100">Dapatkan laporan detail parkir dalam format PDF atau Excel</p>
                        </div>
                        <div class="space-x-3 flex">
                            <button
                                class="bg-white text-blue-600 hover:bg-gray-100 transition px-6 py-3 rounded-lg font-semibold flex items-center">
                                <i class="fas fa-file-pdf mr-2"></i>PDF
                            </button>
                            <button
                                class="bg-white text-blue-600 hover:bg-gray-100 transition px-6 py-3 rounded-lg font-semibold flex items-center">
                                <i class="fas fa-file-excel mr-2"></i>Excel
                            </button>
                        </div>
                    </div>
                </div>
            </main>
            <!-- End of Content -->

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 p-4 text-center text-gray-600 text-sm">
                <p>© 2026 Parkify. All rights reserved.</p>
            </footer>
        </div>
    </div>
    <?php include VIEWS_PATH . '/partials/parkify/logout-modal.php'; ?>
    <?php include VIEWS_PATH . '/partials/parkify/menu-scripts.php'; ?>
</body>

</html>
