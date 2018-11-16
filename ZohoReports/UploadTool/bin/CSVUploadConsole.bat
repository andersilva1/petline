rem $Id$
@echo off

if (%1) == () goto usage_error
if (%2) == () goto usage_error
if (%3) == () goto usage_error
if (%4) == () goto usage_error

set authOpt=-A
set dbOwnOpt=-D
if (%6) == (%authOpt%) if (%7) == () goto usage_error_missing_authtoken
if (%8) == (%dbOwnOpt%) if (%9) == () goto usage_error_missing_dbowner
if (%7) == (%dbOwnOpt%) if (%8) == () goto usage_error_missing_dbowner

cd %~dp0%\..

call bin\setEnv.bat

cd bin

"%JAVA_HOME%\bin\java"   %JAVA_OPTS%  com.adventnet.zoho.client.report.tool.CSVUploader %*

goto end_of_page

:usage_error_missing_authtoken
echo "Missing Authtoken"
goto usage_error

:usage_error_missing_dbowner
echo "Missing DBOwner"
goto usage_error

:usage_error
echo "Too few parameters"
echo "Usage: CSVUploadConsole.bat <file_name> <database_name> <table_name> <APPEND/UPDATEADD/TRUNCATEADD> [userEmailAddress] [<-A AuthToken>/<Password>] [-D DBOwner]"
   echo "Examples:"
   echo ""
   echo "        CSVUploadConsole.bat <File> <DatabaseName> <TableName> [APPEND/UPDATEADD/TRUNCATEADD] <userEmailAddress> -A <AuthToken>"
   echo "        CSVUploadConsole.bat <File> <DatabaseName> <TableName> [APPEND/UPDATEADD/TRUNCATEADD] <userEmailAddress> -A <AuthToken> -D <DBOwner>"
   echo "        CSVUploadConsole.bat <File> <DatabaseName> <TableName> [APPEND/UPDATEADD/TRUNCATEADD] <userEmailAddress> <Password>"
   echo "        CSVUploadConsole.bat <File> <DatabaseName> <TableName> [APPEND/UPDATEADD/TRUNCATEADD] <userEmailAddress> <Password> -D <DBOwner>"
   echo "        CSVUploadConsole.bat <File> <DatabaseName> <TableName> [APPEND/UPDATEADD/TRUNCATEADD]"
   echo ""
:end_of_page
