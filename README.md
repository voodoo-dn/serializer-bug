1. docker network create -d bridge --subnet 192.222.0.0/24 --gateway 192.222.0.1 serializer
2. docker-compose up
3. docker-compose exec php-fpm composer install
4. docker-compose exec php-fpm vendor/bin/simple-phpunit tests