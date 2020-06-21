FROM php:7.4-rc-apache
LABEL maintainer="julio@blackdevs.com.br"

WORKDIR /var/www/html/
COPY . /var/www/html/

RUN apt-get update -yqq && \
    apt-get install -yqq \
    curl \
    iputils-ping \
    netcat \
    host && \
    rm -rf /var/lib/apt/lists/*

RUN mv /var/www/html/000-default.conf /etc/apache2/sites-enabled/000-default.conf
RUN mv /var/www/html/security.conf /etc/apache2/conf-enabled/security.conf

RUN a2enmod headers && a2enmod deflate && a2enmod rewrite
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_RUN_DIR /var/run/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_PID_FILE /var/run/apache2/apache2.pid

RUN mkdir -p $APACHE_RUN_DIR && \
    mkdir -p $APACHE_LOCK_DIR && \
    mkdir -p $APACHE_LOG_DIR && \
    rm -rf /var/www/html/index.html && \
    chown -R $APACHE_RUN_USER:$APACHE_RUN_GROUP /var/www/html/

EXPOSE 80

CMD [ "apache2", "-D", "FOREGROUND" ]

# Build this image
# docker image build --tag juliocesarmidia/edent-app:v1.0.0 -f Dockerfile .

# Run this image
# docker container run --rm --name edent-app -p 80:80 juliocesarmidia/edent-app:v1.0.0
# docker container run --rm -it --name edent-app --entrypoint "" -p 80:80 juliocesarmidia/edent-app:v1.0.0 bash

# docker container run --rm -v "$PWD:/var/www/html/" --name edent-app -p 80:80 juliocesarmidia/edent-app:v1.0.0

# docker container run --rm -p 8080:80 -it php:rc-apache bash

# echo "<?php phpinfo(); ?>" > /var/www/html/index.php
