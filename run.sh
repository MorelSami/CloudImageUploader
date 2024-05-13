#!bin/bash
echo 'Running Rubke App Uploader (back-end) ...'
docker build -t rukbe/api . 
docker run -d -p 8086:80 -p 8443:443 -e VIRTUAL_HOST=rukbe-api.local -v /{path/to/cloned-project-repository}:/var/www/html --restart=always --name=rukbe-api rukbe/api:latest

echo 'Running Rubke App Uploader (front-end) ...'
docker build -t rukbe/front rukbe/
docker run -d -p 3000:3000 -e VIRTUAL_HOST=rukbe-front.local -v /{path/to/cloned-project-repository}/rukbe:/src --restart=always --name=rukbe-front rukbe/front:latest 

echo 'Rukbe Image Uploader is now ready at https://localhost:3000 or https://rukbe-front.local:3000'
echo 'Note: If SSL certificate option not enabled then use http://localhost:3000 or http://rukbe-front.local:3000