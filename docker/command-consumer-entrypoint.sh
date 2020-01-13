#!/bin/bash

cd /var/www
rm -Rf var/cache
php bin/console commands-consumer