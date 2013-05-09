@ECHO OFF 
set listFile=list.tmp 
del "%listFile%" /q 1>nul 2>nul 
dir *.html /a /b>>"%listFile%" 
FOR /F "tokens=*" %%a IN ( 
'more "%listFile%"' 
) DO ( 
ren "%%a" "%%~na.php" 
) 
del "%listFile%" /q 1>nul 2>nul 
PAUSE