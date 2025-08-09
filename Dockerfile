# Gunakan image resmi PHP dengan Apache
FROM php:8.2-apache

RUN docker-php-ext-install mysqli

# Copy semua file proyek ke dalam folder /var/www/html di dalam container
COPY . /var/www/html/

# Beri permission yang tepat (opsional, tergantung kebutuhan)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Aktifkan mod_rewrite Apache jika kamu pakai .htaccess
RUN a2enmod rewrite

# Tambahkan konfigurasi Apache (opsional)
# COPY ./apache-config.conf /etc/apache2/sites-available/000-default.conf

# Expose port 80
EXPOSE 80
