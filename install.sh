COMPOSER_VENDOR_PATH="~/.config/composer/vendor/bin/"

composer global require "laravel/lumen-installer"
export PATH="$PATH:$COMPOSER_VENDOR_PATH"

sudo apt-get install php7.0-zip
sudo apt-get install php7.0-mysql
sudo apt-get install php7.0-mbstring php7.0-dom

composer require predis/predis illuminate/redis

php artisan migrate:install
php artisan migrate

mkdir -p ./storage/images
