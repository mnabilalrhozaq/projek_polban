-- ============================================
-- SQL Script: Cleanup Unused Tables
-- Database: eksperimen
-- Tanggal: 11 Februari 2026
-- ============================================

-- BACKUP DULU SEBELUM MENJALANKAN SCRIPT INI!
-- Jalankan: mysqldump -u root eksperimen > backup_before_cleanup.sql

-- ============================================
-- TABEL YANG AKAN DIHAPUS
-- ============================================

-- 1. dashboard_settings - Tidak ada UI untuk mengatur
DROP TABLE IF EXISTS `dashboard_settings`;

-- 2. units - Duplikat dengan tabel 'unit'
DROP TABLE IF EXISTS `units`;

-- 3. waste_approved - Tidak digunakan (data langsung ke laporan_waste)
DROP TABLE IF EXISTS `waste_approved`;

-- 4. waste_rejected - Tidak digunakan (data langsung ke laporan_waste)
DROP TABLE IF EXISTS `waste_rejected`;

-- 5. notifications - Tidak ada model/controller
DROP TABLE IF EXISTS `notifications`;

-- 6. tps_batch_submissions - Model ada tapi tidak digunakan
DROP TABLE IF EXISTS `tps_batch_submissions`;

-- 7. penilaian_unit - Tidak ada data, tidak ada model
DROP TABLE IF EXISTS `penilaian_unit`;

-- ============================================
-- VERIFIKASI SETELAH CLEANUP
-- ============================================

-- Cek tabel yang tersisa
SHOW TABLES;

-- Hasil yang diharapkan:
-- +------------------------+
-- | Tables_in_eksperimen   |
-- +------------------------+
-- | laporan_waste          |
-- | log_perubahan_harga    |
-- | master_harga_sampah    |
-- | migrations             |
-- | unit                   |
-- | users                  |
-- | waste_management       |
-- | waste_tps              |
-- +------------------------+

-- ============================================
-- CATATAN PENTING
-- ============================================

/*
TABEL YANG DIHAPUS:
1. dashboard_settings (10 records) - Tidak ada UI
2. units (4 records) - Duplikat dengan 'unit'
3. waste_approved (0 records) - Tidak digunakan
4. waste_rejected (0 records) - Tidak digunakan
5. notifications (3 records) - Tidak ada model
6. tps_batch_submissions (0 records) - Tidak digunakan
7. penilaian_unit (0 records) - Tidak digunakan

TABEL YANG TETAP ADA:
1. users - Data user (8 records)
2. unit - Data unit/gedung (12 records)
3. waste_management - Data sampah aktif
4. waste_tps - Data sampah TPS
5. laporan_waste - Data approved/rejected (45 records)
6. master_harga_sampah - Master harga (15 records)
7. log_perubahan_harga - Log perubahan harga (31 records)
8. migrations - System table

TOTAL TABEL SETELAH CLEANUP: 8 tabel
*/
