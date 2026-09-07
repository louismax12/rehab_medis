<?php
// c:\Users\louis\Documents\rehab\rehab_rkz\views\pasien.php
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php?page=login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("INSERT INTO pasien (no_rm, nama, tgl_lahir, alamat, no_telp) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(array($_POST['no_rm'], $_POST['nama'], $_POST['tgl_lahir'], $_POST['alamat'], $_POST['no_telp']));
        $success = "Data pasien berhasil ditambahkan.";
    } catch(Exception $e) {
        $error = "Gagal menyimpan data: " . $e->getMessage();
    }
}
?>

<div class="flex flex-col gap-space-sm mb-space-lg">
    <div class="flex items-center gap-space-xs text-on-surface-variant font-label-sm uppercase tracking-wider">
        <span class="hover:text-primary transition-colors cursor-pointer">Instalasi Rehabilitasi Medik</span>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <span class="hover:text-primary transition-colors cursor-pointer">Master Data</span>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <span class="text-primary font-semibold">Direktori Pasien</span>
    </div>
    <div class="flex flex-col xl:flex-row xl:items-center justify-between gap-space-md">
        <div class="flex flex-col">
            <div class="flex items-center gap-space-md flex-wrap">
                <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Master Data Pasien</h1>
            </div>
            <p class="font-body-md text-on-surface-variant mt-space-2xs">
                Basis data demografis dan riwayat pasien rehabilitasi medik terpadu RKZ.
            </p>
        </div>
        <div class="flex items-center gap-space-sm flex-wrap">
            <button onclick="document.getElementById('form-pasien').classList.toggle('hidden')" class="inline-flex items-center gap-space-xs h-10 px-space-lg rounded-xl bg-primary text-on-primary font-label-md shadow-sm hover:bg-primary-container transition-all">
                <span class="material-symbols-outlined text-[20px]">person_add</span>
                <span>Registrasi Pasien Baru</span>
            </button>
        </div>
    </div>
</div>

<?php if(isset($success)): ?>
    <div class="bg-emerald-50 text-emerald-700 px-space-md py-space-sm rounded-xl text-sm mb-space-xl flex items-center gap-2 border border-emerald-200 shadow-sm font-semibold">
        <span class="material-symbols-outlined text-[20px]">check_circle</span>
        <span><?= htmlspecialchars($success) ?></span>
    </div>
<?php endif; ?>
<?php if(isset($error)): ?>
    <div class="bg-error-container text-on-error-container px-space-md py-space-sm rounded-xl text-sm mb-space-xl flex items-center gap-2 shadow-sm font-semibold">
        <span class="material-symbols-outlined text-[20px]">error</span>
        <span><?= htmlspecialchars($error) ?></span>
    </div>
<?php endif; ?>

<!-- Form Registrasi -->
<div id="form-pasien" class="hidden bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden mb-space-2xl transition-all">
    <div class="px-space-xl py-space-md border-b border-surface-container flex items-center gap-space-md bg-surface-container-low/50">
        <div class="w-10 h-10 rounded-lg bg-primary-container text-on-primary-container flex items-center justify-center">
            <span class="material-symbols-outlined text-[20px]">group_add</span>
        </div>
        <div>
            <h3 class="font-headline-sm text-headline-sm text-on-surface">Formulir Registrasi Pasien Baru</h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant">Pastikan data sesuai identitas KTP/KK.</p>
        </div>
    </div>
    
    <form action="index.php?page=pasien" method="POST" class="p-space-xl flex flex-col gap-space-xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-space-xl">
            <div class="flex flex-col gap-space-xs">
                <label class="font-label-md text-label-md text-on-surface">No Rekam Medis <span class="text-error">*</span></label>
                <input type="text" name="no_rm" class="w-full px-space-md py-2.5 bg-surface-container-low rounded-xl font-body-md text-body-md border border-transparent focus:border-primary focus:bg-surface-container-lowest outline-none" required placeholder="Cth: 141306">
            </div>
            
            <div class="flex flex-col gap-space-xs lg:col-span-2">
                <label class="font-label-md text-label-md text-on-surface">Nama Lengkap Pasien <span class="text-error">*</span></label>
                <input type="text" name="nama" class="w-full px-space-md py-2.5 bg-surface-container-low rounded-xl font-body-md text-body-md border border-transparent focus:border-primary focus:bg-surface-container-lowest outline-none" required placeholder="Sesuai KTP/Identitas resmi">
            </div>
            
            <div class="flex flex-col gap-space-xs">
                <label class="font-label-md text-label-md text-on-surface">Tanggal Lahir <span class="text-error">*</span></label>
                <input type="date" name="tgl_lahir" class="w-full px-space-md py-2.5 bg-surface-container-low rounded-xl font-body-md text-body-md border border-transparent focus:border-primary focus:bg-surface-container-lowest outline-none" required>
            </div>
            
            <div class="flex flex-col gap-space-xs">
                <label class="font-label-md text-label-md text-on-surface">No. HP / WhatsApp <span class="text-error">*</span></label>
                <input type="tel" name="no_telp" class="w-full px-space-md py-2.5 bg-surface-container-low rounded-xl font-body-md text-body-md border border-transparent focus:border-primary focus:bg-surface-container-lowest outline-none" required placeholder="0812-XXXX-XXXX">
            </div>
            
            <div class="flex flex-col gap-space-xs lg:col-span-3">
                <label class="font-label-md text-label-md text-on-surface">Alamat Domisili <span class="text-error">*</span></label>
                <textarea name="alamat" rows="2" class="w-full p-space-md bg-surface-container-low rounded-xl font-body-md text-body-md border border-transparent focus:border-primary focus:bg-surface-container-lowest outline-none" required placeholder="Alamat lengkap tempat tinggal sekarang"></textarea>
            </div>
        </div>
        
        <div class="flex items-center justify-end gap-space-sm pt-space-md border-t border-surface-container">
            <button type="button" onclick="document.getElementById('form-pasien').classList.add('hidden')" class="px-space-md py-2.5 text-sm font-semibold text-secondary hover:bg-surface-container rounded-xl transition-colors">
                Batal
            </button>
            <button type="submit" class="inline-flex items-center gap-space-xs px-space-lg py-2.5 bg-primary text-on-primary font-label-md rounded-xl shadow-sm hover:bg-primary-container transition-all">
                <span class="material-symbols-outlined text-[18px]">save</span>
                <span>Simpan Pasien</span>
            </button>
        </div>
    </form>
</div>

<!-- Data Table Section -->
<div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden">
    <div class="p-space-lg border-b border-surface-container flex flex-col sm:flex-row sm:items-center justify-between gap-space-md bg-surface-container-low/50">
        <h3 class="font-headline-sm text-headline-sm font-bold text-on-surface">Daftar Pasien Terdaftar</h3>
        <div class="relative w-full max-w-sm">
            <span class="material-symbols-outlined absolute left-space-md top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
            <input type="text" class="w-full h-10 pl-11 pr-space-md bg-surface-container-lowest border border-outline-variant/50 rounded-xl font-body-sm text-body-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all" placeholder="Pencarian cepat...">
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="bg-surface-container-low/30 border-b border-surface-container text-on-surface-variant uppercase tracking-wider text-[11px] font-bold">
                    <th class="py-space-md px-space-lg whitespace-nowrap">No. RM</th>
                    <th class="py-space-md px-space-lg whitespace-nowrap">Nama Pasien</th>
                    <th class="py-space-md px-space-lg whitespace-nowrap">Tgl Lahir / Usia</th>
                    <th class="py-space-md px-space-lg whitespace-nowrap">Kontak</th>
                    <th class="py-space-md px-space-lg whitespace-nowrap">Alamat</th>
                    <th class="py-space-md px-space-lg text-center whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container text-on-surface">
                <?php
                $stmt = $pdo->query("SELECT * FROM pasien ORDER BY no_rm DESC LIMIT 50");
                while ($row = $stmt->fetch()):
                    // Hitung umur
                    $birthDate = new DateTime($row['tgl_lahir']);
                    $today = new DateTime('today');
                    $age = $birthDate->diff($today)->y;
                ?>
                <tr class="hover:bg-surface-container-low/50 transition-colors group">
                    <td class="py-space-md px-space-lg">
                        <span class="inline-flex items-center px-2 py-1 rounded-md bg-primary/10 text-primary font-mono font-bold text-xs">
                            <?= htmlspecialchars($row['no_rm']) ?>
                        </span>
                    </td>
                    <td class="py-space-md px-space-lg font-semibold text-on-surface">
                        <?= htmlspecialchars($row['nama']) ?>
                    </td>
                    <td class="py-space-md px-space-lg text-on-surface-variant">
                        <?= date('d/m/Y', strtotime($row['tgl_lahir'])) ?> <br>
                        <span class="text-[11px] text-secondary"><?= $age ?> Tahun</span>
                    </td>
                    <td class="py-space-md px-space-lg text-on-surface-variant">
                        <?= htmlspecialchars($row['no_telp']) ?>
                    </td>
                    <td class="py-space-md px-space-lg text-on-surface-variant max-w-[200px] truncate" title="<?= htmlspecialchars($row['alamat']) ?>">
                        <?= htmlspecialchars($row['alamat']) ?>
                    </td>
                    <td class="py-space-md px-space-lg text-center">
                        <button class="w-8 h-8 rounded-lg text-secondary hover:bg-primary-container hover:text-primary transition-colors inline-flex items-center justify-center">
                            <span class="material-symbols-outlined text-[18px]">edit</span>
                        </button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
