<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parkify - Dashboard Petugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include VIEWS_PATH . '/partials/parkify/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <?php include VIEWS_PATH . '/partials/parkify/topbar.php'; ?>
            <!-- End of Header -->

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6 space-y-6">
                <!-- Status Cards: 3 kolom grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Card 1: Kendaraan Masuk Hari Ini -->
                    <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                        <div class="flex items-center">
                            <div class="p-4 bg-blue-500 rounded-full">
                                <i class="fas fa-arrow-right text-white text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-600 text-sm font-semibold">Kendaraan Masuk Hari Ini</p>
                                <p class="text-3xl font-bold text-slate-900"><?= isset($hariIni) ? $hariIni : 0 ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Total Kendaraan Keluar Hari Ini -->
                    <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                        <div class="flex items-center">
                            <div class="p-4 bg-emerald-500 rounded-full">
                                <i class="fas fa-arrow-left text-white text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-600 text-sm font-semibold">Kendaraan Keluar Hari Ini</p>
                                <p class="text-3xl font-bold text-slate-900"><?= isset($hariIniOut) ? $hariIniOut : 0 ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Status Area Parkir (akan ditampilkan chart) -->
                    <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                        <div class="flex items-center">
                            <div class="p-4 bg-orange-500 rounded-full">
                                <i class="fas fa-chart-bar text-white text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-600 text-sm font-semibold">Total Area Parkir</p>
                                <p class="text-3xl font-bold text-slate-900"><?= isset($totalArea) ? $totalArea : 0 ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Area Parkir - Horizontal Progress Bars -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center">
                        <i class="fas fa-parking text-blue-500 mr-3"></i>Status Area Parkir
                    </h2>

                    <?php if (isset($persentase) && !empty($persentase)): ?>
                        <div class="space-y-6">
                            <?php foreach ($persentase as $area):
                                $percent = isset($area['persentase']) ? $area['persentase'] : 0;

                                // Determine color based on percentage
                                if ($percent < 50):
                                    $bgColor = 'bg-emerald-500';
                                    $statusText = 'Tersedia';
                                elseif ($percent < 80):
                                    $bgColor = 'bg-yellow-500';
                                    $statusText = 'Hampir Penuh';
                                else:
                                    $bgColor = 'bg-red-500';
                                    $statusText = 'Penuh';
                                endif;
                                ?>
                                <div>
                                    <div class="flex justify-between items-center mb-2">
                                        <h4 class="font-bold text-slate-900"><?= htmlspecialchars($area['nama_area']) ?></h4>
                                        <span class="text-sm font-semibold text-gray-600"><?= $percent ?>% -
                                            <?= $statusText ?></span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="<?= $bgColor ?> h-3 rounded-full transition-all duration-300"
                                            style="width: <?= $percent ?>%"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-500 text-center py-4">Tidak ada data area parkir</p>
                    <?php endif; ?>
                </div>

                <!-- Slot Grid: Visualisasi (sesuai jumlah slot -->
                <?php // include VIEWS_PATH . '/partials/parkify/slot.php'; ?>
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