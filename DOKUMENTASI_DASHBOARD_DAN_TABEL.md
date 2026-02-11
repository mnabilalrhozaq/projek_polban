# Dokumentasi Dashboard Settings & Tabel Database

## 📊 DASHBOARD SETTINGS

### Apa itu Dashboard Settings?

`dashboard_settings` adalah tabel yang digunakan untuk **mengkustomisasi tampilan dashboard** untuk setiap role (User dan TPS). Admin Pusat bisa mengatur widget mana yang ditampilkan, urutan widget, warna, dan konfigurasi lainnya.

### Fitur Dashboard Settings

1. **Customizable Widgets** - Admin bisa aktifkan/nonaktifkan widget tertentu
2. **Reorder Widgets** - Ubah urutan tampilan widget
3. **Custom Labels** - Ganti label/judul widget
4. **Custom Colors** - Ubah warna tema widget
5. **Widget Configuration** - Atur detail konfigurasi per widget (JSON)

---

## 🎨 WIDGET YANG BISA DI-SETTING

### 1. **stat_cards** (Kartu Statistik)
**Untuk:** User & TPS  
**Deskripsi:** Menampilkan statistik data dalam bentuk kartu (Draft, Dikirim, Disetujui, Ditolak)  
**Konfigurasi:**
- `show_approved` - Tampilkan kartu "Disetujui"
- `show_pending` - Tampilkan kartu "Pending"
- `show_revision` - Tampilkan kartu "Perlu Revisi"
- `show_draft` - Tampilkan kartu "Draft"

**Contoh:**
```json
{
  "show_approved": true,
  "show_pending": true,
  "show_revision": true,
  "show_draft": true
}
```

---

### 2. **waste_summary** (Ringkasan Waste)
**Untuk:** User & TPS  
**Deskripsi:** Ringkasan data waste management per jenis sampah  
**Konfigurasi:**
- `show_details` - Tampilkan detail per jenis
- `show_value_calculation` - Tampilkan perhitungan nilai rupiah

**Contoh:**
```json
{
  "show_details": true,
  "show_value_calculation": true
}
```

---

### 3. **recent_activity** (Aktivitas Terbaru)
**Untuk:** User & TPS  
**Deskripsi:** Daftar aktivitas terbaru pengguna  
**Konfigurasi:**
- `max_items` - Jumlah maksimal item yang ditampilkan (default: 5)

**Contoh:**
```json
{
  "max_items": 5
}
```

---

### 4. **quick_actions** (Aksi Cepat)
**Untuk:** User & TPS  
**Deskripsi:** Tombol aksi cepat untuk fitur utama  
**Konfigurasi:**
- `show_input_form` - Tampilkan tombol "Input Data"
- `show_export` - Tampilkan tombol "Export"
- `show_reports` - Tampilkan tombol "Laporan"

**Contoh:**
```json
{
  "show_input_form": true,
  "show_export": true,
  "show_reports": true
}
```

---

### 5. **price_info** (Informasi Harga)
**Untuk:** User  
**Deskripsi:** Informasi harga sampah terkini  
**Konfigurasi:**
- `show_current_prices` - Tampilkan harga saat ini
- `show_price_trends` - Tampilkan tren harga (belum aktif)

**Contoh:**
```json
{
  "show_current_prices": true,
  "show_price_trends": false
}
```

---

### 6. **tps_operations** (Operasional TPS)
**Untuk:** TPS  
**Deskripsi:** Informasi operasional khusus TPS  
**Konfigurasi:**
- `show_capacity` - Tampilkan kapasitas TPS
- `show_schedule` - Tampilkan jadwal operasional

**Contoh:**
```json
{
  "show_capacity": true,
  "show_schedule": true
}
```

---

## 🔧 CARA MENGATUR DASHBOARD

### Akses Pengaturan Dashboard
**URL:** `/admin-pusat/pengaturan-dashboard`  
**Role:** Admin Pusat / Super Admin

### Fitur yang Tersedia:
1. **Toggle Widget** - Aktifkan/nonaktifkan widget
2. **Reorder Widget** - Drag & drop untuk ubah urutan
3. **Edit Widget** - Ubah label, warna, dan konfigurasi
4. **Reset to Default** - Kembalikan ke pengaturan default

---

## 📋 TABEL DATABASE YANG TERPAKAI

Berikut adalah **SEMUA TABEL** yang digunakan di website ini:

### ✅ TABEL AKTIF (Digunakan oleh Web)

| No | Nama Tabel | Model | Fungsi | Status |
|----|-----------|-------|--------|--------|
| 1 | `users` | UserModel | Data user (admin, TPS, user unit) | ✅ AKTIF |
| 2 | `unit` | UnitModel | Data unit/gedung/fakultas | ✅ AKTIF |
| 3 | `waste_management` | WasteModel | Data sampah utama (draft, dikirim, review) | ✅ AKTIF |
| 4 | `waste_tps` | WasteTpsModel | Data sampah dari TPS | ✅ AKTIF |
| 5 | `master_harga_sampah` | MasterHargaSampahModel | Master harga sampah per jenis | ✅ AKTIF |
| 6 | `log_perubahan_harga` | LogPerubahanHargaModel | Log perubahan harga sampah | ✅ AKTIF |
| 7 | `dashboard_settings` | DashboardSettingModel | Pengaturan dashboard per role | ✅ AKTIF |
| 8 | `feature_toggles` | FeatureToggleModel | Toggle fitur on/off | ✅ AKTIF |
| 9 | `change_logs` | ChangeLogModel | Log perubahan sistem | ✅ AKTIF |
| 10 | `jenis_sampah` | JenisSampahModel | Jenis-jenis sampah | ✅ AKTIF |
| 11 | `kriteria_uigm` | KriteriaModel | Kriteria UI Green Metric | ✅ AKTIF |
| 12 | `tahun_penilaian` | TahunPenilaianModel | Tahun penilaian UIGM | ⚠️ PARTIAL |
| 13 | `indikator` | IndikatorModel | Indikator penilaian UIGM | ⚠️ PARTIAL |
| 14 | `pengiriman_unit` | PengirimanUnitModel | Pengiriman data unit | ⚠️ PARTIAL |
| 15 | `review_kategori` | ReviewKategoriModel | Review kategori UIGM | ⚠️ PARTIAL |
| 16 | `notifikasi` | NotifikasiModel | Notifikasi sistem | ⚠️ PARTIAL |
| 17 | `riwayat_versi` | RiwayatVersiModel | Riwayat versi data | ⚠️ PARTIAL |

### ❌ TABEL TIDAK TERPAKAI (Tidak Ada Model/Controller)

| No | Nama Tabel | Status | Keterangan |
|----|-----------|--------|------------|
| 1 | `waste_approved` | ❌ TIDAK TERPAKAI | Model ada tapi tidak digunakan |
| 2 | `waste_rejected` | ❌ TIDAK TERPAKAI | Model ada tapi tidak digunakan |
| 3 | `notifications` | ❌ TIDAK TERPAKAI | Duplikat dengan `notifikasi` |
| 4 | `tps_batch_submissions` | ❌ TIDAK TERPAKAI | Model ada tapi tidak digunakan |
| 5 | `penilaian_unit` | ❌ TIDAK TERPAKAI | Model ada tapi tidak digunakan |
| 6 | `laporan_waste` | ❌ TIDAK ADA MODEL | Tabel ada di database tapi tidak ada model |

---

## 📊 DETAIL TABEL UTAMA

### 1. **users** (Tabel User)
**Kolom Penting:**
- `id` - Primary key
- `username` - Username login
- `password` - Password (plain text)
- `email` - Email user
- `nama_lengkap` - Nama lengkap
- `role` - Role: `user`, `pengelola_tps`, `admin_pusat`, `super_admin`
- `unit_id` - Foreign key ke tabel `unit`
- `status_aktif` - Status aktif (1/0)

**Digunakan di:**
- Login/Authentication
- User Management
- Dashboard (semua role)

---

### 2. **unit** (Tabel Unit/Gedung)
**Kolom Penting:**
- `id` - Primary key
- `kode_unit` - Kode unit (contoh: FT, FE)
- `nama_unit` - Nama unit (contoh: Fakultas Teknik)
- `tipe_unit` - Tipe: `fakultas`, `jurusan`, `unit_kerja`, `lembaga`
- `status_aktif` - Status aktif (1/0)

**Digunakan di:**
- Unit Management
- User Management (dropdown)
- Waste Management (filter)

---

### 3. **waste_management** (Tabel Data Sampah Utama)
**Kolom Penting:**
- `id` - Primary key
- `unit_id` - Foreign key ke `unit`
- `user_id` - Foreign key ke `users`
- `jenis_sampah` - Jenis sampah (Plastik, Kertas, dll)
- `nama_jenis` - Nama detail jenis sampah
- `berat_kg` - Berat dalam kg
- `nilai_rupiah` - Nilai dalam rupiah
- `tanggal` - Tanggal input
- `status` - Status: `draft`, `dikirim_ke_tps`, `disetujui_tps`, `ditolak_tps`, `dikirim`, `disetujui`, `ditolak`
- `foto_bukti` - Path foto bukti
- `catatan` - Catatan user
- `catatan_admin` - Catatan admin/TPS
- `action_timestamp` - Timestamp untuk auto-delete (2 hari setelah approve/reject)

**Digunakan di:**
- User Waste Management
- TPS Waste Management
- Admin Waste Management
- Dashboard (semua role)

---

### 4. **waste_tps** (Tabel Data Sampah TPS)
**Kolom Penting:**
- `id` - Primary key
- `tps_id` - Foreign key ke `users` (role: pengelola_tps)
- `jenis_sampah` - Jenis sampah
- `nama_jenis` - Nama detail jenis
- `berat_kg` - Berat dalam kg
- `nilai_rupiah` - Nilai dalam rupiah
- `tanggal` - Tanggal input
- `status` - Status: `draft`, `dikirim`, `disetujui`, `ditolak`

**Digunakan di:**
- TPS Waste Management
- TPS Dashboard

---

### 5. **master_harga_sampah** (Tabel Master Harga)
**Kolom Penting:**
- `id` - Primary key
- `jenis_sampah` - Kategori sampah (Plastik, Kertas, dll)
- `nama_jenis` - Nama lengkap jenis
- `harga_per_satuan` - Harga per satuan
- `satuan` - Satuan (kg, pcs, dll)
- `dapat_dijual` - Bisa dijual atau tidak (1/0)
- `status_aktif` - Status aktif (1/0)

**Digunakan di:**
- Manajemen Harga Sampah
- Waste Form (dropdown)
- Dashboard (info harga)

---

### 6. **dashboard_settings** (Tabel Pengaturan Dashboard)
**Kolom Penting:**
- `id` - Primary key
- `role` - Role: `user`, `tps`
- `widget_key` - Key widget: `stat_cards`, `waste_summary`, dll
- `is_active` - Widget aktif atau tidak (1/0)
- `urutan` - Urutan tampilan widget
- `custom_label` - Label custom widget
- `custom_color` - Warna custom widget
- `widget_config` - Konfigurasi widget (JSON)

**Digunakan di:**
- User Dashboard
- TPS Dashboard
- Admin Pengaturan Dashboard

---

### 7. **feature_toggles** (Tabel Toggle Fitur)
**Kolom Penting:**
- `id` - Primary key
- `feature_key` - Key fitur (contoh: `export_data`, `import_excel`)
- `feature_name` - Nama fitur
- `is_enabled` - Fitur aktif atau tidak (1/0)
- `allowed_roles` - Role yang boleh akses (JSON array)
- `description` - Deskripsi fitur

**Digunakan di:**
- Feature Toggle Management
- Middleware (cek akses fitur)

---

### 8. **log_perubahan_harga** (Tabel Log Harga)
**Kolom Penting:**
- `id` - Primary key
- `harga_id` - Foreign key ke `master_harga_sampah`
- `jenis_sampah` - Jenis sampah
- `harga_lama` - Harga sebelumnya
- `harga_baru` - Harga baru
- `alasan_perubahan` - Alasan perubahan
- `changed_by` - User yang mengubah
- `status_perubahan` - Status: `pending`, `approved`, `rejected`

**Digunakan di:**
- Manajemen Harga (log perubahan)
- Dashboard Admin (recent changes)

---

## 🔍 TABEL YANG PERLU DIPERHATIKAN

### ⚠️ Tabel dengan Status PARTIAL (Belum Sepenuhnya Digunakan)

1. **tahun_penilaian** - Untuk UIGM, tapi belum fully implemented
2. **indikator** - Untuk UIGM, tapi belum fully implemented
3. **pengiriman_unit** - Untuk UIGM, tapi belum fully implemented
4. **review_kategori** - Untuk UIGM, tapi belum fully implemented
5. **notifikasi** - Ada model tapi belum digunakan di UI
6. **riwayat_versi** - Ada model tapi belum digunakan di UI

### ❌ Tabel yang TIDAK TERPAKAI (Bisa Dihapus)

1. **waste_approved** - Tidak digunakan (data approved langsung ke `laporan_waste`)
2. **waste_rejected** - Tidak digunakan (data rejected langsung ke `laporan_waste`)
3. **notifications** - Duplikat dengan `notifikasi`
4. **tps_batch_submissions** - Tidak digunakan
5. **penilaian_unit** - Tidak digunakan

---

## 📝 REKOMENDASI

### 1. **Dashboard Settings**
- ✅ Sudah ada tabel dan model
- ⚠️ Belum ada halaman UI untuk admin mengatur dashboard
- 💡 **Saran:** Buat halaman `/admin-pusat/pengaturan-dashboard` untuk mengatur widget

### 2. **Cleanup Database**
- ❌ Hapus tabel yang tidak terpakai: `waste_approved`, `waste_rejected`, `notifications`, `tps_batch_submissions`, `penilaian_unit`
- ⚠️ Review tabel PARTIAL: Apakah akan digunakan atau dihapus?

### 3. **Optimasi**
- 📊 Tambahkan index pada kolom yang sering di-query (status, unit_id, user_id)
- 🗑️ Implementasi auto-delete untuk data lama di `waste_management` (sudah ada `action_timestamp`)

---

## 🎯 KESIMPULAN

### Dashboard Settings:
- **Fungsi:** Mengatur tampilan dashboard per role (User & TPS)
- **Widget:** 6 jenis widget yang bisa dikustomisasi
- **Status:** Tabel sudah ada, tapi UI pengaturan belum dibuat

### Tabel Database:
- **Total Tabel:** 23 tabel
- **Aktif Penuh:** 11 tabel
- **Partial:** 6 tabel (UIGM related)
- **Tidak Terpakai:** 6 tabel (bisa dihapus)

### Tabel Paling Penting:
1. `users` - Data user
2. `unit` - Data unit/gedung
3. `waste_management` - Data sampah utama
4. `master_harga_sampah` - Master harga
5. `dashboard_settings` - Pengaturan dashboard

---

**Dibuat:** <?= date('Y-m-d H:i:s') ?>  
**Versi:** 1.0
