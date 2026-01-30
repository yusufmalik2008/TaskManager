# app/Dockerfile
FROM composer:2.7 as composer
FROM php:8.3-fpm-alpine AS builder

WORKDIR /app
COPY composer.* ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

FROM php:8.3-fpm-alpine AS runtime
RUN apk add --no-cache nginx supervisor mysql-client curl \
    && docker-php-ext-install pdo_mysql mysqli

WORKDIR /app
COPY --from=builder /app/vendor ./vendor
COPY . .

# CI4 writable dirs
RUN mkdir -p /app/writable/logs /app/writable/cache /app/writable/session \
    && chmod -R 777 /app/writable \
    && chown -R www-data:www-data /app/writable

COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/php-fpm.conf /usr/local/etc/php-fpm.d/zzz-taskmanager.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY .env.production .env

EXPOSE 80
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

