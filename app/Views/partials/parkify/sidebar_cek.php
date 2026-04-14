<?php
$currentUrl = trim($_GET['url'] ?? 'dashboard/index', '/');

function navClass($path) {
    global $currentUrl;
    return $currentUrl === $path ? 'block py-2 px-4 rounded bg-slate-700' : 'block py-2 px-4 rounded hover:bg-slate-700';
}

function hasAccess($menu) {
    // Contoh pengecekan akses, sesuaikan dengan sistem akses kamu
    $akses = [
        'admin' => ['dashboard/index', 'admin/daftarUser', 'admin/tambahUser', 'parkir/area', 'parkir/tarif', 'parkir/masuk', 'parkir/riwayat', 'log/index'],
        'petugas' => ['dashboard/index', 'parkir/masuk', 'parkir/riwayat'],
        'owner' => ['dashboard/index', '']
    ];

    $role = $_SESSION['user']['role']; // Sesuaikan dengan sistem session kamu
    return in_array($menu, $akses[$role] ?? []);
}
?>

<div class="w-64 bg-slate-900 text-white flex flex-col">
    <div class="p-4 border-b border-slate-700">
        <div class="flex items-center">
            <i class="fas fa-car-side text-2xl mr-2"></i>
            <span class="text-xl font-bold">Parkify</span>
        </div>
    </div>
    <nav class="flex-1 p-4 overflow-y-auto">
        <ul class="space-y-2">
            <?php if (hasAccess('dashboard/index')): ?>
                <li><a href="<?= APP_URL ?>/dashboard/index" class="<?= navClass('dashboard/index') ?>"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
            <?php endif; ?>
            <?php if (hasAccess('admin/daftarUser')): ?>
                <li><a href="<?= APP_URL ?>/admin/daftarUser" class="<?= navClass('admin/daftarUser') ?>"><i class="fas fa-users mr-2"></i>Daftar User</a></li>
            <?php endif; ?>
            <?php if (hasAccess('admin/tambahUser')): ?>
                <li><a href="<?= APP_URL ?>/admin/tambahUser" class="<?= navClass('admin/tambahUser') ?>"><i class="fas fa-user-plus mr-2"></i>Tambah User</a></li>
            <?php endif; ?>
            <?php if (hasAccess('parkir/area')): ?>
                <li><a href="<?= APP_URL ?>/parkir/area" class="<?= navClass('parkir/area') ?>"><i class="fas fa-parking mr-2"></i>Area Parkir</a></li>
            <?php endif; ?>
            <?php if (hasAccess('parkir/tarif')): ?>
                <li><a href="<?= APP_URL ?>/parkir/tarif" class="<?= navClass('parkir/tarif') ?>"><i class="fas fa-wrench mr-2"></i>Atur Tarif</a></li>
            <?php endif; ?>
            <?php if (hasAccess('parkir/masuk')): ?>
                <li><a href="<?= APP_URL ?>/parkir/masuk" class="<?= navClass('parkir/masuk') ?>"><i class="fas fa-car mr-2"></i>Parkir Masuk</a></li>
            <?php endif; ?>
            <?php if (hasAccess('parkir/riwayat')): ?>
                <li><a href="<?= APP_URL ?>/parkir/riwayat" class="<?= navClass('parkir/riwayat') ?>"><i class="fas fa-history mr-2"></i>Riwayat Parkir</a></li>
            <?php endif; ?>
            <?php if (hasAccess('log/index')): ?>
                <li><a href="<?= APP_URL ?>/log/index" class="<?= navClass('log/index') ?>"><i class="fas fa-th mr-2"></i>Log Aktivitas</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
