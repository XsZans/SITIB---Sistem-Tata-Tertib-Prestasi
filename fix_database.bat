@echo off
echo ========================================
echo    Fix Database SiTib
echo ========================================
echo.

echo 1. Checking database connection...
php check_database.php
echo.

echo 2. Running migrations if needed...
php artisan migrate --force
echo.

echo 3. Running seeders if needed...
php artisan db:seed --force
echo.

echo 4. Checking final result...
php check_database.php
echo.

echo ========================================
echo    Database Fix Complete!
echo ========================================
pause