# Nodeでフロントをビルドするステージ
FROM node:18 as nodebuilder
WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build


# Laravel本体（PHPコンテナ）
FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    unzip \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install zip pdo pdo_pgsql

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

# ビルド済みのものをコピー
COPY --from=nodebuilder /app /var/www

# Laravel依存
RUN composer install --no-dev --optimize-autoloader

# Laravelのキー生成はFlyのsecretsで管理するため不要
# Laravelキャッシュも最終段階でOK

COPY .env.example .env
RUN php artisan key:generate

CMD ["php-fpm"]