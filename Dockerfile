FROM php:7.3.9-cli-alpine3.10
ARG UID
ARG GID
RUN apk --update add composer git shadow sudo
RUN usermod -u $UID www-data && groupmod -g $GID www-data
RUN echo "www-data ALL=(ALL) NOPASSWD: ALL" >> /etc/sudoers
RUN mkdir /app/
WORKDIR /app/
RUN chown -R www-data:www-data .
RUN docker-php-ext-install pdo_mysql
USER www-data:www-data
RUN composer create-project laravel/laravel:v6.0.1 --prefer-dist .
CMD composer dump-autoload && \
    php artisan serve --host=0.0.0.0
