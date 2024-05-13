FROM php:8.2-apache


RUN a2enmod ssl && a2enmod rewrite
RUN mkdir -p /etc/apache2/ssl
RUN apt-get update && apt-get upgrade -y

#config folder should contain both cert and key generated by your local root certificate for specified domain]
COPY ./config/*.pem /etc/apache2/ssl/
COPY ./config/000-default.conf /etc/apache2/sites-available/000-default.conf

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV APP_ENV=development

#working directory
WORKDIR /var/www/html 

COPY . .

#only for development
RUN chmod -R 777 uploads

RUN composer install

EXPOSE 80
EXPOSE 443

