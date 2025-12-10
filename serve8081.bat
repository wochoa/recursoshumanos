@echo off
REM Validar si el puerto 8080 está libre
netstat -aon | findstr :8080 >nul
IF %ERRORLEVEL% EQU 0 (
    echo ⚠️ El puerto 8080 ya está en uso. Cierra el servicio o elige otro puerto.
    pause
    exit /b
)

REM Ejecutar Laravel en el puerto 8080
php artisan serve --port=8080