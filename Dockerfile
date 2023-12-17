FROM php:7.2-cli

ARG USERNAME=app
ARG USER_UID=1000

RUN useradd --uid ${USER_UID} --create-home --shell /bin/bash ${USERNAME}

RUN apt-get update && \
    apt-get install -y zip unzip && \
    rm -rf /var/lib/apt/lists/*

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

WORKDIR /var/www/html

USER ${USERNAME}

COPY composer.json .

RUN composer install
