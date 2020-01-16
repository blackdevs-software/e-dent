FROM php:rc-apache
LABEL maintainer="julio@blackdevs.com.br"

WORKDIR /var/www/html/
COPY . /var/www/html/

RUN mv /var/www/html/000-default.conf /etc/apache2/sites-enabled/000-default.conf
RUN mv /var/www/html/security.conf /etc/apache2/conf-enabled/security.conf

RUN apt-get update -y && \
    apt-get install -y curl \
    iputils-ping traceroute \
    nmap netcat telnet host \
    net-tools mariadb-client
RUN a2enmod headers && a2enmod deflate && a2enmod rewrite
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_PID_FILE /var/run/apache2/apache2.pid
ENV APACHE_RUN_DIR /var/run/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_LOG_DIR /var/log/apache2

RUN mkdir -p $APACHE_RUN_DIR
RUN mkdir -p $APACHE_LOCK_DIR
RUN mkdir -p $APACHE_LOG_DIR

RUN rm -rf /var/www/html/index.html
RUN chown -R $APACHE_RUN_USER:$APACHE_RUN_USER /var/www/html/

EXPOSE 80

CMD [ "apache2", "-D", "FOREGROUND" ]

# Build this image
# docker image build -f Dockerfile -t edent-app .

# Run this image
# docker container run --rm --name edent-app -p 80:80 edent-app
# docker container run --rm -it --name edent-app --entrypoint "" -p 80:80 edent-app bash

# docker container run --rm -v $PWD:/var/www/html/ --name edent-app -p 80:80 edent-app

# docker container run --rm -p 8080:80 -it php:rc-apache bash

# echo "<?php phpinfo(); ?>" > /var/www/html/index.php

# install minikube
# sudo curl -Lo minikube https://github.com/kubernetes/minikube/releases/download/v1.5.2/minikube-linux-amd64
# sudo chmod +x minikube && sudo mv minikube /usr/local/bin/

# install kubectl
# sudo wget https://storage.googleapis.com/kubernetes-release/release/v1.16.2/bin/linux/amd64/kubectl
# sudo chmod +x kubectl && sudo mv kubectl /usr/local/bin/
