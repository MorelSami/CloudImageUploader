#Base image
FROM php:8.2-apache

#server configuration
RUN a2enmod ssl && a2enmod rewrite
RUN mkdir -p /etc/apache2/ssl
RUN apt-get update && apt-get upgrade -y
RUN apt-get install zip unzip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#copy generated ssl certifcate keys and server configuration file
COPY ./cert/*.pem /etc/apache2/ssl/
COPY ./config/000-default.conf /etc/apache2/sites-available/000-default.conf

ENV APP_ENV=development

#working directory
WORKDIR /var/www/html 

COPY . .

#only for development
RUN chmod -R 777 uploads

RUN composer install

EXPOSE 80
EXPOSE 443

