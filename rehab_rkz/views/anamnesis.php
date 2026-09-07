<?php
// c:\Users\louis\Documents\rehab\rehab_rkz\views\anamnesis.php
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'dokter') {
    header("Location: index.php?page=login");
    exit;
}

if (!isset($_GET['kunjungan_id'])) {
    echo "<div class='p-6 text-center text-red-600 font-bold'>ID Kunjungan tidak ditemukan.</div>";
    exit;
}

$kunjungan_id = $_GET['kunjungan_id'];

// Ambil data kunjungan dan pasien
$stmt = $pdo->prepare("SELECT k.*, p.nama, p.no_rm, p.tgl_lahir, p.no_telp 
                       FROM kunjungan k 
                       JOIN pasien p ON k.no_rm = p.no_rm 
                       WHERE k.id = ?");
$stmt->execute(array($kunjungan_id));
$data = $stmt->fetch();

if (!$data) {
    echo "<div class='p-6 text-center text-red-600 font-bold'>Data kunjungan tidak valid.</div>";
    exit;
}

// Cek spesialisasi dokter yang sedang login
$stmt_sp = $pdo->prepare("SELECT * FROM hrd.datadasar WHERE NIP = ?");
$stmt_sp->execute(array($_SESSION['user_id']));
$dokter_info = $stmt_sp->fetch();

$spesialisasi = isset($dokter_info['spesialisasi']) ? $dokter_info['spesialisasi'] : 'KFR'; 

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $diagnosa = isset($_POST['diagnosa_medis']) ? $_POST['diagnosa_medis'] : '';
        $terapi = isset($_POST['rencana_terapi']) ? $_POST['rencana_terapi'] : '';
        $pin_data = isset($_POST['body_mapping_data']) ? $_POST['body_mapping_data'] : '[]';
        
        $stmt_ins = $pdo->prepare("INSERT INTO rekam_medis (kunjungan_id, no_rm, diagnosa, terapi, body_map_data) VALUES (?, ?, ?, ?, ?)");
        $stmt_ins->execute(array($kunjungan_id, $data['no_rm'], $diagnosa, $terapi, $pin_data));
        $success = "Data pemeriksaan berhasil disimpan!";
    } catch(Exception $e) {
        $error = "Gagal menyimpan: " . $e->getMessage();
    }
}
?>

<?php if(isset($success)): ?>
<div class="mb-6 p-4 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center gap-3">
    <span class="material-symbols-outlined text-[20px]">check_circle</span>
    <span class="font-medium text-sm"><?= htmlspecialchars($success) ?></span>
</div>
<?php endif; ?>
<?php if(isset($error)): ?>
<div class="mb-6 p-4 rounded-xl bg-red-50 text-red-700 border border-red-200 flex items-center gap-3">
    <span class="material-symbols-outlined text-[20px]">error</span>
    <span class="font-medium text-sm"><?= htmlspecialchars($error) ?></span>
</div>
<?php endif; ?>

<!-- UI Form Anamnesis & Asesmen -->
<form method="POST" action="" class="w-full flex flex-col gap-space-xl">
  
  <div class="relative w-full rounded-xl bg-surface-container-lowest shadow-sm p-space-xl overflow-hidden">
    <div class="absolute -right-16 -bottom-16 w-80 h-80 bg-primary-container/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="relative z-10 flex flex-col md:flex-row justify-between gap-space-lg">
      <div class="flex flex-col gap-space-sm">
        <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Asesmen Awal & Formulir RMF-09</h2>
        <div class="flex items-center gap-space-sm flex-wrap">
          <span class="font-headline-sm text-headline-sm text-primary tracking-tight font-bold">
            RM-<?= htmlspecialchars($data['no_rm']) ?>
          </span>
          <span class="text-on-surface-variant font-body-sm">•</span>
          <span class="font-body-md text-on-surface font-semibold"><?= htmlspecialchars($data['nama']) ?></span>
        </div>
      </div>
      <div class="flex items-center gap-space-sm">
        <button type="submit" class="inline-flex items-center gap-space-xs px-space-lg py-2.5 bg-primary text-on-primary font-headline-sm text-headline-sm rounded-xl shadow-sm hover:bg-primary-container transition-all">
          <span class="material-symbols-outlined text-[18px]">save</span>
          <span>Simpan Pemeriksaan</span>
        </button>
      </div>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-start">
    
    <!-- LEFT: Subjective & Objective Form -->
    <div class="lg:col-span-8 flex flex-col gap-space-xl">
      <div class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-outline-variant/30 flex flex-col gap-space-md">
        <h3 class="font-headline-sm text-headline-sm text-on-surface border-b border-surface-container pb-space-sm">Data Anamnesis (S & O)</h3>
        
        <div class="flex flex-col gap-space-xs">
          <label class="font-label-md text-label-md text-on-surface">Keluhan Utama & Riwayat Penyakit</label>
          <textarea name="keluhan_utama" rows="3" class="w-full p-space-md bg-surface-container-low rounded-xl font-body-md text-body-md border border-transparent focus:border-primary focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary/20 transition-all outline-none" placeholder="Masukkan keluhan yang dialami pasien secara rinci..."></textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-space-md">
            <div class="flex flex-col gap-space-xs">
              <label class="font-label-md text-label-md text-on-surface">Tekanan Darah</label>
              <input type="text" name="tensi" class="w-full px-space-md py-2.5 bg-surface-container-low rounded-xl font-body-md text-body-md border border-transparent focus:border-primary focus:bg-surface-container-lowest outline-none" placeholder="contoh: 120/80">
            </div>
            <div class="flex flex-col gap-space-xs">
              <label class="font-label-md text-label-md text-on-surface">Nadi (bpm)</label>
              <input type="number" name="nadi" class="w-full px-space-md py-2.5 bg-surface-container-low rounded-xl font-body-md text-body-md border border-transparent focus:border-primary focus:bg-surface-container-lowest outline-none" placeholder="contoh: 80">
            </div>
            <div class="flex flex-col gap-space-xs">
              <label class="font-label-md text-label-md text-on-surface">Skala Nyeri (VAS)</label>
              <select name="vas" class="w-full px-space-md py-2.5 bg-surface-container-low rounded-xl font-body-md text-body-md border border-transparent focus:border-primary focus:bg-surface-container-lowest outline-none">
                  <option value="0">0 - Tidak Nyeri</option>
                  <option value="1">1 - Sangat Ringan</option>
                  <option value="2">2 - Ringan</option>
                  <option value="3">3 - Sedang Ringan</option>
                  <option value="4">4 - Sedang</option>
                  <option value="5">5 - Cukup Mengganggu</option>
                  <option value="6">6 - Mengganggu Aktivitas</option>
                  <option value="7">7 - Berat</option>
                  <option value="8">8 - Sangat Berat</option>
                  <option value="9">9 - Hebat</option>
                  <option value="10">10 - Ekstrem</option>
              </select>
            </div>
        </div>
      </div>

      <div class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm border border-outline-variant/30 flex flex-col gap-space-md">
        <h3 class="font-headline-sm text-headline-sm text-on-surface border-b border-surface-container pb-space-sm">Diagnosis & Terapi (A & P)</h3>
        
        <div class="flex flex-col gap-space-xs">
          <label class="font-label-md text-label-md text-on-surface">Diagnosis Klinis (ICD-10)</label>
          <textarea name="diagnosa_medis" rows="3" required class="w-full p-space-md bg-surface-container-low rounded-xl font-body-md text-body-md border border-transparent focus:border-primary focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary/20 transition-all outline-none" placeholder="Masukkan diagnosis medis / fungsional..."></textarea>
        </div>

        <div class="flex flex-col gap-space-xs">
          <label class="font-label-md text-label-md text-on-surface">Rencana Terapi / Fisioterapi</label>
          <textarea name="rencana_terapi" rows="4" required class="w-full p-space-md bg-surface-container-low rounded-xl font-body-md text-body-md border border-transparent focus:border-primary focus:bg-surface-container-lowest focus:ring-2 focus:ring-primary/20 transition-all outline-none" placeholder="Rencana program rehabilitasi medik..."></textarea>
        </div>
      </div>
    </div>

    <!-- RIGHT: Body Mapping -->
    <div class="lg:col-span-4 flex flex-col gap-space-xl">
      <div class="bg-surface-container-lowest rounded-xl shadow-sm p-space-lg flex flex-col gap-space-md sticky top-24">
        <h3 class="font-headline-sm text-headline-sm text-on-surface flex items-center justify-between border-b border-surface-container pb-space-sm">
          <span>Body Mapping Pain</span>
          <span class="material-symbols-outlined text-[20px] text-primary">accessibility_new</span>
        </h3>
        <p class="text-xs text-on-surface-variant font-body-sm">Klik area tubuh untuk menandai lokasi spesifik keluhan atau nyeri.</p>
        
        <div class="w-full aspect-[3/4] bg-surface-container-low rounded-xl overflow-hidden relative" id="body-map-container" style="cursor: crosshair;">
            <!-- Dummy Silhouette Image for Mapping -->
            <img src="<?= $base_url ?>/assets/img/body_silhouette.png" class="w-full h-full object-contain pointer-events-none opacity-50" onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/4/41/Human_body_silhouette.svg';">
            
            <input type="hidden" name="body_mapping_data" id="body_mapping_data" value="[]">
        </div>
        <button type="button" id="clear-pins" class="mt-2 w-full py-2 bg-surface-container text-on-surface font-label-md rounded-lg hover:bg-outline-variant transition-colors">
            Reset Pin
        </button>
      </div>
    </div>
    
  </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('body-map-container');
    const hiddenInput = document.getElementById('body_mapping_data');
    const clearBtn = document.getElementById('clear-pins');
    let pins = [];

    container.addEventListener('click', function(e) {
        if(e.target.classList.contains('pin-marker')) return;
        
        const rect = container.getBoundingClientRect();
        const x = ((e.clientX - rect.left) / rect.width) * 100;
        const y = ((e.clientY - rect.top) / rect.height) * 100;
        
        const pin = { x, y, id: Date.now() };
        pins.push(pin);
        renderPins();
    });

    clearBtn.addEventListener('click', function() {
        pins = [];
        renderPins();
    });

    function renderPins() {
        // Remove existing
        container.querySelectorAll('.pin-marker').forEach(el => el.remove());
        
        pins.forEach(pin => {
            const el = document.createElement('div');
            el.className = 'pin-marker absolute w-4 h-4 -ml-2 -mt-2 bg-error rounded-full ring-2 ring-white shadow-md cursor-pointer hover:scale-125 transition-transform z-10';
            el.style.left = pin.x + '%';
            el.style.top = pin.y + '%';
            
            el.addEventListener('click', function(e) {
                e.stopPropagation();
                pins = pins.filter(p => p.id !== pin.id);
                renderPins();
            });
            
            container.appendChild(el);
        });
        hiddenInput.value = JSON.stringify(pins);
    }
});
</script>
