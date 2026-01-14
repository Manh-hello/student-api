#!/usr/bin/env bash

set -o errexit

composer install --no-dev --working-dir=/opt/render/project/src

php artisan migrate --force
php artisan config:cache
php artisan route:cache