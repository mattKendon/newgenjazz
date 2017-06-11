FROM php:5-alpine

RUN docker-php-ext-install mysqli pdo pdo_mysql

EXPOSE 80

VOLUME /app

WORKDIR /app/web

CMD ["php", "-S", "0.0.0.0:80", "-t", "/app/web", "index.php"]