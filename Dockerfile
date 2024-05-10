FROM php:8.2-cli

RUN apt-get update && apt-get upgrade -y

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV APP_ENV=development

#working directory
WORKDIR /var/www/app 

COPY . .

RUN composer install

EXPOSE 8086

#run built-in php-server for now
CMD [ "php", "-S", "0.0.0.0:8086", "-t", "/var/www/app" ]

