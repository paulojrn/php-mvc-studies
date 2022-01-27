# php-mvc-studies

* docker run --rm -it -v $PWD:/app composer require symfony/cache
* docker run --rm -it -v $PWD:/app composer require doctrine/annotations
* docker run --rm -it -p 80:80 -v $PWD:/var/www/html -w /var/www/html --network="host" php php -S 127.0.0.1:80 -t public/
* vendor/bin/doctrine orm:generate-proxies
* docker run --rm -it -p 80:80 -v $PWD:/var/www/html -w /var/www/html --network="host" php php vendor/bin/doctrine dbal:run-sql 'INSERT INTO usuarios (email, senha)
 VALUES ("paulojrn@email.com", "$2y$10$oRUPiDSMyOpKcBsjrxC6/.fsZwo1A2jTcinErBELdDKdqHHKg00Q6")'