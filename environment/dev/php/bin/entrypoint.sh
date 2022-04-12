#!/bin/sh
set -ea

if [ ! -d "vendor" ]; then
  echo "Vendor not installed. Installing..."
  if [ -f "composer.json" ]; then
    composer install
  fi
fi
echo "Starting your app..."
php artisan serve --host 0.0.0.0
exec "$@"
