# Tugas: CRUD User & Hobi (Blade + REST API + JWT Authentication)

Aplikasi Laravel yang mengimplementasikan CRUD untuk data **User** yang berelasi **one-to-many** dengan data **Hobi (Hobby)**, dilengkapi antarmuka web (Blade) dan REST API yang diamankan menggunakan JWT Authentication.

---

## Fitur Utama

### 1. Web (Blade UI)
- **Autentikasi (Session):**
  - Register akun baru (`/register`).
  - Login (`/login`) & Logout (`/logout`).
  - Halaman tamu dialihkan ke login saat mengakses rute terproteksi.
- **Kelola User (`/users`):**
  - Daftar semua user beserta daftar hobi masing-masing.
  - Tambah user baru sekaligus input banyak hobi secara dinamis (tombol *Tambah Hobi* via JavaScript).
  - Edit user (nama, email, opsi ganti password) dan perbarui daftar hobinya.
  - Hapus user (hobi terkait ikut terhapus otomatis/cascade).
  - Pagination & alert status aksi.
- **Kelola Hobi (`/hobbies`):**
  - CRUD hobi milik user yang sedang login.

### 2. REST API (JSON)
- **Autentikasi JWT (`tymon/jwt-auth`):**
  - `POST /api/register` — registrasi, mengembalikan token JWT.
  - `POST /api/login` — login dengan email & password, mengembalikan token JWT.
  - `POST /api/logout` — invalidasi token (butuh header `Authorization: Bearer <token>`).
  - Respons 401 jelas jika token tidak ada, salah, atau kedaluwarsa:
    ```json
    {"message": "Belum login atau token tidak valid/kedaluwarsa."}
    ```
- **CRUD User API (`/api/users`):**
  - `GET /api/users` — daftar profil (terproteksi JWT).
  - `GET /api/users/{user}` — detail profil pemilik token.
  - `PUT /api/users/{user}` — update profil pemilik token.
  - `DELETE /api/users/{user}` — hapus akun pemilik token.
- **CRUD Hobi API (`/api/users/{user}/hobbies`):**
  - `GET /api/users/{user}/hobbies` — daftar hobi user.
  - `POST /api/users/{user}/hobbies` — tambah hobi untuk user.
  - `GET /api/users/{user}/hobbies/{hobby}` — detail hobi.
  - `PUT /api/users/{user}/hobbies/{hobby}` — update hobi.
  - `DELETE /api/users/{user}/hobbies/{hobby}` — hapus hobi.

---

## Kebutuhan Sistem

- PHP `>= 8.2` (disarankan PHP 8.4)
- Composer
- MySQL / MariaDB (misal via Laragon)
- Ekstensi PHP: `pdo_mysql`, `openssl`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`

---

## Panduan Instalasi & Menjalankan

1. **Clone repository:**
   ```bash
   git clone <url-repository>
   cd laravel
   ```

2. **Install dependency:**
   ```bash
   composer install
   ```

3. **Konfigurasi Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Sesuaikan koneksi database di file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=svd
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate JWT Secret:**
   ```bash
   php artisan jwt:secret
   ```

5. **Jalankan Migrasi:**
   ```bash
   php artisan migrate
   ```

6. **Jalankan Server Development:**
   ```bash
   php artisan serve
   ```
   Aplikasi dapat diakses di `http://127.0.0.1:8000`.

---

## Daftar Rute

### Web (Blade)
| Method | URI | Nama Route | Keterangan |
|---|---|---|---|
| GET | `/login` | `login` | Form login |
| POST | `/login` | `login.store` | Proses login |
| GET | `/register` | `register` | Form register |
| POST | `/register` | `register.store` | Proses register |
| POST | `/logout` | `logout` | Logout |
| GET | `/users` | `web.users.index` | Tabel user & daftar hobi |
| GET | `/users/create` | `web.users.create` | Form tambah user + input hobi |
| POST | `/users` | `web.users.store` | Simpan user & hobi |
| GET | `/users/{user}/edit` | `web.users.edit` | Form edit user & hobi |
| PUT | `/users/{user}` | `web.users.update` | Perbarui user & hobi |
| DELETE | `/users/{user}` | `web.users.destroy` | Hapus user & hobinya |
| GET | `/hobbies` | `hobbies.index` | Daftar hobi user aktif |
| GET | `/hobbies/create` | `hobbies.create` | Form tambah hobi |
| POST | `/hobbies` | `hobbies.store` | Simpan hobi baru |
| GET | `/hobbies/{hobby}/edit` | `hobbies.edit` | Form edit hobi |
| PUT | `/hobbies/{hobby}` | `hobbies.update` | Perbarui hobi |
| DELETE | `/hobbies/{hobby}` | `hobbies.destroy` | Hapus hobi |

### API (JSON, Base: `/api`)
| Method | URI | Auth | Keterangan |
|---|---|---|---|
| POST | `/api/register` | Publik | Register via API |
| POST | `/api/login` | Publik | Login, mengembalikan token JWT |
| POST | `/api/logout` | `Bearer <token>` | Logout & invalidasi token |
| GET | `/api/users` | `Bearer <token>` | Lihat profil pemilik token |
| GET | `/api/users/{user}` | `Bearer <token>` | Detail profil |
| PUT | `/api/users/{user}` | `Bearer <token>` | Update profil |
| DELETE | `/api/users/{user}` | `Bearer <token>` | Hapus akun |
| GET | `/api/users/{user}/hobbies` | `Bearer <token>` | Daftar hobi user |
| POST | `/api/users/{user}/hobbies` | `Bearer <token>` | Tambah hobi |
| GET | `/api/users/{user}/hobbies/{hobby}` | `Bearer <token>` | Detail hobi |
| PUT | `/api/users/{user}/hobbies/{hobby}` | `Bearer <token>` | Update hobi |
| DELETE | `/api/users/{user}/hobbies/{hobby}` | `Bearer <token>` | Hapus hobi |

---

## Contoh Pengujian API (cURL / Postman)

### 1. Login untuk Mendapatkan Token
```bash
curl -X POST http://127.0.0.1:8000/api/login \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{"email":"budi@example.test","password":"password123"}'
```
Respons:
```json
{
  "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
}
```

### 2. Akses Endpoint Terproteksi
```bash
curl -X GET http://127.0.0.1:8000/api/users \
  -H "Authorization: Bearer <TOKEN_ANDA>" \
  -H "Accept: application/json"
```

---

## Menjalankan Pengujian Otomatis (Tests)

Proyek ini dilengkapi test suite (23 tests, 91 assertions) yang mencakup:
- Web User CRUD (form, hobi dinamis, cascade delete, proteksi auth).
- Web Hobby CRUD.
- API Authentication & JWT (format 401 saat token absen/salah, proteksi profil).
- API User & Hobby CRUD.

Jalankan pengujian:
```bash
php artisan test
```

---

## Dokumentasi Tambahan

- [CRUD-COMPLETENESS-CHECK.md](./CRUD-COMPLETENESS-CHECK.md) — Matriks pemenuhan spesifikasi soal tugas.
- [DUAL-AUTH-EXPLAINED.md](./DUAL-AUTH-EXPLAINED.md) — Penjelasan arsitektur dual-auth (Session di Web vs JWT di API).
