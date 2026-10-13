FROM php:8.3-fpm

WORKDIR /var/www/html

# Install required packages
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        intl \
        zip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy Laravel project
COPY . .

# Install Laravel dependencies
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --optimize-autoloader

# Laravel folder permissions
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache

# Create Nginx configuration inside the Docker image
RUN printf '%s\n' \
'server {' \
'    listen 80;' \
'    server_name _;' \
'    client_max_body_size 52M;' \
'' \
'    root /var/www/html/public;' \
'    index index.php index.html;' \
'' \
'    location / {' \
'        try_files $uri $uri/ /index.php?$query_string;' \
'    }' \
'' \
'    location ~ \.php$ {' \
'        include fastcgi_params;' \
'        fastcgi_pass 127.0.0.1:9000;' \
'        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;' \
'    }' \
'' \
'    location ~ /\.ht {' \
'        deny all;' \
'    }' \
'}' \
> /etc/nginx/sites-enabled/default

# Production environment
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr

EXPOSE 80

# Create the default SQLite database when SQLite is selected, apply pending
# schema migrations, then start PHP-FPM and Nginx.
CMD ["sh", "-c", "if [ \"${DB_CONNECTION:-sqlite}\" = \"sqlite\" ]; then SQLITE_PATH=\"${DB_DATABASE:-database/database.sqlite}\"; if [ \"$SQLITE_PATH\" != \":memory:\" ]; then mkdir -p \"$(dirname \"$SQLITE_PATH\")\" && touch \"$SQLITE_PATH\" && chown www-data:www-data \"$SQLITE_PATH\"; fi; fi && php artisan storage:link --force && php artisan migrate --force && php-fpm -D && nginx -g 'daemon off;'"]
