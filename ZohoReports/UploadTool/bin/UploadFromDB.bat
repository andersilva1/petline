rem $Id$

@echo off

set authOpt=-A
set dbOwnOpt=-D
set modeOpt=-M

set oldOpt=old
set newOpt=new

if not (%1) == () if (%2) == () goto usage_error

if (%3) == (%dbOwnOpt%) if (%4) == () goto dbowner_password_usage
if not (%2) == (%authOpt%) if not (%3) == () if not (%3) == (%dbOwnOpt%) if not (%3) == (%modeOpt%) goto usage_error
if (%3) == (%dbOwnOpt%) if not (%5) == () if not (%5) == (%modeOpt%) goto dbowner_password_usage

if (%2) == (%authOpt%) if (%3) == () goto usage_error
if (%2) == (%authOpt%) if not (%4) == () if not (%4) == (%dbOwnOpt%) if not (%4) == (%modeOpt%) goto dbowner_auth_usage_error
if (%4) == (%dbOwnOpt%) if (%5) == () goto dbowner_auth_usage_error
if (%4) == (%dbOwnOpt%) if not (%6) == () if not (%6) == (%modeOpt%) goto dbowner_auth_usage_error 

set toolVersion=new
set cmdLineArgs=%*
if (%1) == (%modeOpt%) if (%2) == (%oldOpt%) ( set toolVersion=%oldOpt% )
if (%3) == (%modeOpt%) if (%4) == (%oldOpt%) ( set toolVersion=%oldOpt% )
if (%4) == (%modeOpt%) if (%5) == (%oldOpt%) ( set toolVersion=%oldOpt% )
if (%5) == (%modeOpt%) if (%6) == (%oldOpt%) ( set toolVersion=%oldOpt% )
if (%6) == (%modeOpt%) if (%7) == (%oldOpt%) ( set toolVersion=%oldOpt% )

if (%1) == (%modeOpt%) ( set cmdLineArgs= )
if (%3) == (%modeOpt%) ( set cmdLineArgs=%1 %2 )
if (%4) == (%modeOpt%) ( set cmdLineArgs=%1 %2 %3 )
if (%5) == (%modeOpt%) ( set cmdLineArgs=%1 %2 %3 %4 )
if (%6) == (%modeOpt%) ( set cmdLineArgs=%1 %2 %3 %4 %5 )

cd %~dp0%\..

call bin\setEnv.bat

set TEMP_DIR=%TOOL_HOME%\temp

if exist %TEMP_DIR%\queryOutput_* (
del /F %TEMP_DIR%\queryOutput_* )

for /D %%f in (%TEMP_DIR%\Query_*) do rmdir %%f /S /Q
for /D %%f in (%TOOL_HOME%\logs\tmp_*) do rmdir %%f /S /Q

cd bin

set JAVA_OPTS=%JAVA_OPTS% -DCONN_PARAMS_FILE=conf\database_connection_params.conf -DIMPORT_OPTIONS_FILE=conf\database_sql_queries.xml  -DTEMP_DIR=%TEMP_DIR% -DTESTRUN=false

if %toolVersion% == %newOpt% ( "%JAVA_HOME%\bin\java" %JAVA_OPTS%  com.adventnet.zoho.client.report.advancedtool.ZohoReportUploadDataFromDB %cmdLineArgs% ) else ( "%JAVA_HOME%\bin\java" %JAVA_OPTS%  com.adventnet.zoho.client.report.tool.ZohoReportUploadDataFromDB %cmdLineArgs% )

goto end_of_page

:usage_error
echo "Usage  : %0 [userEmailAddress] [<-A authtoken>/<password>] [-D dbowner]"
echo "Example:"
echo ""
echo " %0 <userEmailAddress> <password>"
echo " %0 <userEmailAddress> <password> -D <dbowner>"
echo " %0 <userEmailAddress> -A <authtoken>"
echo " %0 <userEmailAddress> -A <authtoken> -D <dbowner>"
goto end_of_page

:dbowner_auth_usage_error
echo "Usage:  %0 <userEmailAddress> -A <authtoken> -D <dbowner>"
goto end_of_page

:dbowner_password_usage
echo "Usage:  %0 <userEmailAddress> <password> -D <dbowner>"
goto end_of_page

:end_of_page
