FROM ubuntu:alpine

WORKDIR /app

COPY . .

RUN apt-install composer

RUN composer install

EXPOSE 8000

CMD ["php", "artisan", "serve"]

