#!bin/bash
echo 'Run Rubke App Uploader (back-end) ...'
docker build -t rukbe/api . 
docker run -d -p 8000:8000 --restart=always --name=rukbe-api rukbe/api:latest
#echo 'Run Rubke Uploader (front-end) ...'
#docker build -t rukbe/front . 
#docker run -d -p 3000:3000 --restart=always --name=rukbe-front rukbe/front:latest
