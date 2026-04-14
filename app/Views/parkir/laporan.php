<div class="flex h-screen">
    <?php include VIEWS_PATH . '/partials/parkify/sidebar.php'; ?>
    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <?php include VIEWS_PATH . '/partials/parkify/topbar.php'; ?>
        <!-- Content -->
        <main class="p-6 space-y-6 flex-1 overflow-y-auto">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-bold mb-4">Laporan Parkir</h2>
                <form method="GET" class="mb-4">
                    <input type="hidden" name="url" value="parkir/laporan">
                    <div class="flex space-x-2">
                        <input type="date" name="tanggal_awal" class="px-4 py-2 border border-gray-300 rounded-lg" value="<?= $_GET['tanggal_awal'] ?? date('Y-m-01') ?>">
                        <input type="date" name="tanggal_akhir" class="px-4 py-2 border border-gray-300 rounded-lg" value="<?= $_GET['tanggal_akhir'] ?? date('Y-m-d') ?>">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">Filter</button>
                    </div>
                </form>
                <table class="w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">No</th>
                            <th class="px-4 py-2 border">Tanggal</th>
                            <th class="px-4 py-2 border">Nomor Polisi</th>
                            <th class="px-4 py-2 border">Jenis Kendaraan</th>
                            <th class="px-4 py-2 border">Waktu Masuk</th>
                            <th class="px-4 py-2 border">Waktu Keluar</th>
                            <th class="px-4 py-2 border">Tarif</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $i => $row): ?>
                            <tr>
                                <td class="px-4 py-2 border"><?= $i + 1 ?></td>
                                <td class="px-4 py-2 border"><?= $row['tanggal'] ?></td>
                                <td class="px-4 py-2 border"><?= $row['nomor_polisi'] ?></td>
                                <td class="px-4 py-2 border"><?= $row['jenis_kendaraan'] ?></td>
                                <td class="px-4 py-2 border"><?= $row['waktu_masuk'] ?></td>
                                <td class="px-4 py-2 border"><?= $row['waktu_keluar'] ?></td>
                                <td class="px-4 py-2 border"><?= $row['tarif'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="mt-4">
                    <a href="<?= APP_URL ?>/parkir/laporan/cetak?tanggal_awal=<?= $_GET['tanggal_awal'] ?? date('Y-m-01') ?>&tanggal_akhir=<?= $_GET['tanggal_akhir'] ?? date('Y-m-d') ?>" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">Cetak Laporan</a>
                </div>
            </div>
        </main>
    </div>
</div>
