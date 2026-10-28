# ⌚ Luxury Watch API — RESTful API Toko Jam Mewah

Layanan RESTful API mandiri berbasis **Laravel 12** dan **MySQL** untuk sistem manajemen katalog Toko Jam Mewah (*Luxury Watch Store*). API ini dilengkapi dengan dokumentasi interaktif **Scramble** di `/docs/api`, validasi request yang ketat, standarisasi respons JSON berbasis `JsonResource` berformat amplop (`message` & `data`), serta siap dideploy (*production ready*) ke cloud platform (seperti Render, Railway, Fly.io, atau Docker).

---

## 🚀 Fitur Utama

- **Framework**: Laravel 12.x (PHP 8.3+)
- **Database**: MySQL 8.x
- **Standarisasi JSON**: Envelope format (`message` & `data`) menggunakan Laravel `JsonResource`
- **Validasi Ketat**: Menggunakan `FormRequest` (`StoreWatchRequest` & `UpdateWatchRequest`) dengan pesan validasi berbahasa Indonesia
- **Dokumentasi Interaktif**: Terintegrasi otomatis dengan [Scramble](https://scramble.dedoc.co) di `/docs/api` tanpa perlu menulis OpenAPI spec manual
- **Cloud & Container Ready**: Dilengkapi `Dockerfile`, `docker-compose.yml`, `render.yaml`, dan `Procfile`
- **Testing**: 10 Unit/Feature Tests mencakup seluruh skenario CRUD, validasi, dan dokumentasi API

---

## 📋 Struktur Data Entitas (`koleksi_jam` / `watches`)

| Kolom | Tipe Data | Keterangan / Contoh |
| :--- | :--- | :--- |
| `id` | BigInteger (PK) | Auto increment identifier |
| `nama` | String (255) | Contoh: *Rolex Submariner Date* |
| `brand` | String (100) | Contoh: *Rolex*, *Patek Philippe*, *Audemars Piguet* |
| `harga` | Unsigned BigInteger | Contoh: `250000000` (Rp 250.000.000) |
| `tahun_rilis` | Integer | Contoh: `2023` |
| `tipe_gerakan` | Enum (`Automatic`, `Manual`, `Quartz`) | Contoh: `Automatic` |
| `material` | String (100) | Contoh: *Oystersteel*, *Gold 18k*, *Platinum* |
| `status` | Enum (`tersedia`, `terjual`) | Contoh: `tersedia` |
| `foto` | Text (URL) | URL gambar jam beresolusi tinggi |
| `created_at` | Timestamp | Waktu pembuatan data |
| `updated_at` | Timestamp | Waktu terakhir modifikasi |

---

## 📌 Daftar 5 Endpoint CRUD Wajib

| Method | Endpoint | Deskripsi | Status Sukses |
| :--- | :--- | :--- | :--- |
| **GET** | `/api/jam-tangan` | Mengambil seluruh koleksi jam tangan mewah | `200 OK` |
| **GET** | `/api/jam-tangan/{id}` | Mengambil detail 1 jam tangan berdasarkan ID | `200 OK` |
| **POST** | `/api/jam-tangan` | Menambahkan jam tangan baru (dengan validasi) | `201 Created` |
| **PUT/PATCH** | `/api/jam-tangan/{id}` | Memperbarui data jam tangan tersimpan | `200 OK` |
| **DELETE** | `/api/jam-tangan/{id}` | Menghapus data jam tangan dari basis data | `200 OK` |

### 📖 Dokumentasi Interaktif
- **UI Dokumentasi Interaktif**: `http://localhost:8000/docs/api`
- **OpenAPI 3.1 Spec JSON**: `http://localhost:8000/docs/api.json`

---

## 📦 Contoh Format Respons JSON (Standar Amplop)

### 1. GET `/api/jam-tangan` (200 OK)
```json
{
  "message": "Daftar koleksi jam mewah berhasil diambil",
  "data": [
    {
      "id": 1,
      "nama": "Rolex Submariner Date",
      "brand": "Rolex",
      "harga": 250000000,
      "tahun_rilis": 2023,
      "tipe_gerakan": "Automatic",
      "material": "Oystersteel",
      "status": "tersedia",
      "foto": "https://images.unsplash.com/photo-1523275335684-37898b6baf30"
    }
  ]
}
```

### 2. GET `/api/jam-tangan/{id}` (200 OK)
```json
{
  "message": "Detail jam mewah berhasil diambil",
  "data": {
    "id": 1,
    "nama": "Rolex Submariner Date",
    "brand": "Rolex",
    "harga": 250000000,
    "tahun_rilis": 2023,
    "tipe_gerakan": "Automatic",
    "material": "Oystersteel",
    "status": "tersedia",
    "foto": "https://images.unsplash.com/photo-1523275335684-37898b6baf30"
  }
}
```

### 3. POST `/api/jam-tangan` (201 Created)
**Request Body:**
```json
{
  "nama": "Patek Philippe Nautilus 5711/1R",
  "brand": "Patek Philippe",
  "harga": 1450000000,
  "tahun_rilis": 2022,
  "tipe_gerakan": "Automatic",
  "material": "Rose Gold 18k",
  "status": "tersedia",
  "foto": "https://images.unsplash.com/photo-1547996160-71dfa470d475"
}
```
**Respons (201 Created):**
```json
{
  "message": "Data jam mewah berhasil ditambahkan",
  "data": {
    "id": 2,
    "nama": "Patek Philippe Nautilus 5711/1R",
    "brand": "Patek Philippe",
    "harga": 1450000000,
    "tahun_rilis": 2022,
    "tipe_gerakan": "Automatic",
    "material": "Rose Gold 18k",
    "status": "tersedia",
    "foto": "https://images.unsplash.com/photo-1547996160-71dfa470d475"
  }
}
```

### 4. PUT/PATCH `/api/jam-tangan/{id}` (200 OK)
**Request Body (PATCH):**
```json
{
  "status": "terjual"
}
```
**Respons (200 OK):**
```json
{
  "message": "Data jam mewah berhasil diperbarui",
  "data": {
    "id": 2,
    "nama": "Patek Philippe Nautilus 5711/1R",
    "brand": "Patek Philippe",
    "harga": 1450000000,
    "tahun_rilis": 2022,
    "tipe_gerakan": "Automatic",
    "material": "Rose Gold 18k",
    "status": "terjual",
    "foto": "https://images.unsplash.com/photo-1547996160-71dfa470d475"
  }
}
```

### 5. DELETE `/api/jam-tangan/{id}` (200 OK)
```json
{
  "message": "Data jam mewah berhasil dihapus",
  "data": null
}
```

### 6. Error Respons (404 Not Found)
```json
{
  "message": "Data jam mewah tidak ditemukan",
  "data": null
}
```

---

## 🛠️ Panduan Menjalankan di Lokal (Laragon)

### 1. Konfigurasi Environment (`.env`)
Pastikan MySQL di Laragon aktif dan buat basis data `toko_jam_mewah`:
```sql
CREATE DATABASE toko_jam_mewah CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Pengaturan `.env`:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=toko_jam_mewah
DB_USERNAME=root
DB_PASSWORD=
```

### 2. Jalankan Migrasi & Seeder
```bash
php artisan migrate --seed
```

### 3. Jalankan Server Lokal
```bash
php artisan serve
```
Akses API di `http://127.0.0.1:8000/api/jam-tangan` dan dokumentasi di `http://127.0.0.1:8000/docs/api`.

### 4. Menjalankan Automated Tests
```bash
php artisan test --filter=WatchApiTest
```

---

## 🐳 Menjalankan dengan Docker Compose

Jika Anda ingin menjalankan aplikasi lengkap dengan container MySQL:
```bash
docker compose up -d --build
```
Aplikasi akan langsung berjalan di `http://localhost:8000` dengan database MySQL di port `3307`.

---

## ☁️ Panduan Deploy ke Cloud

### Opsi A: Deploy ke Render (Free Docker Web Service)
1. Push repositori ini ke GitHub / GitLab.
2. Buka dashboard [Render.com](https://render.com) -> Klik **New +** -> **Blueprint**.
3. Hubungkan repositori GitHub Anda. Render akan membaca konfigurasi `render.yaml` secara otomatis, menyiapkan instance MySQL gratis dan container web.
4. Aplikasi akan live dengan URL HTTPS seperti `https://luxury-watch-api.onrender.com/docs/api`.

### Opsi B: Deploy ke Railway
1. Buat project baru di [Railway.app](https://railway.app).
2. Tambahkan database **MySQL**.
3. Deploy dari repositori GitHub. Railway akan otomatis mendeteksi `Dockerfile` atau PHP Nixpacks.
4. Atur Environment Variables (`DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, `RUN_MIGRATIONS=true`, `APP_KEY`).

---

## 📬 Postman Collection

File koleksi Postman telah disertakan: [`luxury_watch_api.postman_collection.json`](./luxury_watch_api.postman_collection.json).
Cukup buka aplikasi Postman -> Klik **Import** -> Pilih file tersebut. Variabel `base_url` sudah otomatis diset ke `http://127.0.0.1:8000`.
