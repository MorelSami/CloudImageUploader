#!bin/bash
echo 'Run Rubke App Uploader (back-end) ...'
docker build -t rukbe/api . 
#docker run -d -p 8086:8086 -e APP_NAME="Rukbe Image Uploader' -e APP_ENV=development -v /home/msami/workspace/RukbeChallenge:/var/www/app --restart=always --name=rukbe-api rukbe/api:latest
docker run -d -p 8086:8086 -e APP_NAME=Rukbe-Image-Uploader -e APP_ENV=development -e APP_URL=http://localhost:8086 --restart=always --name=rukbe-api rukbe/api:latest
#echo 'Run Rubke Uploader (front-end) ...'
docker build -t rukbe/front img-uploader/
#docker run -d -p 3000:3000 -v /home/msami/workspace/RukbeChallenge/img-uploader:/src --restart=always --name=rukbe-front rukbe/front:latest 
docker run -d -p 3000:3000 -e UPLOADER_API = http://localhost:8086/server.php --restart=always --name=rukbe-front rukbe/front:latest
