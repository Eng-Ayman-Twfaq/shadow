#!/bin/sh
set -e

# تأكد من APP_KEY
if [ -z "$APP_KEY" ]; then
  echo "Error: APP_KEY is not set!"
  exit 1
fi

# انتظر حتى تكون قاعدة البيانات جاهزة
echo "Waiting for MySQL to be ready..."
while ! php -r "new PDO('mysql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT') . ';dbname=' . getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));" 2>/dev/null; do
  echo "MySQL is not ready yet. Waiting..."
  sleep 3
done
echo "MySQL is ready!"

# مسح الكاش وإنشاء الكاش الجديد
php artisan config:clear
php artisan route:clear
php artisan cache:clear
php artisan view:clear

php artisan config:cache
php artisan route:cache

# تشغيل Apache
exec "$@"
