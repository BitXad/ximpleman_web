@echo off
setlocal
cd /d "%~dp0"
echo ================================================
echo  Instalador FPDI + FPDF para Ximpleman
 echo ================================================
if not exist "application\third_party" mkdir "application\third_party"
set "TMPDIR=%TEMP%\ximpleman_fpdi_install"
if exist "%TMPDIR%" rmdir /s /q "%TMPDIR%"
mkdir "%TMPDIR%"
echo Descargando FPDF oficial...
powershell -NoProfile -ExecutionPolicy Bypass -Command "$ProgressPreference='SilentlyContinue'; Invoke-WebRequest -Uri 'https://github.com/Setasign/FPDF/archive/refs/heads/master.zip' -OutFile '%TMPDIR%\fpdf.zip'"
if errorlevel 1 goto ERROR
echo Descargando FPDI oficial...
powershell -NoProfile -ExecutionPolicy Bypass -Command "$ProgressPreference='SilentlyContinue'; Invoke-WebRequest -Uri 'https://github.com/Setasign/FPDI/archive/refs/heads/master.zip' -OutFile '%TMPDIR%\fpdi.zip'"
if errorlevel 1 goto ERROR
powershell -NoProfile -ExecutionPolicy Bypass -Command "Expand-Archive -Force '%TMPDIR%\fpdf.zip' '%TMPDIR%\fpdf'; Expand-Archive -Force '%TMPDIR%\fpdi.zip' '%TMPDIR%\fpdi'"
if errorlevel 1 goto ERROR
if exist "application\third_party\fpdf" rmdir /s /q "application\third_party\fpdf"
if exist "application\third_party\fpdi" rmdir /s /q "application\third_party\fpdi"
for /d %%D in ("%TMPDIR%\fpdf\FPDF-*") do xcopy /E /I /Y "%%~fD" "application\third_party\fpdf" >nul
for /d %%D in ("%TMPDIR%\fpdi\FPDI-*") do xcopy /E /I /Y "%%~fD" "application\third_party\fpdi" >nul
if not exist "application\third_party\fpdf\fpdf.php" goto ERROR
if not exist "application\third_party\fpdi\src\autoload.php" goto ERROR
rmdir /s /q "%TMPDIR%"
echo.
echo INSTALACION CORRECTA.
echo Ya puede usar: Factura - Acciones masivas - Un solo PDF.
echo.
pause
exit /b 0
:ERROR
echo.
echo ERROR: No se pudo instalar FPDI/FPDF.
echo Verifique conexion a Internet y permisos de escritura.
echo No se modifico ninguna otra funcion de Ximpleman.
pause
exit /b 1
