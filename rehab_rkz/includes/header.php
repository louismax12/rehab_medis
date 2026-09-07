<?php
$base_url = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$base_url = rtrim($base_url, '/');
if ($base_url === '/' || $base_url === '') $base_url = '';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$page_title = 'Rehab Medik';
if($page == 'dashboard') $page_title = 'Dashboard Admin';
if($page == 'dashboard_dokter') $page_title = 'Antrean Dokter';
if($page == 'pasien') $page_title = 'Master Pasien';
if($page == 'kunjungan') $page_title = 'Registrasi Kunjungan';
if($page == 'anamnesis') $page_title = 'Form Pemeriksaan';
if($page == 'laporan') $page_title = 'Laporan & Statistik';

$user_nama = isset($_SESSION['nama_lengkap']) ? $_SESSION['nama_lengkap'] : 'Tamu';
$user_role = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest';
$name_parts = explode(' ', $user_nama);
$initials = '';
if (count($name_parts) > 0) { $initials .= strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $name_parts[0]), 0, 1)); }
if (count($name_parts) > 1) { $initials .= strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $name_parts[1]), 0, 1)); }
if ($initials === '') $initials = 'U';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= $page_title ?> - Sistem Rehabilitasi Medik RS RKZ</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">
    <script>
        tailwind.config = { darkMode: "class", theme: { extend: { "colors": { "tertiary": "#006242", "on-secondary-fixed": "#131b2e", "on-tertiary-fixed-variant": "#005236", "inverse-surface": "#213145", "on-secondary-container": "#5c647a", "secondary-container": "#dae2fd", "tertiary-fixed": "#6ffbbe", "surface-container-high": "#dce9ff", "primary": "#004ac6", "tertiary-container": "#007d55", "surface-container-lowest": "#ffffff", "on-background": "#0b1c30", "on-secondary-fixed-variant": "#3f465c", "error": "#ba1a1a", "on-primary": "#ffffff", "error-container": "#ffdad6", "on-primary-fixed": "#00174b", "outline": "#737686", "on-secondary": "#ffffff", "on-surface-variant": "#434655", "surface-variant": "#d3e4fe", "surface-container": "#e5eeff", "on-tertiary": "#ffffff", "surface-container-highest": "#d3e4fe", "primary-fixed": "#dbe1ff", "surface-container-low": "#eff4ff", "surface-bright": "#f8f9ff", "on-tertiary-fixed": "#002113", "secondary": "#565e74", "on-primary-fixed-variant": "#003ea8", "surface-dim": "#cbdbf5", "on-surface": "#0b1c30", "secondary-fixed": "#dae2fd", "on-primary-container": "#eeefff", "inverse-on-surface": "#eaf1ff", "primary-fixed-dim": "#b4c5ff", "surface-tint": "#0053db", "tertiary-fixed-dim": "#4edea3", "outline-variant": "#c3c6d7", "primary-container": "#2563eb", "secondary-fixed-dim": "#bec6e0", "inverse-primary": "#b4c5ff", "on-error-container": "#93000a", "surface": "#f8f9ff", "on-tertiary-container": "#bdffdb", "on-error": "#ffffff", "background": "#f8f9ff",
        brand: { 50: '#eff6ff', 100: '#dbeafe', 500: '#3b82f6', 600: '#2563eb', 700: '#1d4ed8', 800: '#1e40af', 900: '#1e3a8a'}
        }, "borderRadius": { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" }, "spacing": { "sidebar-width": "16.5rem", "space-md": "0.75rem", "space-2xs": "0.125rem", "gutter-table": "1rem", "sidebar-collapsed": "4.5rem", "space-xs": "0.25rem", "space-base": "1rem", "space-2xl": "2rem", "space-xl": "1.5rem", "space-sm": "0.5rem", "space-3xl": "3rem", "space-lg": "1.25rem" }, "fontFamily": { "display-lg": ["Outfit"], "headline-lg": ["Outfit"], "body-sm": ["Inter"], "metric-display": ["Outfit"], "body-md": ["Inter"], "label-sm": ["Inter"], "body-lg": ["Inter"], "headline-md": ["Outfit"], "label-md": ["Inter"], "headline-sm": ["Outfit"], "display-sm": ["Outfit"], sans: ['"Plus Jakarta Sans"', 'Outfit', 'sans-serif'], heading: ['Outfit', 'sans-serif'] }, "fontSize": { "display-lg": ["40px", { "lineHeight": "48px", "letterSpacing": "-0.02em", "fontWeight": "600" }], "headline-lg": ["24px", { "lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "600" }], "body-sm": ["12px", { "lineHeight": "16px", "fontWeight": "400" }], "metric-display": ["32px", { "lineHeight": "36px", "letterSpacing": "-0.02em", "fontWeight": "700" }], "body-md": ["14px", { "lineHeight": "20px", "fontWeight": "400" }], "label-sm": ["11px", { "lineHeight": "14px", "letterSpacing": "0.03em", "fontWeight": "600" }], "body-lg": ["16px", { "lineHeight": "24px", "fontWeight": "400" }], "headline-md": ["20px", { "lineHeight": "28px", "letterSpacing": "-0.005em", "fontWeight": "600" }], "label-md": ["13px", { "lineHeight": "18px", "letterSpacing": "0.01em", "fontWeight": "600" }], "headline-sm": ["16px", { "lineHeight": "24px", "fontWeight": "600" }], "display-sm": ["30px", { "lineHeight": "36px", "letterSpacing": "-0.015em", "fontWeight": "600" }] } } } };
    </script>
    <style>
        html, body { height: 100%; margin: 0; }
        html { zoom: 0.9; } /* Skala keseluruhan UI diturunkan 20% dari ukuran normal (naik 20% dari sebelumnya) */
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .custom-scroll::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scroll::-webkit-scrollbar-track { background: #f1f5f9; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .sidebar-transition { transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased h-full flex flex-col selection:bg-blue-600 selection:text-white">

<?php if(isset($_SESSION['user_id'])): ?>
    <div class="flex h-full overflow-hidden w-full">
        <!-- Collapsible Dark Sidebar -->
        <aside class="sidebar-transition w-72 bg-slate-900 text-slate-300 flex flex-col flex-shrink-0 z-30 shadow-2xl relative border-r border-slate-800" id="main-sidebar">
            <div class="h-20 flex items-center justify-between px-6 border-b border-slate-800/80 bg-slate-950/40">
                <div class="flex items-center space-x-3 overflow-hidden">
                    <div class="w-10 h-10 flex-shrink-0">
                        <img src="<?= $base_url ?>/assets/img/logo_rkz.png" alt="Logo RKZ" class="w-full h-full object-contain">
                    </div>
                    <div class="sidebar-text truncate">
                        <div class="font-bold text-base text-white tracking-wide flex items-center gap-1.5">
                            <span>REHAB MEDIK</span>
                            <span class="px-1.5 py-0.5 rounded text-[10px] bg-blue-500/20 text-blue-400 font-semibold border border-blue-500/30">RKZ</span>
                        </div>
                        <p class="text-xs text-slate-400 font-medium truncate">Klinik & Rehabilitasi</p>
                    </div>
                </div>
                <button class="text-slate-300 hover:text-white p-2 rounded-xl bg-slate-800/80 hover:bg-slate-700 border border-slate-700/80 transition-all focus:outline-none" id="toggle-sidebar">
                    <i class="w-5 h-5" data-lucide="panel-left-close" id="toggle-icon"></i>
                </button>
            </div>
            
            <div class="px-5 py-3.5 bg-slate-800/40 border-b border-slate-800/60 sidebar-text">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-semibold tracking-wider text-slate-400 uppercase">Peran Aktif</span>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-semibold <?= $user_role == 'admin' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-amber-500/10 text-amber-400 border border-amber-500/20' ?>">
                        <span class="w-1.5 h-1.5 rounded-full <?= $user_role == 'admin' ? 'bg-emerald-400' : 'bg-amber-400' ?> animate-pulse"></span>
                        <?= ucfirst($user_role) ?>
                    </span>
                </div>
            </div>
            
            <div class="flex-1 overflow-y-auto custom-scroll py-4 px-3 space-y-1.5">
                <div class="sidebar-text px-3 pb-1 text-[11px] font-bold text-slate-400 tracking-wider uppercase">Menu Utama</div>
                
                <?php if($user_role === 'admin'): ?>
                <a class="flex items-center gap-3 px-3.5 py-3 rounded-xl <?= ($page == 'dashboard') ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-md shadow-blue-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/70' ?> font-medium transition-all" href="index.php?page=dashboard">
                    <i class="w-5 h-5 flex-shrink-0 <?= ($page == 'dashboard') ? 'text-white' : 'text-slate-400' ?>" data-lucide="layout-dashboard"></i>
                    <span class="sidebar-text text-sm">Dashboard Admin</span>
                </a>
                <a class="flex items-center gap-3 px-3.5 py-3 rounded-xl <?= ($page == 'pasien') ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-md shadow-blue-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/70' ?> font-medium transition-all" href="index.php?page=pasien">
                    <i class="w-5 h-5 flex-shrink-0 <?= ($page == 'pasien') ? 'text-white' : 'text-slate-400' ?>" data-lucide="users"></i>
                    <span class="sidebar-text text-sm">Master Pasien</span>
                </a>
                <a class="flex items-center gap-3 px-3.5 py-3 rounded-xl <?= ($page == 'kunjungan') ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-md shadow-blue-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/70' ?> font-medium transition-all" href="index.php?page=kunjungan">
                    <i class="w-5 h-5 flex-shrink-0 <?= ($page == 'kunjungan') ? 'text-white' : 'text-slate-400' ?>" data-lucide="clipboard-pen-line"></i>
                    <span class="sidebar-text text-sm">Registrasi Kunjungan</span>
                </a>
                <?php endif; ?>

                <?php if($user_role === 'dokter'): ?>
                <a class="flex items-center gap-3 px-3.5 py-3 rounded-xl <?= ($page == 'dashboard') ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-md shadow-blue-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/70' ?> font-medium transition-all" href="index.php?page=dashboard">
                    <i class="w-5 h-5 flex-shrink-0 <?= ($page == 'dashboard') ? 'text-white' : 'text-slate-400' ?>" data-lucide="stethoscope"></i>
                    <span class="sidebar-text text-sm">Antrean Pemeriksaan</span>
                </a>
                <?php endif; ?>
                
                <a class="flex items-center gap-3 px-3.5 py-3 rounded-xl <?= ($page == 'laporan') ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-md shadow-blue-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/70' ?> font-medium transition-all" href="index.php?page=laporan">
                    <i class="w-5 h-5 flex-shrink-0 <?= ($page == 'laporan') ? 'text-white' : 'text-slate-400' ?>" data-lucide="bar-chart-3"></i>
                    <span class="sidebar-text text-sm">Laporan & Statistik</span>
                </a>

                <div class="sidebar-text pt-4 px-3 pb-1 text-[11px] font-bold text-slate-400 tracking-wider uppercase">Pengaturan</div>
                <a class="flex items-center gap-3 px-3.5 py-3 rounded-xl text-red-400 hover:text-white hover:bg-red-500/20 font-medium transition-all" href="index.php?page=logout">
                    <i class="w-5 h-5 flex-shrink-0" data-lucide="log-out"></i>
                    <span class="sidebar-text text-sm">Keluar Sistem</span>
                </a>
            </div>
            
            <div class="p-4 border-t border-slate-800/80 bg-slate-950/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-slate-700 ring-2 ring-blue-500/30 flex items-center justify-center text-white font-semibold text-sm flex-shrink-0">
                        <?= $initials ?>
                    </div>
                    <div class="sidebar-text min-w-0 flex-1">
                        <p class="text-sm font-semibold text-white truncate"><?= htmlspecialchars($user_nama) ?></p>
                        <p class="text-xs text-slate-400 truncate"><?= htmlspecialchars(ucfirst($user_role)) ?></p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden bg-slate-50/80">
            <!-- Top Navbar -->
            <header class="h-20 bg-white/95 backdrop-blur-md border-b border-slate-200/80 flex items-center justify-between px-8 z-20 shadow-[0_2px_8px_-3px_rgba(0,0,0,0.04)]">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <span class="hidden md:flex px-3 py-1 rounded-lg text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100 items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-blue-600"></span> Instalasi Rehabilitasi Medik
                        </span>
                        <span class="text-slate-300 hidden md:inline">/</span>
                        <h1 class="text-lg font-bold text-slate-800 tracking-tight font-heading"><?= $page_title ?></h1>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative hidden lg:block w-72">
                        <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                        <input class="w-full pl-10 pr-4 py-2 text-xs bg-slate-100/90 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600/30 transition-all" placeholder="Pencarian cepat..." type="text">
                    </div>
                    <div class="h-8 w-px bg-slate-200 hidden sm:block"></div>
                    <div class="hidden sm:flex flex-col text-right">
                        <span class="text-xs font-bold text-slate-700"><?= date('l, d M Y') ?></span>
                        <span class="text-[11px] text-slate-400 font-mono"><?= date('H:i') ?> WIB</span>
                    </div>
                </div>
            </header>
            
            <main class="flex-1 overflow-y-auto custom-scroll p-4 md:p-6 lg:p-8 space-y-6">
<?php else: ?>
    <!-- Mode Login Container -->
    <div class="w-full min-h-screen bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center p-4">
<?php endif; ?>
