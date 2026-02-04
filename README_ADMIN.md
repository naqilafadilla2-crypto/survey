# Informasi Login Admin

## Kredensial Default

Setelah menjalankan seeder, admin dapat login dengan kredensial berikut:

- **Email**: `admin@bakti.go.id`
- **Password**: `admin123`

## Cara Membuat User Admin

### Metode 1: Menggunakan Seeder (Recommended)

Jalankan perintah berikut untuk membuat user admin:

```bash
php artisan db:seed --class=AdminSeeder
```

Atau jalankan semua seeder:

```bash
php artisan db:seed
```

### Metode 2: Menggunakan Tinker

Jalankan perintah berikut:

```bash
php artisan tinker
```

Kemudian jalankan:

```php
App\Models\User::create([
    'name' => 'Administrator',
    'email' => 'admin@bakti.go.id',
    'password' => Hash::make('admin123'),
    'email_verified_at' => now(),
]);
```

### Metode 3: Menggunakan Artisan Command (Recommended)

Buat user admin dengan perintah interaktif:

```bash
php artisan admin:create
```

Atau dengan parameter langsung:

```bash
php artisan admin:create --email=admin2@bakti.go.id --name="Admin 2" --password=password123
```

## Keamanan

**PENTING**: Setelah login pertama kali, segera ubah password default untuk keamanan!

Untuk mengubah password, login sebagai admin dan gunakan fitur change password (jika tersedia) atau update langsung melalui database/tinker.

## Akses Dashboard Admin

Setelah login, admin dapat mengakses:

- Dashboard: `/admin/dashboard`
- Kelola Konten Survei: `/admin/konten-survei`
- Lihat Detail Survei: `/admin/survei/{id}`
