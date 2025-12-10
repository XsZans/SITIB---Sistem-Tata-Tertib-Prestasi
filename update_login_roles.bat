@echo off
echo ========================================
echo    Update MySQL Roles and Login Form
echo ========================================
echo.

echo 1. Checking and updating MySQL roles...
php check_mysql_roles.php
echo.

echo 2. Running migration...
php artisan migrate --force
echo.

echo 3. Running seeder...
php artisan db:seed --force
echo.

echo ========================================
echo    Update Complete!
echo ========================================
echo.
echo New Login Credentials:
echo - Kepala Sekolah: kepsek / kepsek123
echo - Orang Tua: ortu / ortu123
echo - Siswa: siswa001 / siswa123
echo.
pause