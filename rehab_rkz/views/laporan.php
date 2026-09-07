<?php
// c:\Users\louis\Documents\rehab\rehab_rkz\views\laporan.php
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login");
    exit;
}

// Ambil bulan ini
$start_date = date('Y-m-01');
$end_date = date('Y-m-t');

if (isset($_GET['start']) && isset($_GET['end'])) {
    $start_date = $_GET['start'];
    $end_date = $_GET['end'];
}

$stmt_total = $pdo->prepare("SELECT COUNT(*) FROM kunjungan WHERE tgl_kunjungan BETWEEN ? AND ?");
$stmt_total->execute(array($start_date, $end_date));
$total_kunjungan = $stmt_total->fetchColumn();

// Distribusi Status Kunjungan
$stmt_status = $pdo->prepare("SELECT status, COUNT(*) as jumlah FROM kunjungan WHERE tgl_kunjungan BETWEEN ? AND ? GROUP BY status");
$stmt_status->execute(array($start_date, $end_date));
$distribusi_status = $stmt_status->fetchAll();

// Kunjungan per hari
$stmt_harian = $pdo->prepare("SELECT tgl_kunjungan, COUNT(*) as jumlah FROM kunjungan WHERE tgl_kunjungan BETWEEN ? AND ? GROUP BY tgl_kunjungan ORDER BY tgl_kunjungan ASC");
$stmt_harian->execute(array($start_date, $end_date));
$tren_kunjungan = $stmt_harian->fetchAll();
?>
<div class="flex flex-col gap-space-xl">
  <!-- Top Banner -->
  <div class="relative w-full rounded-xl bg-surface-container-lowest shadow-sm p-space-xl overflow-hidden">
    <div class="absolute -right-16 -bottom-16 w-80 h-80 bg-primary-container/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="relative z-10 flex flex-col md:flex-row justify-between gap-space-lg">
      <div class="flex flex-col gap-space-sm">
        <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Laporan & Statistik</h2>
        <p class="font-body-md text-body-md text-on-surface-variant">Analisis kunjungan pasien Rehabilitasi Medik.</p>
      </div>
      
      <form method="GET" action="index.php" class="flex flex-col sm:flex-row items-end sm:items-center gap-space-sm">
          <input type="hidden" name="page" value="laporan">
          <div class="flex items-center gap-2">
              <input type="date" name="start" value="<?= htmlspecialchars($start_date) ?>" class="px-space-md py-2 bg-surface-container-low rounded-xl font-body-md border border-transparent focus:border-primary outline-none text-sm">
              <span class="text-on-surface-variant text-sm">s/d</span>
              <input type="date" name="end" value="<?= htmlspecialchars($end_date) ?>" class="px-space-md py-2 bg-surface-container-low rounded-xl font-body-md border border-transparent focus:border-primary outline-none text-sm">
          </div>
          <button type="submit" class="inline-flex items-center gap-2 px-space-md py-2 bg-primary text-on-primary font-label-md rounded-xl shadow-sm hover:bg-primary-container transition-all">
              <span class="material-symbols-outlined text-[18px]">filter_alt</span> Terapkan Filter
          </button>
      </form>
    </div>
  </div>

  <!-- KPI Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-space-base">
    <div class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm flex items-center justify-between border-l-4 border-primary">
      <div class="flex flex-col">
        <span class="font-label-md text-on-surface-variant uppercase tracking-wider text-xs font-bold">Total Kunjungan</span>
        <div class="flex items-baseline gap-space-sm mt-space-2xs">
          <span class="font-metric-display text-[32px] font-bold text-on-surface"><?= $total_kunjungan ?></span>
        </div>
      </div>
      <div class="w-12 h-12 rounded-xl bg-primary-fixed text-primary flex items-center justify-center">
        <span class="material-symbols-outlined text-[26px]">groups</span>
      </div>
    </div>
    <div class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm flex items-center justify-between border-l-4 border-emerald-500">
      <div class="flex flex-col">
        <span class="font-label-md text-on-surface-variant uppercase tracking-wider text-xs font-bold">Periode Aktif</span>
        <div class="flex items-baseline gap-space-sm mt-space-2xs">
          <span class="font-headline-md font-bold text-on-surface"><?= date('M Y', strtotime($start_date)) ?></span>
        </div>
      </div>
      <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
        <span class="material-symbols-outlined text-[26px]">calendar_month</span>
      </div>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-space-xl">
    <!-- Chart / Data 1 -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden">
      <div class="p-5 border-b border-surface-container flex items-center justify-between bg-surface-container-low/50">
          <h3 class="font-headline-sm font-bold text-on-surface">Tren Kunjungan Harian</h3>
      </div>
      <div class="p-5">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="text-on-surface-variant uppercase tracking-wider text-[11px] font-bold border-b border-surface-container">
                    <th class="py-3 px-4">Tanggal</th>
                    <th class="py-3 px-4 text-right">Jumlah Kunjungan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container text-on-surface">
                <?php if (count($tren_kunjungan) > 0): foreach ($tren_kunjungan as $tk): ?>
                <tr class="hover:bg-surface-container-low transition-colors">
                    <td class="py-3 px-4"><?= date('d M Y', strtotime($tk['tgl_kunjungan'])) ?></td>
                    <td class="py-3 px-4 text-right font-bold text-primary"><?= $tk['jumlah'] ?></td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="2" class="py-6 text-center text-on-surface-variant">Belum ada data pada periode ini.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
      </div>
    </div>

    <!-- Chart / Data 2 -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden">
      <div class="p-5 border-b border-surface-container flex items-center justify-between bg-surface-container-low/50">
          <h3 class="font-headline-sm font-bold text-on-surface">Distribusi Status</h3>
      </div>
      <div class="p-5">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="text-on-surface-variant uppercase tracking-wider text-[11px] font-bold border-b border-surface-container">
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4 text-right">Jumlah</th>
                    <th class="py-3 px-4 w-1/3">Persentase</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container text-on-surface">
                <?php if (count($distribusi_status) > 0): foreach ($distribusi_status as $ds): 
                    $pct = ($total_kunjungan > 0) ? round(($ds['jumlah'] / $total_kunjungan) * 100) : 0;
                ?>
                <tr class="hover:bg-surface-container-low transition-colors">
                    <td class="py-3 px-4 font-semibold uppercase"><?= htmlspecialchars($ds['status']) ?></td>
                    <td class="py-3 px-4 text-right"><?= $ds['jumlah'] ?></td>
                    <td class="py-3 px-4">
                        <div class="w-full bg-surface-container rounded-full h-2">
                            <div class="bg-primary h-2 rounded-full" style="width: <?= $pct ?>%"></div>
                        </div>
                        <span class="text-[10px] text-on-surface-variant mt-1 inline-block"><?= $pct ?>%</span>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="3" class="py-6 text-center text-on-surface-variant">Belum ada data pada periode ini.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
