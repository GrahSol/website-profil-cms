# Company Profile CMS

Sistem CMS lengkap untuk mengelola website profil perusahaan dengan panel admin yang powerful.

## ✨ Fitur Utama

- **Panel Admin** - Kontrol penuh atas konten website
- **Manajemen Multi-modul** - Statistik, Produk, Tim, Testimoni, dll
- **Role-based Access Control** - Super Admin, Admin, dan User
- **Sistem Upload File** - Manajemen gambar dan dokumen
- **Responsive Design** - Berfungsi di semua perangkat

## 🛠️ Tech Stack

- **Backend:** Laravel 11, PHP 8.4
- **Frontend:** Blade, Tailwind CSS, JavaScript
- **Database:** MySQL
- **Authentication:** Laravel Breeze
- **Authorization:** Spatie Laravel Permission

## 🚀 Instalasi Cepat

### 1. Clone & Install
```bash
git clone https://github.com/yourusername/company-profile-cms.git
cd company-profile-cms
composer install
npm install
2. Setup Environment
bash
cp .env.example .env
php artisan key:generate
3. Setup Database
Edit file .env:

env
DB_DATABASE=company_profile_cms
DB_USERNAME=root
DB_PASSWORD=
4. Jalankan Migrasi
bash
php artisan migrate:fresh --seed
php artisan storage:link
5. Mulai Development
bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
6. Akses Aplikasi
URL: http://localhost:8000

Login Admin:

Email: super@admin.com

Password: 123123123


