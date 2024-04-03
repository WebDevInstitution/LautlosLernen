@echo off
echo +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
echo +++++++++ Welcome to the LautlosLernen installation script ++++++++++
echo +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
echo.
echo.

:check_wsl2
ver > nul
if %ERRORLEVEL% NEQ 0 (
    echo WSL 2 requires Windows 10 version 1903 or higher.
    echo Please make sure you have the required Windows version installed.
    goto :end
)

wsl --list > nul 2>&1
if %ERRORLEVEL% NEQ 0 (
    echo WSL 2 is not installed.
    echo Please install WSL 2 and then rerun this script.
    goto :end
)

echo WSL 2 is installed.
echo.

:input
set /p docker_installed="Do you have installed Docker Desktop (y/n)? "

if /i "%docker_installed%"=="n" (
    echo You need to install Docker Desktop.
    echo Opening https://www.docker.com/products/docker-desktop/ ...
    start "" "https://www.docker.com/products/docker-desktop/"
    goto :end
) else if /i "%docker_installed%"=="y" (
    echo Perfect. The Docker will be set up now.
    docker-compose up
    goto :end
) else (
    echo Input not valid, please enter 'y' for yes or 'n' for no.
    goto :input
)

:end
