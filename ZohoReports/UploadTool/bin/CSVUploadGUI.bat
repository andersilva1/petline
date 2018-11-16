rem $Id$

cd %~dp0%\..

call bin\setEnv.bat

cd bin

"%JAVA_HOME%\bin\java" %JAVA_OPTS%  com.adventnet.zoho.client.report.tool.InputGUI %*

  
