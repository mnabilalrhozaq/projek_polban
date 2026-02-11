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

Berikut adalah **SEMUA TABEL** yang ada di database (berdasarkan file SQL):

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
| 8 | `laporan_waste` | ❌ TIDAK ADA MODEL | Data waste yang sudah approved/rejected | ✅ AKTIF (manual query) |
| 9 | `migrations` | - | Tracking migrasi database CodeIgniter | ✅ AKTIF (system) |

### ❌ TABEL TIDAK TERPAKAI / DUPLIKAT

| No | Nama Tabel | Status | Keterangan |
|----|-----------|--------|------------|
| 1 | `waste_approved` | ❌ TIDAK TERPAKAI | Data approved langsung ke `laporan_waste` |
| 2 | `waste_rejected` | ❌ TIDAK TERPAKAI | Data rejected langsung ke `laporan_waste` |
| 3 | `notifications` | ❌ TIDAK TERPAKAI | Ada tapi tidak ada model/controller |
| 4 | `tps_batch_submissions` | ❌ TIDAK TERPAKAI | Model ada tapi tidak digunakan |
| 5 | `penilaian_unit` | ❌ TIDAK TERPAKAI | Ada tapi tidak ada model/controller |
| 6 | `units` | ❌ DUPLIKAT | Duplikat dengan tabel `unit` |

### ⚠️ CATATAN PENTING

**Tabel `laporan_waste`:**
- Tabel ini **SANGAT PENTING** tapi **TIDAK ADA MODEL**
- Digunakan untuk menyimpan data waste yang sudah di-approve/reject oleh admin
- Saat ini diakses menggunakan **manual query** di service
- **Rekomendasi:** Buat model `LaporanWasteModel` untuk akses yang lebih terstruktur

**Tabel Duplikat:**
- `unit` vs `units` - Ada 2 tabel dengan fungsi sama
- `unit` yang digunakan (12 records)
- `units` tidak terpakai (4 records)
- **Rekomendasi:** Hapus tabel `units`

---

## 📊 DETAIL TABEL UTAMA (Berdasarkan SQL File)

### 1. **users** (Tabel User)
**Kolom:**
- `id` - Primary key
- `username` - Username login (varchar 100)
- `password` - Password plain text (varchar 255)
- `email` - Email user (varchar 100)
- `nama_lengkap` - Nama lengkap (varchar 255)
- `role` - Role: `admin_pusat`, `admin_unit`, `super_admin`, `user`, `pengelola_tps`
- `unit_id` - Foreign key ke tabel `unit`
- `status_aktif` - Status aktif (tinyint 1/0)
- `last_login` - Timestamp login terakhir
- `created_at`, `updated_at` - Timestamps

**Data Saat Ini:** 8 users (1 admin, 2 TPS, 5 user)

**Digunakan di:**
- Login/Authentication
- User Management
- Dashboard (semua role)

---

### 2. **unit** (Tabel Unit/Gedung)
**Kolom:**
- `id` - Primary key
- `nama_unit` - Nama unit (varchar 255)
- `kode_unit` - Kode unit (varchar 50)
- `status_aktif` - Status aktif (tinyint 1/0)
- `created_at`, `updated_at` - Timestamps

**Data Saat Ini:** 12 units (TPS, JTI, JTS, JTM, AN, PP, Gedung A-F)

**Digunakan di:**
- Unit Management
- User Management (dropdown)
- Waste Management (filter)

---

### 3. **waste_management** (Tabel Data Sampah Utama)
**Kolom:**
- `id` - Primary key
- `unit_id` - Foreign key ke `unit`
- `user_id` - Foreign key ke `users`
- `jenis_sampah` - Jenis sampah (varchar 100)
- `nama_jenis` - Nama detail jenis sampah (varchar 100)
- `berat_kg` - Berat dalam kg (decimal 10,2)
- `satuan` - Satuan (varchar 20)
- `jumlah` - Jumlah (decimal 10,2)
- `nilai_rupiah` - Nilai dalam rupiah (decimal 15,2)
- `tanggal` - Tanggal input (date)
- `status` - Status: `draft`, `dikirim_ke_tps`, `disetujui_tps`, `ditolak_tps`, `dikirim`, `disetujui`, `ditolak`
- `foto_bukti` - Path foto bukti (varchar 255)
- `catatan` - Catatan user (text)
- `catatan_admin` - Catatan admin/TPS (text)
- `catatan_tps` - Catatan TPS (text)
- `rejection_reason` - Alasan penolakan (text)
- `action_timestamp` - Timestamp untuk auto-delete (datetime)
- `created_at`, `updated_at` - Timestamps

**Digunakan di:**
- User Waste Management
- TPS Waste Management
- Admin Waste Management
- Dashboard (semua role)

---

### 4. **waste_tps** (Tabel Data Sampah TPS)
**Kolom:**
- `id` - Primary key
- `user_id` - Foreign key ke `users` (role: pengelola_tps)
- `jenis_sampah` - Jenis sampah (varchar 100)
- `nama_jenis` - Nama detail jenis (varchar 100)
- `berat_kg` - Berat dalam kg (decimal 10,2)
- `satuan` - Satuan (varchar 20)
- `jumlah` - Jumlah (decimal 10,2)
- `nilai_rupiah` - Nilai dalam rupiah (decimal 15,2)
- `tanggal` - Tanggal input (date)
- `status` - Status: `draft`, `dikirim`, `disetujui`, `ditolak`
- `foto_bukti` - Path foto bukti (varchar 255)
- `catatan` - Catatan TPS (text)
- `catatan_admin` - Catatan admin (text)
- `created_at`, `updated_at` - Timestamps

**Digunakan di:**
- TPS Waste Management
- TPS Dashboard

---

### 5. **master_harga_sampah** (Tabel Master Harga)
**Kolom:**
- `id` - Primary key
- `jenis_sampah` - Kategori sampah (varchar 100)
- `nama_jenis` - Nama lengkap jenis (varchar 100)
- `harga_per_satuan` - Harga per satuan (decimal 15,2)
- `satuan` - Satuan: kg, pcs, gram, liter, karung (varchar 20)
- `status_aktif` - Status aktif (tinyint 1/0)
- `dapat_dijual` - Bisa dijual atau tidak (tinyint 1/0)
- `deskripsi` - Deskripsi (text)
- `created_by`, `updated_by` - User ID
- `created_at`, `updated_at` - Timestamps

**Data Saat Ini:** 15 jenis sampah (Plastik, Kertas, Logam, Organik, Residu, Besi, Elektronik, dll)

**Digunakan di:**
- Manajemen Harga Sampah
- Waste Form (dropdown)
- Dashboard (info harga)

---

### 6. **laporan_waste** (Tabel Laporan Waste - PENTING!)
**Kolom:**
- `id` - Primary key
- `waste_id` - Foreign key ke `waste_management`
- `unit_id` - Foreign key ke `unit`
- `kategori_id` - Foreign key ke kategori (nullable)
- `jenis_sampah` - Jenis sampah (varchar 100)
- `berat_kg` - Berat dalam kg (decimal 10,2)
- `satuan` - Satuan (varchar 20)
- `jumlah` - Jumlah (decimal 10,2)
- `nilai_rupiah` - Nilai dalam rupiah (decimal 15,2)
- `tanggal_input` - Tanggal input (date)
- `status` - Status: `approved`, `rejected`
- `reviewed_by` - User ID yang review
- `reviewed_at` - Timestamp review
- `review_notes` - Catatan review (text)
- `created_by` - User ID pembuat
- `created_at`, `updated_at` - Timestamps

**Data Saat Ini:** 45 records (approved & rejected)

**⚠️ CATATAN PENTING:**
- Tabel ini **TIDAK ADA MODEL** - diakses manual query
- Menyimpan data waste yang sudah di-approve/reject
- Data dari `waste_management` dipindah ke sini setelah review
- **Rekomendasi:** Buat `LaporanWasteModel` untuk akses terstruktur

**Digunakan di:**
- Admin Waste Service (approve/reject)
- Laporan Waste (reporting)

---

### 7. **dashboard_settings** (Tabel Pengaturan Dashboard)
**Kolom:**
- `id` - Primary key
- `role` - Role: `user`, `tps`
- `widget_key` - Key widget: `stat_cards`, `waste_summary`, dll (varchar 100)
- `is_active` - Widget aktif atau tidak (tinyint 1/0)
- `urutan` - Urutan tampilan widget (int)
- `custom_label` - Label custom widget (varchar 255)
- `custom_color` - Warna custom widget (varchar 50)
- `widget_config` - Konfigurasi widget (JSON)
- `created_at`, `updated_at` - Timestamps

**Data Saat Ini:** 10 records (5 untuk user, 5 untuk TPS)

**Digunakan di:**
- User Dashboard
- TPS Dashboard
- Admin Pengaturan Dashboard (belum ada UI)

---

### 8. **log_perubahan_harga** (Tabel Log Harga)
**Kolom:**
- `id` - Primary key
- `master_harga_id` - Foreign key ke `master_harga_sampah`
- `jenis_sampah` - Jenis sampah (varchar 100)
- `harga_lama` - Harga sebelumnya (decimal 10,2)
- `harga_baru` - Harga baru (decimal 10,2)
- `perubahan_harga` - Selisih harga (decimal 10,2)
- `persentase_perubahan` - Persentase perubahan (decimal 5,2)
- `alasan_perubahan` - Alasan perubahan (text)
- `status_perubahan` - Status: `pending`, `approved`, `rejected`
- `tanggal_berlaku` - Tanggal berlaku (date)
- `created_by` - User ID yang mengubah
- `approved_by` - User ID yang approve
- `created_at`, `updated_at` - Timestamps

**Data Saat Ini:** 31 records log perubahan

**Digunakan di:**
- Manajemen Harga (log perubahan)
- Dashboard Admin (recent changes)

---

### 9. **notifications** (Tabel Notifikasi)
**Kolom:**
- `id` - Primary key
- `user_id` - Foreign key ke `users`
- `title` - Judul notifikasi (varchar 255)
- `message` - Pesan notifikasi (text)
- `type` - Tipe: `info`, `success`, `warning`, `danger`
- `data` - Data tambahan (JSON)
- `is_read` - Sudah dibaca atau belum (tinyint 1/0)
- `read_at` - Timestamp dibaca
- `created_at`, `updated_at` - Timestamps

**Data Saat Ini:** 3 records

**Status:** ❌ TIDAK TERPAKAI (tidak ada model/controller)

---

## 🔍 TABEL YANG PERLU DIPERHATIKAN

### ⚠️ Tabel PENTING Tanpa Model

**`laporan_waste`** - Tabel ini sangat penting tapi tidak ada model!
- Menyimpan semua data waste yang sudah di-approve/reject
- Saat ini diakses dengan manual query di service
- **45 records** data approved & rejected
- **Rekomendasi:** Buat `LaporanWasteModel` untuk akses terstruktur

### ❌ Tabel Duplikat yang Harus Dihapus

**`units` vs `unit`**
- Ada 2 tabel dengan fungsi sama
- `unit` - Digunakan (12 records: TPS, JTI, JTS, JTM, AN, PP, Gedung A-F)
- `units` - Tidak terpakai (4 records: TPS, JTI, JTE, JTM)
- **Rekomendasi:** Hapus tabel `units`, gunakan `unit` saja

### ❌ Tabel yang TIDAK TERPAKAI (Bisa Dihapus)

1. **waste_approved** - Data approved langsung ke `laporan_waste`
2. **waste_rejected** - Data rejected langsung ke `laporan_waste`
3. **notifications** - Ada 3 records tapi tidak ada model/controller
4. **tps_batch_submissions** - Model ada tapi tidak digunakan
5. **penilaian_unit** - Tidak ada data, tidak ada model

---

## 📝 REKOMENDASI

### 1. **Dashboard Settings**
- ✅ Tabel sudah ada dengan 10 records (5 user, 5 TPS)
- ⚠️ Belum ada halaman UI untuk admin mengatur dashboard
- 💡 **Saran:** Buat halaman `/admin-pusat/pengaturan-dashboard` untuk mengatur widget

### 2. **Buat Model untuk `laporan_waste`**
- ❌ Tabel penting tapi tidak ada model
- 📊 Sudah ada 45 records data
- 💡 **Saran:** Buat `LaporanWasteModel` untuk akses terstruktur dan reporting

### 3. **Cleanup Database**
- ❌ Hapus tabel duplikat: `units` (gunakan `unit` saja)
- ❌ Hapus tabel tidak terpakai: `waste_approved`, `waste_rejected`, `notifications`, `tps_batch_submissions`, `penilaian_unit`
- 💡 **Saran:** Backup dulu sebelum hapus

### 4. **Optimasi**
- 📊 Tambahkan index pada kolom yang sering di-query:
  - `waste_management`: `status`, `unit_id`, `user_id`, `tanggal`
  - `laporan_waste`: `status`, `unit_id`, `tanggal_input`
  - `users`: `role`, `unit_id`, `status_aktif`
- 🗑️ Implementasi auto-delete untuk data lama di `waste_management` (sudah ada `action_timestamp`)

---

## 🎯 KESIMPULAN

### Dashboard Settings:
- **Fungsi:** Mengatur tampilan dashboard per role (User & TPS)
- **Widget:** 6 jenis widget yang bisa dikustomisasi
- **Data:** 10 records sudah ada di database
- **Status:** Tabel sudah ada, tapi UI pengaturan belum dibuat

### Tabel Database (Berdasarkan SQL File):
- **Total Tabel:** 13 tabel
- **Aktif Penuh:** 9 tabel
- **Tidak Terpakai:** 5 tabel (bisa dihapus)
- **Duplikat:** 1 tabel (`units` - duplikat dengan `unit`)

### Tabel Paling Penting:
1. `users` - 8 users (1 admin, 2 TPS, 5 user)
2. `unit` - 12 units/gedung
3. `waste_management` - Data sampah utama (aktif)
4. `laporan_waste` - 45 records (approved/rejected) - **PERLU MODEL**
5. `master_harga_sampah` - 15 jenis sampah
6. `dashboard_settings` - 10 widget settings

### Action Items:
1. ✅ Buat `LaporanWasteModel` untuk tabel `laporan_waste`
2. ✅ Buat UI pengaturan dashboard di `/admin-pusat/pengaturan-dashboard`
3. ✅ Hapus tabel duplikat `units`
4. ✅ Hapus 5 tabel yang tidak terpakai
5. ✅ Tambahkan index untuk optimasi query

---

**Dibuat:** 11 Februari 2026  
**Versi:** 2.0 (Updated berdasarkan SQL file)  
**SQL File:** eksperimen (17).sql
