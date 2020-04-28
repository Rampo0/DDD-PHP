@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../phalcon/migrations/phalcon-migrations
php "%BIN_TARGET%" %*
