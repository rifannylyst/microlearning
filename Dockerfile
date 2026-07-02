FROM php:8.2-apache

# Install ekstensi yang dibutuhkan Laravel & PostgreSQL (Supabase)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Aktifkan mod_rewrite dan bersihkan modul MPM agar tidak bentrok
RUN a2dismod mpm_event mpm_worker && a2enmod mpm_prefork rewrite

# Set folder kerja
WORKDIR /var/www/html

# Copy semua file project
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Ubah Document Root Apache ke folder /public Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Berikan izin tulis untuk folder storage dan cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Buka port 80
EXPOSE 80