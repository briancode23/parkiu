<?php
// 1. Ambil path dari URL browser
$fullPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 2. Bersihkan prefix dan ambil path bersih
// Kita pakai trim untuk memastikan tidak ada slash yang mengganggu di awal/akhir
$currentUrl = trim(str_replace(['/cek/', 'index.php'], '', $fullPath), '/');

// 3. Default jika kosong
if ($currentUrl === '') {
    $currentUrl = 'dashboard';
}

/**
* Fungsi diperbaiki: membandingkan URL saat ini dengan target path
*/
function getActiveLabel($targetPath, $currentUrl) {
    // Pastikan kedua string bersih dari slash sebelum dibandingkan
    $target = trim($targetPath, '/');

    if ($currentUrl === $target) {
        return 'bg-slate-700';
    }
    return 'hover:bg-slate-700';
}

function hasAccess($menu) {
    // Contoh pengecekan akses, sesuaikan dengan sistem akses kamu
    $akses = [
        'admin' => ['dashboard',
            'admin/daftarUser',
            'admin/tambahUser',
            'parkir/area',
            'parkir/tarif',
            'parkir/masuk',
            'parkir/riwayat',
            'log'],
        'petugas' => ['dashboard',
            'parkir/masuk',
            'parkir/riwayat'],
        'owner' => ['dashboard',
            'parkir/laporan']
    ];

    $role = $_SESSION['user']['role']; // Sesuaikan dengan sistem session kamu
    return in_array($menu, $akses[$role] ?? []);
}
?>

<div class="w-64 h-screen bg-slate-900 text-white flex flex-col">
    <div class="p-4 border-b border-slate-700">
        <div class="flex items-center justify-center">
            <i class="fas fa-car-side text-2xl mr-2"></i>
            <span class="text-xl font-bold">Parkify</span>
        </div>
    </div>

    <nav class="flex-1 p-4 overflow-y-auto">
        <ul class="space-y-2">
            <?php if (hasAccess('dashboard')): ?>
            <li>
                <a href="<?= APP_URL ?>/dashboard" class="block py-2 px-4 rounded <?= getActiveLabel('dashboard', $currentUrl) ?>">
                    <i class="fas fa-tachometer-alt w-6"></i> Dashboard
                </a>
            </li>
            <?php endif; ?>
            <?php if (hasAccess('admin/daftarUser')): ?>
            <li>
                <a href="<?= APP_URL ?>/admin/daftarUser" class="block py-2 px-4 rounded <?= getActiveLabel('admin/daftarUser', $currentUrl) ?>">
                    <i class="fas fa-users w-6"></i> Daftar User
                </a>
            </li>
            <?php endif; ?>
            <?php if (hasAccess('admin/tambahUser')): ?>
            <li>
                <a href="<?= APP_URL ?>/admin/tambahUser" class="block py-2 px-4 rounded <?= getActiveLabel('admin/tambahUser', $currentUrl) ?>">
                    <i class="fas fa-user-plus w-6"></i> Tambah User
                </a>
            </li>
            <?php endif; ?>
            <?php if (hasAccess('parkir/area')): ?>
            <li>
                <a href="<?= APP_URL ?>/parkir/area" class="block py-2 px-4 rounded <?= getActiveLabel('parkir/area', $currentUrl) ?>">
                    <i class="fas fa-parking w-6"></i> Area Parkir
                </a>
            </li>
            <?php endif; ?>
            <?php if (hasAccess('parkir/tarif')): ?>
            <li>
                <a href="<?= APP_URL ?>/parkir/tarif" class="block py-2 px-4 rounded <?= getActiveLabel('parkir/tarif', $currentUrl) ?>">
                    <i class="fas fa-wrench w-6"></i> Atur Tarif
                </a>
            </li>
            <?php endif; ?>
            <?php if (hasAccess('parkir/masuk')): ?>
            <li>
                <a href="<?= APP_URL ?>/parkir/masuk" class="block py-2 px-4 rounded <?= getActiveLabel('parkir/masuk', $currentUrl) ?>">
                    <i class="fas fa-car w-6"></i> Parkir Masuk
                </a>
            </li>
            <?php endif; ?>
            <?php if (hasAccess('parkir/riwayat')): ?>
            <li>
                <a href="<?= APP_URL ?>/parkir/riwayat" class="block py-2 px-4 rounded <?= getActiveLabel('parkir/riwayat', $currentUrl) ?>">
                    <i class="fas fa-history w-6"></i> Riwayat Parkir
                </a>
            </li>
            <?php endif; ?>
            <?php if (hasAccess('parkir')): ?>
            <li>
                <a href="<?= APP_URL ?>/parkir" class="block py-2 px-4 rounded <?= getActiveLabel('parkir', $currentUrl) ?>">
                    <i class="fas fa-list w-6"></i> Daftar Parkir
                </a>
            </li>
            <?php endif; ?>
            <?php if (hasAccess('log')): ?>
            <li>
                <a href="<?= APP_URL ?>/log" class="block py-2 px-4 rounded <?= getActiveLabel('log', $currentUrl) ?>">
                    <i class="fas fa-th w-6"></i> Log Aktivitas
                </a>
            </li>
            <?php endif; ?>
            <?php if (hasAccess('parkir/laporan')): ?>
            <li>
                <a href="<?= APP_URL ?>/parkir/laporan" class="block py-2 px-4 rounded <?= getActiveLabel('parkir/laporan', $currentUrl) ?>">
                    <i class="fas fa-file w-6"></i> Log Aktivitas
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>