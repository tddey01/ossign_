@echo off
set JAVA_HOME=C:\Program Files\Java\jdk1.8.0_181
set JRE_HOME=C:\Program Files\Java\jdk1.8.0_181\jre
set CLASSPATH=.;%JAVA_HOME%\lib;%JAVA_HOME%\lib\tools.jar

set M2_HOME=D:\Program Files\apache-maven-3.6.1

set PATH=.;%JAVA_HOME%\bin;%M2_HOME%\bin;%PATH%

echo BIM_HOME=%BIM_HOME%