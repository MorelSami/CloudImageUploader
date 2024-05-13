#!bin/bash
echo 'Running Rubke App Uploader (back-end) ...'
docker build -t rukbe/api . 
docker run -d -p 8086:80 -p 8443:443 -v /$HOME/workspace/RukbeChallenge:/var/www/html --restart=always --name=rukbe-api rukbe/api:latest
#docker run -d -p 8086:80 -p 8443:443 --restart=always --name=rukbe-api rukbe/api:latest

echo 'Running Rubke App Uploader (front-end) ...'
docker build -t rukbe/front rukbe/
docker run -d -p 3000:3000 -v /$HOME/workspace/RukbeChallenge/rukbe:/src --restart=always --name=rukbe-front rukbe/front:latest 
#docker run -d -p 3000:3000 --restart=always --name=rukbe-front rukbe/front:latest
