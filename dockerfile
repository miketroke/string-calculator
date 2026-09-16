FROM php:8.1-cli

ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /540/StringCalculator

RUN apt-get update && apt-get install -y unzip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

CMD ["php"]
