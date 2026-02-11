# INSTRUKSI TESTING KONTEN SURVEI

## Perubahan yang sudah dilakukan:

### 1. **Form Create** - `resources/views/admin/konten-survei/create.blade.php`
   - ✅ Form sekarang menampilkan dengan benar (sebelumnya berisi listing view)
   - ✅ Semua field sudah ada: Judul, Pendahuluan, Indikator, Deskripsi, Tujuan 1-3, Penutup, Tahun, Status Aktif
   - ✅ Error messages ditampilkan lebih jelas di atas form
   - ✅ Hidden field untuk is_active memastikan nilai selalu dikirim

### 2. **Form Edit** - `resources/views/admin/konten-survei/edit.blade.php`
   - ✅ Hidden field for is_active ditambahkan
   - ✅ Pre-filled values dari database ditampilkan

### 3. **Controller** - `app/Http/Controllers/KontenSurveiController.php`
   - ✅ Method `store()` dan `update()` sudah fixed
   - ✅ Handling checkbox is_active dengan default value false jika tidak di-check
   - ✅ Logging ditambahkan untuk debugging

### 4. **Index View** - `resources/views/admin/konten-survei/index.blade.php`
   - ✅ Success message ditampilkan lebih jelas setelah data tersimpan

## Langkah Testing:

### STEP 1: Login sebagai Admin
```
URL: http://localhost:8000/admin/login
Email: admin@bakti.go.id
Password: password (atau sesuai password Anda)
```

### STEP 2: Navigasi ke Dashboard Admin
```
URL: http://localhost:8000/admin/dashboard
- Cari menu "Konten Survei"
- Klik "Kelola Konten Survei"
```

### STEP 3: Klik Tombol "Tambah Konten"
```
- Button ada di kanan atas halaman
- Warna biru gradient dengan icon +
```

### STEP 4: Isi Form dengan Data
```
Judul Survei: "Survei Kepuasan Pegawai 2026"
Pendahuluan: "Survei ini bertujuan..."
Indikator: "KPI untuk departemen..."
Deskripsi Survei: "Survei online untuk pegawai..."
Tujuan 1: "Mengukur kepuasan kerja" (REQUIRED)
Tujuan 2: "Identifikasi area improvement" (optional)
Tujuan 3: "Mengumpulkan feedback" (optional)
Penutup: "Terima kasih atas partisipasi Anda" (REQUIRED)
Tahun: 2026
Status: Centang "Tampilkan konten survei ini di halaman utama"
```

### STEP 5: Klik Tombol "Buat Konten Survei"
```
- Button ada di bawah form sebelah kanan
- Warna biru gradient dengan icon save
```

### STEP 6: Verifikasi Berhasil
```
✓ Halaman redirect ke list konten survei
✓ Muncul pesan hijau: "Konten survei berhasil ditambahkan!"
✓ Data baru tampil di list dengan judul dan tahun yang Anda masukkan
✓ Status aktif/nonaktif sesuai dengan checkbox
```

## Jika Masih Ada Masalah:

### Error Messages Tidak Jelas
- **Solusi**: Refresh halaman (Ctrl+F5) untuk clear cache browser
- Pastikan JavaScript enabled di browser

### Form Tidak Tampil
- **Solusi**: Login ulang, pastikan Anda login sebagai admin
- Check browser console (F12) untuk JavaScript errors

### Data Tidak Tersimpan di Database
- **Solusi**: Check file `storage/logs/laravel.log` untuk error details
- Jalankan `php artisan migrate` untuk memastikan tabel sudah ada

### Field Required Tidak Jelas
- **Solusi**: Field yang required adalah:
  - Judul Survei (wajib)
  - Tujuan 1 (wajib)
  - Penutup (wajib)
  - Tahun (wajib)

## Test dengan CLI (Jika Web Form Tidak Bekerja):

```bash
# Buat test file
php test_konten.php

# Output akan menunjukkan:
# ✓ Record created successfully!
# ID: 9
# Total records: 7
```

## Database Schema:

Tabel: `konten_surveis`
```
- id (primary key)
- judul (required)
- pendahuluan (nullable)
- indikator (nullable)
- deskripsi_survei (nullable)
- tujuan_1 (required)
- tujuan_2 (nullable)
- tujuan_3 (nullable)
- penutup (required)
- tahun (required)
- is_active (boolean, default: 0)
- created_at
- updated_at
```

## Tips:
1. Setiap field di form sudah link ke database column dengan benar
2. Validation rules sudah sesuai dengan requirement
3. CSRF token sudah ada di form (via @csrf)
4. Hidden field untuk checkbox memastikan is_active selalu dikirim

Semua seharusnya sudah bekerja dengan baik sekarang! 🎉
