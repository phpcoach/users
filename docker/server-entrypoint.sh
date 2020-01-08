#!/bin/bash

cd /var/www
rm -Rf var/cache
php vendor/bin/ppm start --host=0.0.0.0 --port=8000 --workers=3 --bridge=HttpKernel --bootstrap=Symfony