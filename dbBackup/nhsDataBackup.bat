@echo off

set datetime=%date:~10,4%%date:~4,2%%date:~7,2%

SET backupdir=C:\xampp\htdocs\lpnhs\dbBackup
SET mysqlusername=root
SET database=nhs_data

"C:\xampp\mysql\bin\mysqldump.exe" -u %mysqlusername% %database%> %backupdir%\%database%_%datetime%.sql