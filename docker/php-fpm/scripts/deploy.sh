#!/bin/bash


deploy()
{
cd /var/www/symfony
php app/console doctrine:schema:update --force --complete
php app/console consigna:database:initialize
php app/console fos:user:create admin consigna@consigna.dev admin --super-admin || true
php app/console cache:clear
cd -
}

set -e

host=$(env | grep DB_PORT_3306_TCP_ADDR | cut -d = -f 2)
port=$(env | grep DB_PORT_3306_TCP_PORT | cut -d = -f 2)

echo -n "waiting for TCP connection to $host:$port..."

while ! nc -w 1 $host $port 2>/dev/null
do
  echo -n .
  sleep 1
done

deploy