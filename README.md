# 🎓 Aplikasi Kursus Online

Aplikasi kursus online berbasis web yang dibangun menggunakan **Laravel**, dirancang untuk memudahkan pengguna dalam mengakses berbagai materi pembelajaran secara daring. Proyek ini juga dilengkapi dengan sistem manajemen kursus untuk admin, integrasi pembayaran, dan performa yang optimal berkat caching.

---

## 🚀 Fitur Utama

- Autentikasi pengguna (register, login)
- Halaman kursus dinamis berbasis template **Educore**
- Dashboard admin berbasis template **Tabler**
- Pengelolaan kursus, kategori, user, dan transaksi
- Integrasi pembayaran dengan **Midtrans** dan **PayPal**
- AJAX untuk pengalaman pengguna yang lebih responsif
- Redis untuk caching dan peningkatan performa
- Tabel data interaktif menggunakan **Yajra DataTables**

---

## 🛠️ Teknologi yang Digunakan

| Teknologi | Fungsi |
|----------|--------|
| **Laravel** | Backend framework |
| **MySQL** | Database |
| **Educore** | Template frontend kursus |
| **Tabler** | Template admin panel |
| **AJAX** | Komunikasi asinkron |
| **Redis** | Caching |
| **Midtrans** | Gateway pembayaran (Indonesia) |
| **PayPal** | Gateway pembayaran (Internasional) |
| **Yajra DataTables** | Plugin Laravel untuk DataTables |

---

## ⚙️ Instalasi & Setup

### 1. Clone Repository

```bash
git clone https://github.com/hafid-js/kursus-online.git
cd kursus-online

composer install
npm install && npm run dev

cp .env.example .env
php artisan key:generate

php artisan migrate --seed

php artisan serve
