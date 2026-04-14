<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parkify - Daftar Area Parkir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include VIEWS_PATH . '/partials/parkify/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <?php include VIEWS_PATH . '/partials/parkify/topbar.php'; ?>
            <!-- End of Header -->

            <!-- Content -->
            <main class="p-6 space-y-6 flex-1 overflow-y-auto">
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="mb-4 flex items-center justify-between">
                        <h2 class="text-xl font-bold">Daftar Area Parkir</h2>
                        <a href="/admin/tambahArea"
                            class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2">
                            <i class="fas fa-plus"></i><span>Tambah Area</span>
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="border-b-2 border-gray-300">
                                <tr>
                                    <th class="pb-3 font-semibold text-gray-700">No</th>
                                    <th class="pb-3 font-semibold text-gray-700">Nama Area</th>
                                    <th class="pb-3 font-semibold text-gray-700">Kapasitas</th>
                                    <th class="pb-3 font-semibold text-gray-700">Terisi</th>
                                    <th class="pb-3 font-semibold text-gray-700">Keterangan</th>
                                    <th class="pb-3 font-semibold text-gray-700">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($area)): ?>
                                    <?php $no = 1;
                                    foreach ($area as $row): ?>
                                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                                            <td class="py-3"><?= $no++ ?></td>
                                            <td class="py-3"><?= htmlspecialchars($row['nama_area']) ?></td>
                                            <td class="py-3"><?= $row['kapasitas'] ?></td>
                                            <td class="py-3"><?= $row['terisi'] ?></td>
                                            <td class="py-3"><?= htmlspecialchars($row['keterangan'] ?? 'Tanpa keterangan') ?></td>
                                            <td class="py-3 space-x-2">
                                                <a href="/parkir/editArea/<?= $row['id_area'] ?>"
                                                    class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded text-sm inline-flex items-center space-x-1">
                                                    <i class="fas fa-edit"></i><span>Edit</span>
                                                </a>
                                                <a href="/area/delete/<?= $row['id_area'] ?>"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm inline-flex items-center space-x-1"
                                                    onclick="return confirm('Yakin ingin menghapus area ini?')">
                                                    <i class="fas fa-trash"></i><span>Hapus</span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr class="border-b border-gray-200">
                                        <td colspan="6" class="py-8 text-center text-gray-500">
                                            <p><i class="fas fa-inbox text-3xl mb-2"></i></p>
                                            <p>Tidak ada data area</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <?php include VIEWS_PATH . '/partials/parkify/logout-modal.php'; ?>
            <?php include VIEWS_PATH . '/partials/parkify/menu-scripts.php'; ?>

</body>

</html>