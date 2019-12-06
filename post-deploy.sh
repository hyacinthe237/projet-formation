rm -Rf bootstrap/cache/* && chmod 0777 bootstrap/cache
php artisan config:cache
#php artisan queue:restart
php artisan view:clear
php artisan route:clear
mkdir public/uploads
chmod 0777 -Rf public/uploads
chmod 0777 -Rf storage
chmod 0777 -Rf bootstrap
chmod 0666 .env
php artisan migrate
