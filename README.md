# Company Profile CMS
Sistem CMS untuk mengelola website profil perusahaan dengan panel admin.

## 🛠️ Tech Stack

- **Backend:** Laravel 11, PHP 8.4
- **Database:** MySQL 8.0
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
### 6. Demo
```
Login pada http://127.0.0.1:8000/login

Email: super@admin.com

Password: 123123123

```


