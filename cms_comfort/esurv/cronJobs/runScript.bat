@echo off
cd /d C:\wamp64\www\cms_comfort\24server

git clean -df
timeout /t 10
git pull
timeout /t 20


cd /d C:\wamp64\www\cms_comfort\24server\backend
npm install
timeout /t 60

cd /d C:\wamp64\www\cms_comfort\24server\dvrhealth
npm install
timeout /t 100