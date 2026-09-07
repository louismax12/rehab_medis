# Sistem Informasi Pelayanan Rehabilitasi Medik (RS RKZ)

Selamat datang di repositori **Sistem Informasi Pelayanan Rehabilitasi Medik** terpadu. Sistem ini dirancang untuk memfasilitasi operasional administratif dan klinis pada unit Rehabilitasi Medik, dengan fokus pada pengalaman pengguna (UI/UX) modern dan efisiensi alur kerja tenaga kesehatan.

## 🚀 Fitur Utama

- **Sistem Autentikasi Role-Based (RBAC):** Akses yang dibedakan antara **Admin (Loket/Admisi)** dan **Dokter Spesialis/Terapis**.
- **Dashboard Admin:** Pemantauan statistik, akses cepat ke fungsi utama registrasi, serta rekap kunjungan secara *real-time*.
- **Dashboard Dokter (Antrean):** Layar khusus untuk tenaga medis guna melihat urutan antrean pasien yang telah diregistrasikan di loket.
- **Master Pasien:** Pengelolaan data demografis rekam medis pasien terpadu.
- **Registrasi Kunjungan (Admisi):** Pencatatan kedatangan pasien, pengaturan kuota antrean poli, dan penugasan DPJP (Dokter Penanggung Jawab).
- **Rekam Medis Khusus (Anamnesis & Asesmen):** 
  - Catatan Medis Terstruktur (Keluhan, S & O, A & P)
  - Formulir RMF-09 terintegrasi
  - Fitur Visual *Body Mapping Pain* (menandai titik nyeri pasien secara langsung)
- **Laporan & Statistik:** Analisis dan grafik kunjungan harian, distribusi penjamin pasien, serta performa layanan klinik.

## 💻 Arsitektur & Teknologi

Proyek ini dibangun secara *native* (tanpa framework *backend* berat) menggunakan arsitektur **MVC Modular** untuk mempertahankan kecepatan dan kemudahan *maintenance*:

- **Backend:** PHP Native (PDO)
- **Database:** MySQL / MariaDB (Multi-database support)
- **Frontend / UI:** 
  - HTML5 & CSS3
  - **Tailwind CSS** (via CDN untuk utilitas gaya modern berbasis *Bento-Grid*)
  - **Google Fonts** (Inter & Outfit) untuk tipografi klinis
  - **Material Symbols (Lucide / Google Icons)** untuk *iconography*

### Struktur Direktori

```text
rehab_rkz/
├── assets/                  # CSS kustom, JavaScript pendukung, dan Gambar/Logo
├── config/                  
│   └── database.php         # Pengaturan multi-koneksi DB (rehab, askes, hrd)
├── includes/                
│   ├── auth.php             # Validasi Sesi & Hak Akses (Role)
│   ├── header.php           # Global Head, Sidebar Navigasi, & Topbar
│   └── footer.php           # Penutup Layout & Script Inisialisasi
├── views/                   
│   ├── login.php            # Halaman Autentikasi
│   ├── dashboard_admin.php  # Dashboard Utama (Admin)
│   ├── dashboard_dokter.php # Dashboard Antrean (Medis)
│   ├── pasien.php           # Modul Master Pasien
│   ├── kunjungan.php        # Modul Admisi/Loket
│   ├── anamnesis.php        # Modul Rekam Medis & Body Mapping
│   └── laporan.php          # Modul Rekapitulasi Data
├── index.php                # Front Controller (Menyatukan Request)
├── setup_db.php             # Script Migrasi Database Otomatis
└── schema.sql               # Skema Tabel SQL (pasien, kunjungan, rekam_medis)
```

## ⚙️ Persiapan & Instalasi

1. **Clone Repositori**
   ```bash
   git clone https://github.com/louismax12/rehab_medis.git
   cd rehab_medis
   ```
2. **Setup Server**
   - Pastikan Anda menggunakan server lokal seperti XAMPP/Laragon.
   - Pindahkan folder `rehab_rkz` ke dalam folder `htdocs` atau `www`.
3. **Setup Database**
   - Buka `config/database.php` dan sesuaikan *Username* serta *Password* database MySQL Anda.
   - Buka URL `http://localhost/rehab_rkz/setup_db.php` melalui browser Anda satu kali saja untuk membuat database dan tabel yang dibutuhkan secara otomatis.
4. **Jalankan Aplikasi**
   - Akses aplikasi pada URL: `http://localhost/rehab_rkz/`
   - Gunakan NIP/Username dan Password yang terdaftar di tabel `hrd.datadasar` untuk login.

---
*Developed & Designed with ❤️ for RS RKZ*
