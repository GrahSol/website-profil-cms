# Company Profile CMS
Sistem CMS lengkap untuk mengelola website profil perusahaan dengan panel admin yang powerful.

## ✨ Fitur Utama

- **Panel Administrasi:** Antarmuka terpusat untuk mengelola seluruh konten website secara intuitif.
- **Manajemen Konten Dinamis:** Fungsionalitas CRUD (Create, Read, Update, Delete) penuh untuk berbagai modul konten.
- **Kontrol Akses Berbasis Peran (RBAC):** Sistem otorisasi yang fleksibel untuk menentukan hak akses pengguna

## 🛠️ Tech Stack

- **Backend:** Laravel 11, PHP 8.4
- **Frontend:** Blade, Tailwind CSS, JavaScript
- **Database:** MySQL
- **Authentication:** Laravel Breeze
- **Authorization:** Spatie Laravel Permission

## 🚀 Instalasi Cepat

### 1. Clone & Install Dependencies
```bash
git clone https://github.com/GrahSol/company-profile-cms.git
cd company-profile-cms
composer install
npm install
```
### 2. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Setup Database
Edit file .env:

```env
DB_DATABASE=company_profile_cms
DB_USERNAME=root
DB_PASSWORD=
```
### 4. Migrasi Database
```bash
php artisan migrate:fresh --seed
php artisan storage:link

```
### 5. Development Server
```bash
# Terminal 1 - Backend Server
php artisan serve

# Terminal 2 - Frontend Assets (Development)
npm run dev

```
### 6. Akses Aplikasi
```
Login Admin:

Email: super@admin.com

Password: 123123123
