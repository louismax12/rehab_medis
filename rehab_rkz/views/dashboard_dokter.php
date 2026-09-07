<?php
// c:\Users\louis\Documents\rehab\rehab_rkz\views\dashboard_dokter.php
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'dokter') {
    header("Location: index.php?page=login");
    exit;
}
$today = date('Y-m-d');
$stmt_kunj = $pdo->prepare("SELECT COUNT(*) FROM kunjungan WHERE dokter_id = ? AND tgl_kunjungan = ?");
$stmt_kunj->execute(array($_SESSION['user_id'], $today));
$kunjungan_hari_ini = $stmt_kunj->fetchColumn();

// Ambil data antrean
$stmt = $pdo->prepare("SELECT k.*, p.nama, p.no_rm FROM kunjungan k JOIN pasien p ON k.no_rm = p.no_rm WHERE k.dokter_id = ? AND k.tgl_kunjungan = ? ORDER BY k.no_register ASC");
$stmt->execute(array($_SESSION['user_id'], $today));
$antrian = $stmt->fetchAll();
?>

<!-- Top Welcome & Doctor Clinical Context Banner -->
<div class="relative w-full rounded-xl bg-surface-container-lowest shadow-sm p-space-xl overflow-hidden mb-space-xl">
  <div class="absolute -right-16 -bottom-16 w-80 h-80 bg-primary-container/5 rounded-full blur-3xl pointer-events-none"></div>
  <div class="absolute right-72 -top-12 w-64 h-64 bg-tertiary/5 rounded-full blur-2xl pointer-events-none"></div>
  
  <div class="relative z-10 flex flex-col xl:flex-row xl:items-center justify-between gap-space-lg">
    <div class="flex flex-col gap-space-2xs">
      <div class="flex items-center gap-space-sm flex-wrap">
        <span class="inline-flex items-center gap-space-2xs px-space-sm py-space-2xs bg-tertiary/10 text-tertiary rounded-full font-label-sm text-label-sm">
          <span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span>
          Poli Rehab Medik
        </span>
      </div>
      <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight mt-space-xs">
        <?= htmlspecialchars($_SESSION['nama_lengkap']) ?>
      </h1>
      <p class="font-body-md text-body-md text-on-surface-variant">
        Dashboard Antrean Pemeriksaan Fisik & Asesmen Klinis
      </p>
    </div>
  </div>
</div>

<!-- KPI Metric Summary Bar -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-base mb-space-xl">
  <!-- Stat 1: Menunggu -->
  <div class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm flex items-center justify-between transition-all hover:translate-y-[-2px]">
    <div class="flex flex-col">
      <span class="font-label-md text-label-md text-on-surface-variant">Total Antrean Hari Ini</span>
      <div class="flex items-baseline gap-space-sm mt-space-2xs">
        <span class="font-metric-display text-metric-display text-on-surface"><?= $kunjungan_hari_ini ?></span>
      </div>
    </div>
    <div class="w-12 h-12 rounded-xl bg-surface-container-low text-on-surface-variant flex items-center justify-center">
      <span class="material-symbols-outlined text-[26px]">groups</span>
    </div>
  </div>
  <!-- Stat 2: Sedang Konsultasi -->
  <div class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm flex items-center justify-between transition-all hover:translate-y-[-2px]">
    <div class="flex flex-col">
      <span class="font-label-md text-label-md text-on-surface-variant">Menunggu</span>
      <div class="flex items-baseline gap-space-sm mt-space-2xs">
        <span class="font-metric-display text-metric-display text-primary-container"><?= $kunjungan_hari_ini ?></span>
      </div>
    </div>
    <div class="w-12 h-12 rounded-xl bg-primary-fixed text-primary flex items-center justify-center">
      <span class="material-symbols-outlined text-[26px]">hourglass_top</span>
    </div>
  </div>
</div>

<!-- Main Grid Layout: 8 cols (Queue List) + 4 cols (Patient Snapshot & Clinical Drawer) -->
<div class="grid grid-cols-1 xl:grid-cols-12 gap-space-xl items-start">
  <!-- LEFT PANEL: Patient Queue Workspace (Col-span 8) -->
  <div class="xl:col-span-12 flex flex-col gap-space-md">
    
    <!-- Filter & Search Toolbar Card -->
    <div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm flex flex-col gap-space-md">
      <div class="flex flex-col sm:flex-row items-center gap-space-md">
        <div class="relative flex-1 w-full">
          <span class="material-symbols-outlined absolute left-space-md top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
          <input type="text" class="w-full h-11 pl-11 pr-space-md bg-surface-container-low rounded-xl font-body-md text-body-md text-on-surface placeholder:text-on-surface-variant focus:outline-none focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary-container/20 transition-all" placeholder="Cari nama pasien, No. RM..." />
        </div>
      </div>
    </div>
    
    <!-- Patient Queue Cards Stack -->
    <div class="flex flex-col gap-space-sm" id="queue-container">
      <?php if(count($antrian) > 0): foreach($antrian as $idx => $row): ?>
      <div class="group relative bg-surface-container-lowest rounded-xl p-space-lg shadow-sm transition-all hover:shadow-md hover:bg-surface-bright">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-space-md">
          <div class="flex items-start gap-space-md flex-1 min-w-0">
            <div class="flex flex-col items-center justify-center min-w-[70px] h-[72px] bg-surface-container text-on-surface-variant rounded-xl px-space-xs">
              <span class="font-display-sm text-display-sm text-on-surface leading-none font-bold">#<?= $idx+1 ?></span>
              <span class="font-label-sm text-label-sm text-outline uppercase tracking-tight mt-1"><?= htmlspecialchars($row['no_register']) ?></span>
            </div>
            <div class="flex flex-col min-w-0 flex-1">
              <div class="flex items-center gap-space-xs flex-wrap">
                <span class="font-headline-lg text-headline-lg text-on-surface tracking-tight font-bold">
                  RM-<?= htmlspecialchars($row['no_rm']) ?>
                </span>
                <span class="px-space-xs py-space-2xs rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm uppercase font-semibold">
                  Umum/BPJS
                </span>
              </div>
              <div class="font-headline-md text-headline-md text-on-surface tracking-tight truncate mt-0.5">
                <?= htmlspecialchars($row['nama']) ?>
              </div>
            </div>
          </div>
          <!-- Right Actions -->
          <div class="flex flex-col lg:items-end gap-space-md shrink-0">
            <div class="flex items-center gap-space-xs">
              <span class="inline-flex items-center gap-1.5 px-space-md py-1 rounded-full bg-surface-container-high text-on-secondary-container font-label-md text-label-md">
                <span class="w-2 h-2 rounded-full bg-outline"></span> Menunggu
              </span>
            </div>
            <div class="flex items-center gap-space-xs flex-wrap">
              <a href="index.php?page=anamnesis&kunjungan_id=<?= $row['id'] ?>" class="inline-flex items-center gap-space-xs px-space-lg py-2.5 bg-primary text-on-primary font-headline-sm text-headline-sm rounded-xl shadow-sm hover:bg-primary-container transition-all">
                <span class="material-symbols-outlined text-[18px]">stethoscope</span>
                <span>Mulai Periksa</span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; else: ?>
        <div class="text-center py-10 text-on-surface-variant">
            <span class="material-symbols-outlined text-[48px] opacity-50 mb-2">event_busy</span>
            <p>Belum ada antrean saat ini.</p>
        </div>
      <?php endif; ?>
    </div>
    
  </div>
</div>
