FROM juliocesarmidia/php_rc_apache:7.4
LABEL maintainer="julio@blackdevs.com.br"

WORKDIR /var/www/html/
COPY . /var/www/html/

RUN mv /var/www/html/000-default.conf /etc/apache2/sites-enabled/000-default.conf
RUN mv /var/www/html/security.conf /etc/apache2/conf-enabled/security.conf

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
