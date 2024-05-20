#!bin/bash
echo 'Running Rubke App Uploader (back-end) ...'
docker build -t rukbe/api . 
docker run -d -p 8086:80 \
-e VIRTUAL_HOST=rukbe-api.local \
-e APP_NAME=Rukbe-Image-Uploader \
-e APP_ENV=development \
-e APP_URL=http://localhost:8086 \
--restart=always \
--name=rukbe-api \
rukbe/api:latest

echo 'Running Rubke App Uploader (front-end) ...'
docker build -t rukbe/front rukbe/
docker run -d -p 3000:3000  \
-e VIRTUAL_HOST=rukbe-front.local \
-e HTTPS=false \
-e SSL_CRT_FILE=./cert/localhost+3.pem \
-e SSL_KEY_FILE=./cert/localhost+3-key.pem \
-e REACT_APP_API_ENDPOINT=http://localhost:8086/server.php  \
--restart=always  \
--name=rukbe-front  \
rukbe/front:latest 

echo 'Rukbe Image Uploader is now ready at http://localhost:3000 or http://rukbe-front.local:3000'