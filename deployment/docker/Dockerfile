FROM php:7.1-apache
LABEL description="Debian repository with Apache2"
RUN docker-php-ext-install mysqli
RUN pecl install xdebug-2.7.0
RUN docker-php-ext-enable xdebug

# Update configuration for PHP 
RUN echo "xdebug.remote_enable=1" >> /usr/local/etc/php/php.ini
RUN echo "file_uploads = On" >> /usr/local/etc/php/php.ini
RUN echo "upload_max_filesize = 100M" >> /usr/local/etc/php/php.ini
RUN echo "post_max_size = 100M" >> /usr/local/etc/php/php.ini

# Install mandatory packages
RUN apt-get update
RUN apt-get install -y dpkg-dev

# Install optional packages
RUN apt-get install -y curl
RUN apt-get install -y vim
RUN apt-get install -y tree
RUN apt-get install -y leafpad

# Web context
COPY index.html /var/www/html
COPY style.css /var/www/html
COPY mystyle.css /var/www/html
COPY repository.php /var/www/html
COPY bootstrap.php /var/www/html  
COPY index.php /var/www/html
COPY info.php /var/www/html
COPY upload.php  /var/www/html
COPY DebToox /var/www/html/DebToox/
COPY vendor /var/www/html/vendor/

# Create repository file structure
COPY repoCreate.sh /tmp
RUN  chmod u+x /tmp/repoCreate.sh
RUN  /tmp/repoCreate.sh
RUN  chmod -R 777  /var/local/apt/debtoox/pool
RUN  ln -s /var/local/apt/debtoox /var/www/html/
RUN  rm  /tmp/repoCreate.sh

