@echo off
setlocal

set NODE_VERSION=22.11.0
set NODE_DIR=node-v%NODE_VERSION%-win-x64
set NODE_ZIP=%NODE_DIR%.zip
set NODE_URL=https://nodejs.org/dist/v%NODE_VERSION%/%NODE_ZIP%

if not exist node.exe (
    echo Node.js not found. Downloading Node.js %NODE_VERSION%...

    curl -L -o %NODE_ZIP% %NODE_URL%
    if errorlevel 1 (
        echo Failed to download Node.js
        pause
        exit /b 1
    )

    tar -xf %NODE_ZIP%
    if errorlevel 1 (
        echo Failed to extract Node.js
        pause
        exit /b 1
    )

    copy "%NODE_DIR%\node.exe" .
    if errorlevel 1 (
        echo Failed to copy node.exe
        pause
        exit /b 1
    )

    rmdir /s /q "%NODE_DIR%"
    del %NODE_ZIP%

    echo Node.js installed locally.
)

echo Starting HTTP shim...
node.exe httpShim.js

pause
