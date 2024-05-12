#!bin/bash
echo 'Run Rubke App Uploader (back-end) ...'
docker build -t rukbe/api . 
#docker run -d -p 8086:8086 -v /home/msami/workspace/RukbeChallenge:/var/www/app --restart=always --name=rukbe-api rukbe/api:latest
docker run -d -p 8086:8086 --restart=always --name=rukbe-api rukbe/api:latest
docker build -t rukbe/api-apache . 
#docker run -d -p 8086:80 -p 8443:443 -e -v $HOME/mycert.crt:/etc/ssl/certs/mycert.crt
          - ./mycert.key:/etc/ssl/private/mycert.key-v /home/msami/workspace/RukbeChallenge:/var/www/html --restart=always --name=rukbe-api-apache rukbe/api-apache:latest
docker run -d -p 8086:80 -p 8443:443 -e APP_NAME=Rukbe-Image-Uploader  --restart=always --name=rukbe-api-apache rukbe/api-apache:latest
#echo 'Run Rubke Uploader (front-end) ...'
docker build -t rukbe/front img-uploader/
#docker run -d -p 3000:3000 -v /home/msami/workspace/RukbeChallenge/img-uploader:/src --restart=always --name=rukbe-front rukbe/front:latest 
docker run -d -p 3000:3000 -e UPLOADER_API = http://localhost:8086/server.php --restart=always --name=rukbe-front rukbe/front:latest
