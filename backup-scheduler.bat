@echo off
echo Starting Backup Scheduler...
echo Press Ctrl+C to stop

:loop
echo.
echo [%date% %time%] Running backup check...
php artisan backup:auto
timeout /t 60 /nobreak >nul
goto loop