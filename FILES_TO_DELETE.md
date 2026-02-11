# File yang Harus Dihapus - Dashboard Settings Cleanup

## 📋 Daftar File yang Akan Dihapus

### 1. Model
- `app/Models/DashboardSettingModel.php` - Model untuk tabel dashboard_settings

### 2. Migration
- `app/Database/Migrations/2024-01-07-000001_CreateDashboardSettings.php` - Migration yang membuat tabel

### 3. Views (Jika Ada)
- `app/Views/admin_pusat/pengaturan_dashboard/` - Folder views (jika ada)
  - `app/Views/admin_pusat/pengaturan_dashboard/index.php`
  - `app/Views/admin_pusat/pengaturan_dashboard/widget_config_card.php`

### 4. File yang Perlu Dimodifikasi
- `app/Services/DashboardService.php` - Hapus semua referensi ke DashboardSettingModel

---

## 🗑️ Cara Menghapus

### Opsi 1: Manual (Lewat File Explorer)
1. Buka folder `app/Models/`
2. Hapus file `DashboardSettingModel.php`
3. Buka folder `app/Database/Migrations/`
4. Hapus file `2024-01-07-000001_CreateDashboardSettings.php`
5. Buka folder `app/Views/admin_pusat/`
6. Hapus folder `pengaturan_dashboard/` (jika ada)

### Opsi 2: Via Command Line (PowerShell)
```powershell
# Hapus Model
Remove-Item "app/Models/DashboardSettingModel.php"

# Hapus Migration
Remove-Item "app/Database/Migrations/2024-01-07-000001_CreateDashboardSettings.php"

# Hapus Views (jika ada)
Remove-Item -Recurse "app/Views/admin_pusat/pengaturan_dashboard"
```

### Opsi 3: Via Git (Recommended)
```bash
# Hapus file dan track di git
git rm app/Models/DashboardSettingModel.php
git rm app/Database/Migrations/2024-01-07-000001_CreateDashboardSettings.php
git rm -r app/Views/admin_pusat/pengaturan_dashboard

# Commit
git commit -m "Remove unused dashboard_settings feature

- Delete DashboardSettingModel
- Delete CreateDashboardSettings migration
- Delete pengaturan_dashboard views
- Table dashboard_settings will be dropped from database"
```

---

## 🗄️ Database Cleanup

Setelah hapus file, jalankan SQL script:

```sql
-- Backup dulu
-- mysqldump -u root eksperimen > backup_before_cleanup.sql

-- Hapus tabel
DROP TABLE IF EXISTS `dashboard_settings`;
```

Atau jalankan file: `cleanup_unused_tables.sql`

---

## ⚠️ CATATAN PENTING

1. **Backup dulu database** sebelum hapus tabel
2. **DashboardService.php** masih menggunakan DashboardSettingModel - perlu dimodifikasi
3. Setelah hapus, pastikan tidak ada error di aplikasi
4. Test semua dashboard (User, TPS, Admin) untuk memastikan masih berfungsi

---

## ✅ Verifikasi Setelah Cleanup

1. Cek tidak ada error saat buka dashboard
2. Cek tidak ada error di log: `writable/logs/log-*.log`
3. Test login sebagai User, TPS, dan Admin
4. Pastikan dashboard masih tampil normal

---

**Dibuat:** 11 Februari 2026  
**Status:** Ready to execute
