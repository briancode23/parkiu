<div class="bg-white p-6 rounded-lg shadow">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-slate-900 flex items-center">
            <i class="fas fa-th text-blue-500 mr-3"></i>Status Slot Parkir
        </h2>
        <span class="text-sm font-medium bg-blue-100 text-blue-800 py-1 px-3 rounded-full">
            Total: <?= count($slots) ?> Slot
        </span>
    </div>

    <?php
    // 1. Logika Pengelompokan (Grouping)
    $groupedSlots = [];
    foreach ($slots as $slot) {
        $area = $slot['nama_area'] ?? 'Umum';
        $groupedSlots[$area][] = $slot;
    }
    ?>

    <!-- 2. Loop per Area -->
    <?php foreach ($groupedSlots as $areaName => $parkingSlots): ?>
        <div class="mb-8 last:mb-0">
            <h3 class="text-sm font-bold text-gray-500 mb-3 flex items-center uppercase tracking-wider">
                <i class="fas fa-map-marker-alt mr-2 text-blue-400"></i> <?= $areaName ?>
            </h3>
            
            <div class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-10 gap-3">
                <?php foreach ($parkingSlots as $slot): 
                    $isOccupied = ($slot['status'] == 'terisi' || $slot['status'] == '1');
                    $bgColor = $isOccupied ? 'bg-red-500' : 'bg-emerald-500';
                    $icon = $isOccupied ? 'fas fa-car' : 'fas fa-check';
                ?>
                    <div class="<?= $bgColor ?> text-white p-3 rounded-lg flex flex-col items-center justify-center transition-all hover:scale-105 shadow-sm" 
                         title="Slot: <?= $slot['nama_slot'] ?> (<?= $slot['status'] ?>)">
                        <i class="<?= $icon ?> text-lg mb-1"></i>
                        <span class="text-xs font-bold"><?= $slot['nama_slot'] ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- 3. Legend Status (Hanya muncul sekali di bawah) -->
    <div class="mt-8 pt-6 border-t border-gray-100 flex gap-6 text-xs font-bold uppercase tracking-wider">
        <div class="flex items-center text-emerald-600">
            <div class="w-4 h-4 bg-emerald-500 rounded mr-2"></div> TERSEDIA
        </div>
        <div class="flex items-center text-red-600">
            <div class="w-4 h-4 bg-red-500 rounded mr-2"></div> TERISI
        </div>
    </div>
</div>
