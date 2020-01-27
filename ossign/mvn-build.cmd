@echo off
call ./env.cmd
call mvn clean
call mvn install -Dmaven.test.skip
if '%1' equ '' pause