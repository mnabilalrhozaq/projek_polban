# Dokumentasi Role dan Pagination - POLBAN Green Metric

## 👥 DAFTAR ROLE DALAM SISTEM

### 1. **Admin Pusat** (`admin_pusat`, `super_admin`)
**Akses:** Semua fitur sistem
**Menu:**
- Dashboard
- Manajemen Harga Sampah
- Feature Toggle
- User Management
- Unit Management
- Waste Management
- Review Data
- Laporan Waste
- Laporan Rekap
- Profil
- Pengaturan
- UIGM Categories (Setting & Infrastructure, Energy & Climate, Water, Transportation, Education)

### 2. **Pengelola TPS** (`pengelola_tps`)
**Akses:** Manajemen sampah di TPS
**Menu:**
- Dashboard TPS
- Data Sampah TPS
- Laporan Masuk dari User
- Profil

### 3. **User** (`user`)
**Akses:** Input dan monitoring data sampah unit
**Menu:**
- Dashboard User
- Data Sampah
- Kriteria UIGM
- Pengisian Data
- Profil

---

## 📊 TABEL DENGAN PAGINATION

### 🔴 **ADMIN PUSAT**

#### 1. **Dashboard Admin** (`/admin-pusat/dashboard`)
**File:** `app/Views/admin_pusat/dashboard.php`
**Service:** `app/Services/Admin/DashboardService.php`

**Tabel dengan Pagination:**
- ❌ **TIDAK ADA** - Dashboard hanya menampilkan summary dan recent data (limit 5-10)

---

#### 2. **Manajemen Harga Sampah** (`/admin-pusat/manajemen-harga`)
**File:** `app/Views/admin_pusat/manajemen_harga/index.php`
**Service:** `app/Services/Admin/HargaService.php`

**Tabel dengan Pagination:**
- ✅ **Tabel Master Harga Sampah**
  - **Implementasi:** CodeIgniter Pager
  - **Per Page:** 10 items
  - **Query:** `$hargaModel->paginate(10)`
  - **Pager Variable:** `$pager`

---

#### 3. **Waste Management** (`/admin-pusat/waste`)
**File:** `app/Views/admin_pusat/waste_management.php`
**Service:** `app/Services/Admin/WasteService.php`

**Tabel dengan Pagination:**
- ✅ **Tabel Data Waste**
  - **Implementasi:** CodeIgniter Pager
  - **Per Page:** 20 items
  - **Query:** `$wasteModel->paginate(20)`
  - **Pager Variable:** `$pager`
  - **Filter:** Status, Unit, Tanggal

---

#### 4. **Laporan Waste** (`/admin-pusat/laporan-waste`)
**File:** `app/Views/admin_pusat/laporan_waste/index.php`
**Service:** `app/Services/Admin/LaporanWasteService.php`

**Tabel dengan Pagination (MULTIPLE):**

**a. Data Disetujui**
- ✅ **Pagination:** Custom manual pagination
- **Per Page:** 10 items
- **Page Variable:** `$pages['disetujui']`
- **Total Pages:** `$pagination['total_pages_disetujui']`

**b. Data Ditolak**
- ✅ **Pagination:** Custom manual pagination
- **Per Page:** 10 items
- **Page Variable:** `$pages['ditolak']`
- **Total Pages:** `$pagination['total_pages_ditolak']`

**c. Rekap Per Jenis Sampah**
- ✅ **Pagination:** Custom manual pagination
- **Per Page:** 10 items
- **Page Variable:** `$pages['rekap_jenis']`
- **Total Pages:** `$pagination['total_pages_rekap_jenis']`

**d. Rekap Per Unit**
- ✅ **Pagination:** Custom manual pagination
- **Per Page:** 10 items
- **Page Variable:** `$pages['rekap_unit']`
- **Total Pages:** `$pagination['total_pages_rekap_unit']`

**e. Detail Rekap Gedung & Pelapor**
- ✅ **Pagination:** Custom manual pagination
- **Per Page:** 10 items
- **Page Variable:** `$pages['detail_rekap']`
- **Total Pages:** `$pagination['total_pages_detail_rekap']`

**Catatan:** Halaman ini memiliki **5 pagination terpisah** dalam satu halaman!

---

#### 5. **User Management** (`/admin-pusat/user-management`)
**File:** `app/Views/admin_pusat/user_management.php`
**Service:** `app/Services/Admin/UserManagementService.php`

**Tabel dengan Pagination:**
- ✅ **Tabel Users**
  - **Implementasi:** CodeIgniter Pager
  - **Per Page:** 15 items
  - **Query:** `$userModel->paginate(15)`
  - **Pager Variable:** `$pager`

---

#### 6. **Unit Management** (`/admin-pusat/unit-management`)
**File:** `app/Views/admin_pusat/unit_management.php`
**Service:** `app/Services/Admin/UnitManagementService.php`

**Tabel dengan Pagination:**
- ✅ **Tabel Units**
  - **Implementasi:** CodeIgniter Pager
  - **Per Page:** 15 items
  - **Query:** `$unitModel->paginate(15)`
  - **Pager Variable:** `$pager`

---

#### 7. **Review Data** (`/admin-pusat/review`)
**File:** `app/Views/admin_pusat/review.php`
**Service:** `app/Services/Admin/ReviewService.php`

**Tabel dengan Pagination:**
- ✅ **Tabel Pengiriman Unit**
  - **Implementasi:** CodeIgniter Pager
  - **Per Page:** 20 items
  - **Query:** `$pengirimanModel->paginate(20)`
  - **Pager Variable:** `$pager`

---

### 🟡 **PENGELOLA TPS**

#### 1. **Dashboard TPS** (`/pengelola-tps/dashboard`)
**File:** `app/Views/pengelola_tps/dashboard.php`
**Service:** `app/Services/TPS/DashboardService.php`

**Tabel dengan Pagination:**
- ❌ **TIDAK ADA** - Dashboard hanya menampilkan summary dan recent data

---

#### 2. **Data Sampah TPS** (`/pengelola-tps/waste`)
**File:** `app/Views/pengelola_tps/waste.php`
**Service:** `app/Services/TPS/WasteService.php`

**Tabel dengan Pagination:**
- ✅ **Informasi Harga Sampah (Cards)**
  - **Implementasi:** CodeIgniter Pager
  - **Per Page:** 5 cards
  - **Query:** `$hargaModel->paginate(5, 'harga')`
  - **Pager Variable:** `$pagerHarga`
  - **Group:** `'harga'`

- ❌ **Tabel Data Waste** - Menggunakan tabs, tidak ada pagination

---

#### 3. **Laporan Masuk** (`/pengelola-tps/laporan-masuk`)
**File:** `app/Views/pengelola_tps/laporan_masuk.php`
**Service:** `app/Services/TPS/LaporanMasukService.php`

**Tabel dengan Pagination:**
- ❌ **TIDAK ADA** - Menampilkan semua data pending dan reviewed (limit 20)

---

### 🟢 **USER**

#### 1. **Dashboard User** (`/user/dashboard`)
**File:** `app/Views/user/dashboard.php`
**Service:** `app/Services/User/DashboardService.php`

**Tabel dengan Pagination:**
- ❌ **TIDAK ADA** - Dashboard hanya menampilkan summary

---

#### 2. **Data Sampah User** (`/user/waste`)
**File:** `app/Views/user/waste.php`
**Service:** `app/Services/User/WasteService.php`

**Tabel dengan Pagination:**
- ✅ **Informasi Harga Sampah (Cards)**
  - **Implementasi:** CodeIgniter Pager
  - **Per Page:** 5 cards
  - **Query:** `$hargaModel->paginate(5, 'harga')`
  - **Pager Variable:** `$pagerHarga`
  - **Group:** `'harga'`
  - **URL Parameter:** `?page_harga=1`

- ❌ **Tabel Data Waste** - Menggunakan tabs, tidak ada pagination

---

#### 3. **Kriteria UIGM** (`/user/kriteria`)
**File:** `app/Views/user/kriteria.php`

**Tabel dengan Pagination:**
- ❌ **TIDAK ADA** - Menampilkan semua kriteria

---

#### 4. **Pengisian Data** (`/user/pengisian`)
**File:** `app/Views/user/pengisian.php`

**Tabel dengan Pagination:**
- ❌ **TIDAK ADA** - Form input data

---

## 📋 RINGKASAN PAGINATION

### Total Halaman dengan Pagination: **8 halaman**

| No | Role | Halaman | Jumlah Pagination | Per Page |
|----|------|---------|-------------------|----------|
| 1 | Admin | Manajemen Harga | 1 | 10 |
| 2 | Admin | Waste Management | 1 | 20 |
| 3 | Admin | Laporan Waste | **5** | 10 |
| 4 | Admin | User Management | 1 | 15 |
| 5 | Admin | Unit Management | 1 | 15 |
| 6 | Admin | Review Data | 1 | 20 |
| 7 | TPS | Data Sampah (Harga) | 1 | 5 |
| 8 | User | Data Sampah (Harga) | 1 | 5 |

**Total Pagination:** **12 pagination** (termasuk 5 pagination di Laporan Waste)

---

## 🔧 IMPLEMENTASI PAGINATION

### **Tipe 1: CodeIgniter Pager (Standard)**
```php
// Controller
$data = $model->paginate(10);
$pager = $model->pager;

// View
<?= $pager->links() ?>
```

**Digunakan di:**
- Manajemen Harga Sampah
- Waste Management
- User Management
- Unit Management
- Review Data
- Data Sampah (Harga Cards) - User & TPS

---

### **Tipe 2: Custom Manual Pagination**
```php
// Service
$offset = ($page - 1) * $perPage;
$data = $query->limit($perPage, $offset)->get()->getResultArray();
$totalPages = ceil($totalItems / $perPage);

// View - Custom HTML
<ul class="pagination">
    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
        <a href="?page=<?= $page - 1 ?>">Previous</a>
    </li>
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
            <a href="?page=<?= $i ?>"><?= $i ?></a>
        </li>
    <?php endfor; ?>
    <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
        <a href="?page=<?= $page + 1 ?>">Next</a>
    </li>
</ul>
```

**Digunakan di:**
- Laporan Waste (5 pagination terpisah)

---

### **Tipe 3: Grouped Pagination**
```php
// Controller
$categories = $hargaModel->paginate(5, 'harga');
$pagerHarga = $hargaModel->pager;

// View
<?php if ($pagerHarga->getPageCount('harga') > 1): ?>
    <a href="?page_harga=<?= $pagerHarga->getCurrentPage('harga') - 1 ?>">Prev</a>
    <?php for ($i = 1; $i <= $pagerHarga->getPageCount('harga'); $i++): ?>
        <a href="?page_harga=<?= $i ?>"><?= $i ?></a>
    <?php endfor; ?>
    <a href="?page_harga=<?= $pagerHarga->getCurrentPage('harga') + 1 ?>">Next</a>
<?php endif; ?>
```

**Digunakan di:**
- User Waste (Harga Cards)
- TPS Waste (Harga Cards)

**Keuntungan:** Bisa ada multiple pagination dalam satu halaman dengan group berbeda

---

## 🎯 REKOMENDASI

### 1. **Standardisasi Pagination**
- Gunakan CodeIgniter Pager untuk semua pagination baru
- Konsisten dengan per page: 10, 15, atau 20

### 2. **Laporan Waste - Perlu Refactor**
- 5 pagination dalam 1 halaman terlalu kompleks
- Pertimbangkan menggunakan tabs atau accordion
- Atau pisah menjadi halaman terpisah

### 3. **User & TPS Waste**
- Pertimbangkan menambahkan pagination untuk tabel data waste
- Saat ini menggunakan tabs tanpa pagination (bisa lambat jika data banyak)

### 4. **Mobile Responsive**
- Pastikan semua pagination responsive di mobile
- Gunakan pagination compact untuk mobile

---

## 📝 CATATAN PENTING

1. **Laporan Waste** adalah halaman paling kompleks dengan 5 pagination terpisah
2. **User & TPS** menggunakan grouped pagination untuk Harga Sampah cards
3. **Dashboard** tidak menggunakan pagination (hanya summary)
4. **Laporan Masuk TPS** tidak menggunakan pagination (limit 20 data)

---

## 🔍 FILE TERKAIT

### Controllers:
- `app/Controllers/Admin/*.php`
- `app/Controllers/TPS/*.php`
- `app/Controllers/User/*.php`

### Services:
- `app/Services/Admin/*.php`
- `app/Services/TPS/*.php`
- `app/Services/User/*.php`

### Views:
- `app/Views/admin_pusat/*.php`
- `app/Views/pengelola_tps/*.php`
- `app/Views/user/*.php`

### Models:
- `app/Models/*.php` (semua model support pagination via CodeIgniter)
