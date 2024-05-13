FROM node:lts-alpine3.17

ENV NODE_ENV=development

WORKDIR /src

COPY package*.json /src/

RUN npm install

COPY . .

EXPOSE 3000
EXPOSE 443

CMD ["npm", "start" ]