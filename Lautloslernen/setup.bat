@echo off
set /p wsl=Ist WSL2 installiert? (j/n): 
set wsl=%wsl:~0,1%
set wsl=%wsl:lcase%

if "%wsl%"=="j" (
    docker-compose up
) else (
    set /p install=WSL2 ist nicht installiert. Möchtest du es installieren? (j/n): 
    set install=%install:~0,1%
    set install=%install:lcase%
    if "%install%"=="j" (
        wsl --install
        echo.
        echo Docker wird aufgesetzt.
        docker-compose up
    ) else (
        echo Abbruch.
        exit
    )
)
