<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parkify - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include VIEWS_PATH . '/partials/parkify/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <div class="flex-1 flex flex-col">
            <?php include VIEWS_PATH . '/partials/parkify/topbar.php'; ?>

            <!-- Content -->
            <main class="p-6 space-y-6">
                <!-- Cards Section -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- Card 1: Total User -->
                    <div class="bg-white p-6 rounded-lg shadow flex items-center">
                        <div class="flex items-center w-full">
                            <!-- flex-shrink-0 agar icon tidak gepeng saat teks panjang -->
                            <div class="flex-shrink-0 p-4 bg-green-500 rounded-full">
                                <i class="fas fa-id-card text-white text-2xl w-6 h-6 flex items-center justify-center"></i>
                            </div>
                            <!-- flex-1 agar teks mengambil sisa ruang, whitespace-normal agar teks turun ke bawah jika penuh -->
                            <div class="ml-4 flex-1">
                                <p class="text-gray-500 text-sm font-medium leading-tight whitespace-normal">
                                    Total User
                                </p>
                                <p class="text-2xl font-bold text-gray-800 break-words">
                                    <?= isset($totalUser) ? $totalUser : 0 ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Jumlah Area -->
                    <div class="bg-white p-6 rounded-lg shadow flex items-center">
                        <div class="flex items-center w-full">
                            <div class="flex-shrink-0 p-4 bg-indigo-500 rounded-full">
                                <i class="fas fa-parking text-white text-2xl w-6 h-6 flex items-center justify-center"></i>
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="text-gray-500 text-sm font-medium leading-tight whitespace-normal">
                                    Jumlah Area Parkir
                                </p>
                                <p class="text-2xl font-bold text-gray-800 break-words">
                                    <?= isset($totalArea) ? $totalArea : 0 ?> Area
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Grafik Parkir (Lebar 2 Kolom) -->
                    <div class="bg-white p-6 rounded-lg shadow col-span-1 md:col-span-2">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Grafik Parkir</h3>
                        <!-- canvas tanpa fixed height agar menyesuaikan container -->
                        <div class="w-full">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>


                <!-- End of Cards Section -->
                <!-- Status Area -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-xl font-bold mb-4">Status Area Parkir</h2>
                    <?php foreach ($persentase as $area): ?>
                    <div class="mb-4">
                        <div class="flex justify-between">
                            <span class="font-bold"><?= htmlspecialchars($area['nama_area']) ?></span>
                            <span><?= $area['persentase'] ?>%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: <?= $area['persentase'] ?>%">
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <!-- Slot Grid -->
            </main>
            <!-- End of Content -->

        </div>
    </div>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const chartData = <?= $chartData ?>;
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Parkir Harian',
                    data: chartData.data,
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <?php include VIEWS_PATH . '/partials/parkify/logout-modal.php'; ?>

    <?php include VIEWS_PATH . '/partials/parkify/menu-scripts.php'; ?>
</body>

</html>