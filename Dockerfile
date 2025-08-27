# استخدم PHP 8.3 مع Apache
FROM php:8.3-apache

# تفعيل modules
RUN a2enmod rewrite headers expires deflate

# تثبيت dependencies
RUN apt-get update && \
    apt-get install -y git zip unzip libzip-dev nodejs npm && \
    rm -rf /var/lib/apt/lists/*

# تثبيت PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli opcache zip bcmath

# تعيين مجلد العمل
WORKDIR /var/www/html

# نسخ المشروع
COPY . .

# تثبيت Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# تثبيت dependencies PHP
RUN composer install --no-dev --optimize-autoloader

# تثبيت Node dependencies وبناء الواجهة
RUN npm install && npm run build

# نسخ وتشغيل entrypoint.sh
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# إعداد Apache document root
RUN echo "DocumentRoot /var/www/html/public" > /etc/apache2/sites-available/000-default.conf && \
    echo "<Directory /var/www/html/public>" >> /etc/apache2/sites-available/000-default.conf && \
    echo "    AllowOverride All" >> /etc/apache2/sites-available/000-default.conf && \
    echo "    Require all granted" >> /etc/apache2/sites-available/000-default.conf && \
    echo "</Directory>" >> /etc/apache2/sites-available/000-default.conf

# تعيين صلاحيات
# تعيين صلاحيات
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache && \
    php artisan storage:link || true


# فتح البورت
EXPOSE 80

# تعيين entrypoint
ENTRYPOINT ["entrypoint.sh"]

# بدء Apache
CMD ["apache2-foreground"]
