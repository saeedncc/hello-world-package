
FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git curl unzip  libzip-dev libxml2-dev openssl nano

# instal node js
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs
RUN npm install npm@latest -g
RUN npm install yarn -g


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP extensions
# RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd


RUN docker-php-ext-install  soap


# mysql extention
RUN docker-php-ext-install pdo pdo_mysql

# could not find driver  Illuminate \ Database \ QueryException
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# could not find driver (SQL: select * from `users` where `email` = admin@localhost limit 1)
RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql

# ext-mongodb
RUN pecl install mongodb-1.16.1 &&   docker-php-ext-enable mongodb

# install libmongoc
RUN apt-get update && apt-get install -y  libmongoc-dev 

# redis extention
RUN pecl install redis &&  docker-php-ext-enable redis


# The Swoole extension is missing. Please install it and try again.
RUN pecl install swoole
RUN docker-php-ext-enable swoole

# install pcntl
RUN docker-php-ext-install pcntl

# install php sockets
RUN docker-php-ext-install sockets

# install zip
RUN docker-php-ext-install zip

# Get Composer
#COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory
# COPY . .

# Install Laravel dependencies
# RUN composer install

CMD ["php-fpm"]

EXPOSE 9000
