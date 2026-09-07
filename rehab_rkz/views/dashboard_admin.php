<?php
// c:\Users\louis\Documents\rehab\rehab_rkz\views\dashboard_admin.php
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login");
    exit;
}
$today = date('Y-m-d');
$stmt_pasien = $pdo->query("SELECT COUNT(*) FROM pasien");
$total_pasien = $stmt_pasien->fetchColumn();

$stmt_kunj = $pdo->prepare("SELECT COUNT(*) FROM kunjungan WHERE tgl_kunjungan = ?");
$stmt_kunj->execute(array($today));
$kunjungan_hari_ini = $stmt_kunj->fetchColumn();
?>
<!-- Welcome Banner with Blue Gradient & Glassmorphism Details -->
<div class="relative rounded-2xl overflow-hidden bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-700 text-white shadow-xl shadow-blue-700/15 p-7 md:p-8">
    <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
    <div class="absolute right-40 -top-10 w-48 h-48 bg-blue-400/20 rounded-full blur-xl pointer-events-none"></div>
    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="max-w-2xl space-y-2">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium bg-white/15 backdrop-blur-md border border-white/20 text-blue-100">
                <i data-lucide="sparkles" class="w-3.5 h-3.5 text-amber-300"></i>
                <span>Sistem Pelayanan Terintegrasi RS RKZ Surabaya</span>
            </div>
            <h2 class="text-2xl md:text-3xl font-bold tracking-tight text-white font-heading">
                Selamat Datang, <?= htmlspecialchars($_SESSION['nama_lengkap']) ?>! 👋
            </h2>
            <p class="text-blue-100 text-sm md:text-base leading-relaxed">
                Klinik Spesialis Kedokteran Fisik dan Rehabilitasi (Sp.KFR) hari ini siap melayani pasien. Pastikan kelengkapan berkas dan alur registrasi rekam medik terverifikasi.
            </p>
        </div>
        <div class="flex flex-wrap sm:flex-nowrap gap-3">
            <a href="index.php?page=pasien" class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-white text-blue-700 font-semibold text-sm shadow-md hover:bg-blue-50 transition-all transform hover:-translate-y-0.5">
                <i data-lucide="user-plus" class="w-4 h-4 text-blue-700"></i>
                <span>Pasien Baru</span>
            </a>
            <a href="index.php?page=kunjungan" class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-blue-800/60 hover:bg-blue-800/90 text-white font-semibold text-sm border border-white/20 backdrop-blur-sm transition-all transform hover:-translate-y-0.5">
                <i data-lucide="clipboard-list" class="w-4 h-4"></i>
                <span>Daftar Kunjungan</span>
            </a>
        </div>
    </div>
</div>

<!-- Summary Stat Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
    <div class="bg-white rounded-xl p-5 border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Pasien</span>
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                <i data-lucide="folder-heart" class="w-5 h-5"></i>
            </div>
        </div>
        <div class="mt-4 flex items-baseline gap-2">
            <span class="text-3xl font-extrabold text-slate-800 font-heading"><?= $total_pasien ?></span>
        </div>
        <p class="mt-1 text-xs text-slate-400">Master database pasien</p>
    </div>
    
    <div class="bg-white rounded-xl p-5 border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Kunjungan Hari Ini</span>
            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                <i data-lucide="calendar-check" class="w-5 h-5"></i>
            </div>
        </div>
        <div class="mt-4 flex items-baseline gap-2">
            <span class="text-3xl font-extrabold text-slate-800 font-heading"><?= $kunjungan_hari_ini ?></span>
        </div>
        <p class="mt-1 text-xs text-slate-400">Total antrean terdaftar</p>
    </div>
    
    <div class="bg-white rounded-xl p-5 border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Antrean Poli</span>
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                <i data-lucide="hourglass" class="w-5 h-5"></i>
            </div>
        </div>
        <div class="mt-4 flex items-baseline gap-2">
            <span class="text-3xl font-extrabold text-slate-800 font-heading">0</span>
            <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full border border-amber-200/60">Menunggu</span>
        </div>
        <p class="mt-1 text-xs text-slate-400">Belum dipanggil dokter</p>
    </div>
    
    <div class="bg-white rounded-xl p-5 border border-slate-200/80 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Selesai</span>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <i data-lucide="check-circle-2" class="w-5 h-5"></i>
            </div>
        </div>
        <div class="mt-4 flex items-baseline gap-2">
            <span class="text-3xl font-extrabold text-slate-800 font-heading">0</span>
        </div>
        <p class="mt-1 text-xs text-slate-400">RMF-09 terisi</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-200/80">
            <h3 class="font-bold text-slate-800 font-heading text-base">Antrean Kunjungan Pasien</h3>
            <p class="text-xs text-slate-400">Daftar kunjungan yang didaftarkan</p>
        </div>
        <div class="p-8 text-center text-slate-400">
            <i data-lucide="clipboard-list" class="w-12 h-12 mx-auto mb-3 opacity-50"></i>
            <p>Silakan menuju halaman <a href="index.php?page=kunjungan" class="text-blue-600 font-bold hover:underline">Registrasi Kunjungan</a> untuk mengelola antrean.</p>
        </div>
    </div>
    
    <div class="space-y-6">
        <div class="bg-white rounded-xl border border-slate-200/80 shadow-sm p-5 space-y-4">
            <h3 class="font-bold text-slate-800 font-heading text-base flex items-center gap-2">
                <i data-lucide="zap" class="w-4 h-4 text-amber-500"></i>
                Aksi Cepat Registrasi
            </h3>
            <div class="space-y-2.5">
                <a href="index.php?page=pasien" class="w-full flex items-center justify-between p-3 rounded-xl bg-slate-50 hover:bg-blue-50/80 border border-slate-200/70 hover:border-blue-200 text-slate-700 hover:text-blue-700 transition-all group">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-100/70 text-blue-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <i data-lucide="user-plus" class="w-4 h-4"></i>
                        </div>
                        <div class="text-left">
                            <div class="text-xs font-bold text-slate-800">Registrasi Pasien Baru</div>
                            <div class="text-[11px] text-slate-400">Input rekam medis</div>
                        </div>
                    </div>
                    <i data-lucide="arrow-right" class="w-4 h-4 text-slate-400 group-hover:text-blue-600"></i>
                </a>
                
                <a href="index.php?page=kunjungan" class="w-full flex items-center justify-between p-3 rounded-xl bg-slate-50 hover:bg-emerald-50/80 border border-slate-200/70 hover:border-emerald-200 text-slate-700 hover:text-emerald-700 transition-all group">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100/70 text-emerald-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <i data-lucide="calendar-plus" class="w-4 h-4"></i>
                        </div>
                        <div class="text-left">
                            <div class="text-xs font-bold text-slate-800">Kunjungan Pasien Lama</div>
                            <div class="text-[11px] text-slate-400">Pilih poli & dokter</div>
                        </div>
                    </div>
                    <i data-lucide="arrow-right" class="w-4 h-4 text-slate-400 group-hover:text-emerald-600"></i>
                </a>
            </div>
        </div>
    </div>
</div>
