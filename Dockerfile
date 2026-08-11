FROM php:7.4-apache

# Install dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    libavif-bin \
    ffmpeg \
    libwebp-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Change Apache document root to /var/www/html/source_code
RUN sed -ri -e 's!/var/www/html!/var/www/html/source_code!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/html/source_code!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Set working directory
WORKDIR /var/www/html/source_code/core

# Copy application files
COPY . /var/www/html

RUN if [ -f "vendor.zip" ]; then unzip -oq vendor.zip -d . && rm vendor.zip; fi



# Increase PHP upload limits for video uploads
RUN echo "upload_max_filesize = 100M\npost_max_size = 100M" > /usr/local/etc/php/conf.d/uploads.ini

# Ensure assets/videos directory exists with correct write permissions for Apache
RUN mkdir -p /var/www/html/source_code/assets/videos \
    && chown -R www-data:www-data /var/www/html/source_code/assets \
    && chmod -R 775 /var/www/html/source_code/assets \
    && chown -R www-data:www-data /var/www/html/source_code/core/storage \
    && chmod -R 775 /var/www/html/source_code/core/storage \
    && chown -R www-data:www-data /var/www/html/source_code/core/bootstrap/cache \
    && chmod -R 775 /var/www/html/source_code/core/bootstrap/cache
