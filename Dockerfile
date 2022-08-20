FROM troflez/devopstest_php

WORKDIR /var/www/html

COPY . .

RUN docker-php-ext-install mysqli