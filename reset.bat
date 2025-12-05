@echo off
echo ========================================
echo   Absher - Full Reset
echo ========================================
echo.

echo [1/5] Stopping processes...
taskkill /F /IM node.exe >nul 2>&1

echo [2/5] Cleaning Laravel cache...
call php artisan cache:clear
call php artisan config:clear
call php artisan view:clear
call php artisan route:clear

echo [3/5] Removing old files...
if exist node_modules rmdir /s /q node_modules
if exist package-lock.json del /f package-lock.json
if exist public\build rmdir /s /q public\build

echo [4/5] Installing dependencies...
call npm install

echo [5/5] Done!
echo.
echo ========================================
echo  Run these commands in 2 terminals:
echo    1. npm run dev
echo    2. php artisan serve
echo ========================================
pause
