FROM node:lts-alpine3.17

ENV NODE_ENV=development

WORKDIR /src

COPY package*.json .

RUN npm install

EXPOSE 3000

#run built-in php-server for now
CMD ["npm", "start" ]