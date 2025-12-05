@echo off
echo ========================================
echo   Absher Project - Quick Setup
echo ========================================
echo.

echo [1/6] Installing Composer packages...
call composer require laravel/sanctum spatie/laravel-permission
if %errorlevel% neq 0 (
    echo ERROR: Composer install failed!
    pause
    exit /b 1
)

echo.
echo [2/6] Publishing vendor configs...
call php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider" --force
call php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --force

echo.
echo [3/6] Running migrations...
call php artisan migrate --force
if %errorlevel% neq 0 (
    echo ERROR: Migrations failed!
    pause
    exit /b 1
)

echo.
echo [4/6] Seeding database...
call php artisan db:seed --force
if %errorlevel% neq 0 (
    echo ERROR: Seeding failed!
    pause
    exit /b 1
)

echo.
echo [5/6] Clearing cache...
call php artisan config:clear
call php artisan cache:clear
call php artisan view:clear

echo.
echo [6/6] Installing NPM packages...
call npm install
if %errorlevel% neq 0 (
    echo ERROR: NPM install failed!
    pause
    exit /b 1
)

echo.
echo ========================================
echo   Setup Complete! 
echo ========================================
echo.
echo Run these commands in SEPARATE terminals:
echo   1. php artisan serve
echo   2. npm run dev
echo.
pause
