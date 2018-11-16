
set TOOL_HOME=%cd%

set JAVA_HOME=%TOOL_HOME%\jre

set CLASSPATH=%TOOL_HOME%\lib\commons-httpclient-3.1.jar;%TOOL_HOME%\lib\commons-logging-api.jar;%TOOL_HOME%\lib\commons-codec-1.7.jar;%TOOL_HOME%\lib\csv.jar;%TOOL_HOME%\lib\ZohoReportAPIClient.jar;%TOOL_HOME%\lib\ZohoReportUploadTool.jar

set JAVA_OPTS=-DCONFFILE=conf\common_params.conf -DTOOLHOME=%TOOL_HOME% -Djava.util.logging.config.file=%TOOL_HOME%\conf\logging.properties

set JAVA_OPTS=%JAVA_OPTS% -XX:NewSize=48M -Xmx512M


IF NOT EXIST logs mkdir logs
