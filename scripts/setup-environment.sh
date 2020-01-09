#!/bin/bash

cd /var/www
php bin/console doctrine:database:create
php bin/console doctrine:query:sql "create table users (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, age INT NOT NULL, PRIMARY KEY (ID))"