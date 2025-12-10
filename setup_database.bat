@echo off
echo ========================================
echo    Setup Database SiTib
echo ========================================
echo.

echo 1. Menjalankan migrations...
php artisan migrate:fresh
echo.

echo 2. Menjalankan seeders...
php artisan db:seed
echo.

echo 3. Membersihkan cache...
php artisan config:clear
php artisan cache:clear
php artisan view:clear
echo.

echo ========================================
echo    Setup Database Selesai!
echo ========================================
echo.
echo Default Users:
echo - Admin: admin / admin123
echo - Guru BK: guru_bk / gurubk123  
echo - Wali Kelas: wali_kelas / walikelas123
echo - Guru: guru / guru123
echo.
pause