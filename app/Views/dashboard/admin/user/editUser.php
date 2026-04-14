<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parkify - Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <?php include VIEWS_PATH . '/partials/parkify/sidebar.php'; ?>
        <div class="flex-1 flex flex-col">
            <?php include VIEWS_PATH . '/partials/parkify/topbar.php'; ?>
            <main class="p-6 space-y-6 flex-1 overflow-y-auto">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">Edit User</h2>
                    <form action="admin/update" method="post">
                        <!-- ID User disembunyikan tapi dikirim saat submit -->
                        <input type="hidden" name="id" value="<?= $data['id_user'] ?>">

                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($data['nama_lengkap']) ?>" class="w-full p-2 border border-gray-300 rounded-lg" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2">Username</label>
                            <input type="text" name="username" value="<?= htmlspecialchars($data['username']) ?>" class="w-full p-2 border border-gray-300 rounded-lg" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2">Role</label>
                            <select name="role" class="w-full p-2 border border-gray-300 rounded-lg">
                                <option value="admin" <?= ($data['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                                <option value="petugas" <?= ($data['role'] == 'petugas') ? 'selected' : '' ?>>Petugas</option>
                                <option value="owner" <?= ($data['role'] == 'owner') ? 'selected' : '' ?>>Owner</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2">Status</label>
                            <select name="status_aktif" class="w-full p-2 border border-gray-300 rounded-lg">
                                <option value="1" <?= ($data['status_aktif'] == 1) ? 'selected' : '' ?>>Aktif</option>
                                <option value="0" <?= ($data['status_aktif'] == 0) ? 'selected' : '' ?>>Tidak Aktif</option>
                            </select>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold">Update Data</button>
                            <a href="/admin/daftarUser" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold">Batal</a>
                        </div>
                    </form>

                </div>
            </main>
        </div>
    </div>
</body>
</html>