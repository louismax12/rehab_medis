<?php
// c:\Users\louis\Documents\rehab\rehab_rkz\views\kunjungan.php
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php?page=login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("INSERT INTO kunjungan (no_register, no_rm, tgl_kunjungan, dokter_id) VALUES (?, ?, ?, ?)");
        $stmt->execute(array($_POST['no_register'], $_POST['no_rm'], $_POST['tgl_kunjungan'], $_POST['dokter_id']));
        $success = "Kunjungan berhasil didaftarkan.";
    } catch(Exception $e) {
        $error = "Gagal menyimpan: " . $e->getMessage();
    }
}
?>

<!-- Top Context / Breadcrumbs Bar -->
<div class="flex flex-wrap items-center justify-between gap-space-md py-space-md">
    <div class="flex items-center gap-space-xs text-on-surface-variant font-label-md text-label-md">
        <span class="hover:text-primary transition-colors cursor-pointer">Instalasi Rehabilitasi Medik</span>
        <span class="material-symbols-outlined text-[16px] text-outline-variant">chevron_right</span>
        <span class="hover:text-primary transition-colors cursor-pointer">Pelayanan Loket</span>
        <span class="material-symbols-outlined text-[16px] text-outline-variant">chevron_right</span>
        <span class="text-primary font-semibold">Registrasi &amp; Antrean Kunjungan</span>
    </div>
    <!-- Active Operational Badge -->
    <div class="flex items-center gap-space-sm bg-surface-container px-space-md py-space-xs rounded-full shadow-sm">
        <span class="flex h-2.5 w-2.5 relative">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-tertiary opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-tertiary"></span>
        </span>
        <span class="font-label-sm text-label-sm text-on-surface font-semibold tracking-wide">LOKET 02 - ADMISI AKTIF</span>
        <span class="text-outline-variant font-label-sm text-label-sm">|</span>
        <span class="font-label-sm text-label-sm text-on-surface-variant flex items-center gap-space-2xs">
            <span class="material-symbols-outlined text-[15px]">schedule</span> <?= date('l, d M Y') ?> • Shift Pagi
        </span>
    </div>
</div>

<?php if(isset($success)): ?>
    <div class="bg-primary-container text-on-primary px-4 py-3 rounded-xl text-sm mb-6 flex items-center gap-2 shadow-sm font-bold">
        <span class="material-symbols-outlined">check_circle</span>
        <span><?= htmlspecialchars($success) ?></span>
    </div>
<?php endif; ?>
<?php if(isset($error)): ?>
    <div class="bg-error-container text-on-error-container px-4 py-3 rounded-xl text-sm mb-6 flex items-center gap-2 shadow-sm font-bold">
        <span class="material-symbols-outlined">error</span>
        <span><?= htmlspecialchars($error) ?></span>
    </div>
<?php endif; ?>

<!-- Main Headline Block with Visual Telemetry -->
<div class="relative overflow-hidden rounded-xl bg-surface-container-lowest p-space-xl shadow-sm mb-space-xl">
    <div class="absolute right-0 top-0 -mt-6 -mr-6 w-96 h-96 bg-primary-container/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-space-lg">
        <div>
            <div class="flex items-center gap-space-sm mb-space-xs">
                <span class="px-space-xs py-space-2xs bg-primary/10 text-primary rounded font-label-sm text-label-sm uppercase tracking-wider font-semibold">ADMISI RAWAT JALAN</span>
                <span class="text-outline-variant font-label-sm text-label-sm">•</span>
                <span class="text-on-surface-variant font-label-sm text-label-sm">Rehabilitasi Medik Terpadu RKZ</span>
            </div>
            <h1 class="font-display-sm text-display-sm text-on-surface tracking-tight font-semibold">Registrasi Kunjungan Pasien Poli Rehab</h1>
            <p class="font-body-md text-body-md text-on-surface-variant mt-space-2xs max-w-3xl">
                Pendaftaran pemeriksaan spesialis KFR, penjadwalan fisioterapi, dan alokasi kuota antrean poli klinik otomatis secara terintegrasi dengan SIMRS.
            </p>
        </div>
        <!-- Quick Metrics Pill Counter -->
        <div class="flex items-center gap-space-md self-start lg:self-auto">
            <div class="bg-surface-container-low px-space-lg py-space-sm rounded-lg flex flex-col">
                <span class="font-label-sm text-label-sm uppercase text-secondary">Sisa Kuota Pagi</span>
                <div class="flex items-baseline gap-space-xs mt-space-2xs">
                    <span class="font-metric-display text-metric-display text-primary font-bold">14</span>
                    <span class="font-body-sm text-body-sm text-on-surface-variant">/ 60 kursi</span>
                </div>
            </div>
            <div class="bg-surface-container-low px-space-lg py-space-sm rounded-lg flex flex-col">
                <span class="font-label-sm text-label-sm uppercase text-secondary">Rata-rata Waktu Tunggu</span>
                <div class="flex items-baseline gap-space-xs mt-space-2xs">
                    <span class="font-metric-display text-metric-display text-tertiary font-bold">18</span>
                    <span class="font-body-sm text-body-sm text-on-surface-variant">menit</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Registration Form Card: Bento-Structured Formulir Alokasi Antrean -->
<section class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden mb-space-2xl">
    <div class="px-space-xl py-space-lg bg-surface-container-low flex flex-wrap items-center justify-between gap-space-md">
        <div class="flex items-center gap-space-md">
            <div class="w-10 h-10 rounded-lg bg-primary text-on-primary flex items-center justify-center">
                <span class="material-symbols-outlined text-[22px]">how_to_reg</span>
            </div>
            <div>
                <h2 class="font-headline-sm text-headline-sm text-on-surface font-semibold">Formulir Alokasi Antrean &amp; Pendaftaran Kunjungan</h2>
                <p class="font-body-sm text-body-sm text-on-surface-variant">Isi parameter kunjungan pasien untuk menerbitkan nomor antrean poli dan lembar tracer</p>
            </div>
        </div>
        <?php $reg_no = 'REG-' . date('YmdHis'); ?>
        <div class="flex items-center gap-space-sm bg-surface-container-lowest px-space-md py-space-xs rounded-lg shadow-sm">
            <span class="material-symbols-outlined text-primary text-[18px]">fingerprint</span>
            <div class="flex flex-col">
                <span class="font-label-sm text-label-sm text-outline font-semibold uppercase tracking-wider">No. Registrasi Sistem</span>
                <span class="font-headline-sm text-headline-sm text-primary font-bold tracking-tight"><?= $reg_no ?></span>
            </div>
        </div>
    </div>

    <!-- Interactive Registration Form -->
    <form action="index.php?page=kunjungan" method="POST" class="p-space-xl flex flex-col gap-space-xl">
        <input type="hidden" name="no_register" value="<?= $reg_no ?>">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-space-xl">
            <!-- Field 1: Cari & Pilih Pasien -->
            <div class="xl:col-span-2 flex flex-col gap-space-xs relative">
                <div class="flex items-center justify-between">
                    <label class="font-label-md text-label-md text-on-surface font-semibold flex items-center gap-space-2xs">
                        <span class="material-symbols-outlined text-[16px] text-primary">person_search</span> Pilih Pasien
                    </label>
                    <a href="index.php?page=pasien" class="text-primary font-label-sm text-label-sm font-semibold hover:underline flex items-center gap-space-2xs">
                        <span class="material-symbols-outlined text-[14px]">add_circle</span> Pasien Baru
                    </a>
                </div>
                <div class="relative">
                    <select name="no_rm" class="w-full h-11 px-space-md bg-surface-container-lowest rounded-lg font-body-md text-body-md text-on-surface shadow-sm focus:outline-none focus:bg-surface-container-low transition-all appearance-none cursor-pointer" required>
                        <option value="">-- Pilih Pasien --</option>
                        <?php
                        $pasien_list = $pdo->query("SELECT no_rm, nama FROM pasien ORDER BY nama ASC")->fetchAll();
                        foreach($pasien_list as $p):
                        ?>
                        <option value="<?= htmlspecialchars($p['no_rm']) ?>"><?= htmlspecialchars($p['no_rm']) ?> - <?= htmlspecialchars($p['nama']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="material-symbols-outlined absolute right-space-md top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px] pointer-events-none">arrow_drop_down</span>
                </div>
            </div>

            <!-- Field 2: DPJP Pilihan -->
            <div class="flex flex-col gap-space-xs">
                <label class="font-label-md text-label-md text-on-surface font-semibold flex items-center gap-space-2xs">
                    <span class="material-symbols-outlined text-[16px] text-primary">stethoscope</span> Dokter Penanggung Jawab
                </label>
                <div class="relative">
                    <select name="dokter_id" class="w-full h-11 px-space-md bg-surface-container-lowest rounded-lg font-body-md text-body-md text-on-surface shadow-sm focus:outline-none focus:bg-surface-container-low transition-all appearance-none cursor-pointer" required>
                        <option value="">-- Pilih Dokter --</option>
                        <?php
                        $dokter_list = $pdo->query("SELECT id, nama_lengkap FROM hrd.datadasar WHERE role = 'dokter' ORDER BY nama_lengkap ASC")->fetchAll();
                        foreach($dokter_list as $d):
                        ?>
                        <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['nama_lengkap']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="material-symbols-outlined absolute right-space-md top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px] pointer-events-none">arrow_drop_down</span>
                </div>
            </div>

            <!-- Field 3: Waktu Kedatangan -->
            <div class="flex flex-col gap-space-xs">
                <label class="font-label-md text-label-md text-on-surface font-semibold flex items-center gap-space-2xs">
                    <span class="material-symbols-outlined text-[16px] text-primary">event_available</span> Tanggal Kunjungan
                </label>
                <input name="tgl_kunjungan" type="date" value="<?= date('Y-m-d') ?>" class="w-full h-11 px-space-sm bg-surface-container-lowest rounded-lg font-body-md text-body-md text-on-surface shadow-sm focus:outline-none focus:bg-surface-container-low" required>
            </div>
        </div>

        <!-- Action Panel -->
        <div class="pt-space-lg flex flex-wrap items-center justify-end gap-space-md bg-surface-bright p-space-md rounded-lg">
            <button type="submit" class="inline-flex items-center gap-space-xs h-11 px-space-xl bg-primary text-on-primary font-label-md text-label-md rounded-lg shadow-md hover:bg-primary-container transition-all">
                <span>Daftarkan ke Antrean Poli</span>
            </button>
        </div>
    </form>
</section>

<!-- Section: Antrean Kunjungan Aktif Hari Ini -->
<?php
$today = date('Y-m-d');
$stmt = $pdo->prepare("SELECT k.*, p.nama AS nama_pasien, p.tgl_lahir, d.nama_lengkap AS nama_dokter FROM kunjungan k JOIN pasien p ON k.no_rm = p.no_rm LEFT JOIN hrd.datadasar d ON k.dokter_id = d.id WHERE k.tgl_kunjungan = ? ORDER BY k.id DESC");
$stmt->execute(array($today));
$antrean = $stmt->fetchAll();
$total_antrean = count($antrean);
?>
<section class="flex flex-col gap-space-lg">
    <!-- Header Controls -->
    <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-space-md">
        <div>
            <div class="flex items-center gap-space-xs">
                <h3 class="font-headline-md text-headline-md text-on-surface font-semibold">Antrean Kunjungan Aktif Hari Ini</h3>
                <span class="px-space-xs py-space-2xs rounded-full bg-primary-container text-on-primary font-label-sm text-label-sm font-semibold"><?= $total_antrean ?> Pasien Terdaftar</span>
            </div>
            <p class="font-body-sm text-body-sm text-on-surface-variant mt-space-2xs">Real-time status triage poli rehabilitasi medik.</p>
        </div>
        <div class="flex flex-wrap items-center gap-space-md">
            <div class="relative w-72">
                <span class="material-symbols-outlined absolute left-space-md top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px]">filter_list</span>
                <input type="text" id="queue-search" onkeyup="filterQueueList()" placeholder="Cari antrean / pasien..." class="w-full h-10 pl-10 pr-space-md bg-surface-container-lowest rounded-lg font-body-sm text-body-sm text-on-surface placeholder:text-outline shadow-sm focus:outline-none focus:bg-surface-container-low transition-colors">
            </div>
        </div>
    </div>

    <!-- Active Table Panel -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" id="queue-table">
                <thead>
                    <tr class="bg-surface-container-low text-secondary font-label-sm text-label-sm uppercase tracking-wider">
                        <th class="py-space-sm px-space-lg w-28">No. Antrean</th>
                        <th class="py-space-sm px-space-md">Pasien &amp; No. Rekam Medis</th>
                        <th class="py-space-sm px-space-md">Dokter DPJP / Poli</th>
                        <th class="py-space-sm px-space-md">Status Kunjungan</th>
                        <th class="py-space-sm px-space-lg text-right">Aksi Terpadu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-low font-body-sm text-body-sm">
                    <?php if($total_antrean > 0): ?>
                        <?php foreach($antrean as $idx => $kunj): 
                            $no_antrean_num = str_pad($total_antrean - $idx, 3, "0", STR_PAD_LEFT);
                            $birthDate = new DateTime($kunj['tgl_lahir']);
                            $todayDate = new DateTime('today');
                            $age = $birthDate->diff($todayDate)->y;
                            
                            $initials = '';
                            $name_parts = explode(' ', $kunj['nama_pasien']);
                            if(count($name_parts)>0) $initials .= substr($name_parts[0], 0, 1);
                            if(count($name_parts)>1) $initials .= substr($name_parts[1], 0, 1);
                        ?>
                        <tr class="hover:bg-surface-container-low/60 transition-colors group queue-row">
                            <td class="py-space-md px-space-lg">
                                <div class="flex flex-col">
                                    <span class="font-headline-sm text-headline-sm font-bold text-on-surface tracking-tight">RM-<?= $no_antrean_num ?></span>
                                    <span class="font-label-sm text-label-sm text-outline">Loket 01</span>
                                </div>
                            </td>
                            <td class="py-space-md px-space-md">
                                <div class="flex items-center gap-space-md">
                                    <div class="w-9 h-9 rounded-full bg-surface-container text-on-secondary-container flex items-center justify-center font-bold text-label-md uppercase">
                                        <?= htmlspecialchars($initials) ?>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-body-md text-body-md font-semibold text-on-surface uppercase"><?= htmlspecialchars($kunj['nama_pasien']) ?></span>
                                        <span class="font-label-sm text-label-sm text-on-surface-variant">RM: <?= htmlspecialchars($kunj['no_rm']) ?> • <?= $age ?> Th</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-space-md px-space-md">
                                <div class="flex flex-col">
                                    <span class="font-body-md text-body-md text-on-surface font-medium"><?= htmlspecialchars($kunj['nama_dokter'] ?: 'Dokter Tidak Ditemukan') ?></span>
                                    <span class="font-label-sm text-label-sm text-outline">Klinik Rehabilitasi</span>
                                </div>
                            </td>
                            <td class="py-space-md px-space-md">
                                <span class="inline-flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-secondary-container text-on-secondary-fixed font-label-sm text-label-sm font-semibold">
                                    <span class="w-2 h-2 rounded-full bg-secondary"></span>
                                    <span>Menunggu Dokter</span>
                                </span>
                            </td>
                            <td class="py-space-md px-space-lg text-right">
                                <div class="flex items-center justify-end gap-space-xs">
                                    <button class="p-space-xs rounded-lg hover:bg-surface-container text-primary transition-colors" title="Panggil Antrean" type="button">
                                        <span class="material-symbols-outlined text-[20px]">campaign</span>
                                    </button>
                                    <button class="p-space-xs rounded-lg hover:bg-surface-container text-on-surface-variant transition-colors" title="Cetak Barcode" type="button">
                                        <span class="material-symbols-outlined text-[20px]">print</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-8 text-on-surface-variant italic">Belum ada antrean terdaftar hari ini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
function filterQueueList() {
    var query = document.getElementById('queue-search').value.toLowerCase();
    var rows = document.querySelectorAll('.queue-row');
    rows.forEach(function(row) {
        var text = row.innerText.toLowerCase();
        if (text.indexOf(query) > -1) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
</script>
