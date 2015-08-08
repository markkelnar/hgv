@IF EXIST "%~dp0\node.exe" (
  "%~dp0\node.exe"  "%~dp0\lib\start.js" %*
) ELSE (
  @SETLOCAL
  @SET PATHEXT=%PATHEXT:;.JS;=;%
  node  "%~dp0\lib\start.js" %*
)