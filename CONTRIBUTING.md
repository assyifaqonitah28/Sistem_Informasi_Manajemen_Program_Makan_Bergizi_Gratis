# Panduan Kontribusi - Sistem MBG

Terima kasih atas kontribusi Anda! Silakan ikuti panduan ini untuk memastikan kolaborasi berjalan lancar.

## 📋 Persyaratan

- PHP 8.2+
- Composer 2.7+
- Node.js 20+ & NPM 10+
- MySQL 8.0+
- Git 2.40+

## 🚀 Setup Lokal

```bash
# 1. Clone repository
git clone https://github.com/assyifaqonitah28/Sistem_Informasi_Manajemen_Program_Makan_Bergizi_Gratis.git
cd mbg-system

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi database di .env
# DB_DATABASE=mbg_system
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Jalankan migration & seeder
php artisan migrate:fresh --seed

# 6. Build assets
npm run build

# 7. Jalankan server
php artisan serve
```
