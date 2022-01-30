# php-mvc-studies

* docker run --rm -it -v $PWD:/app composer require symfony/cache
* docker run --rm -it -v $PWD:/app composer require doctrine/annotations
* docker run --rm -it -p 80:80 -v $PWD:/var/www/html -w /var/www/html --network="host" php php -S 127.0.0.1:80 -t public/
* vendor/bin/doctrine orm:generate-proxies
* docker run --rm -it -p 80:80 -v $PWD:/var/www/html -w /var/www/html --network="host" php php vendor/bin/doctrine dbal:run-sql 'INSERT INTO usuarios (email, senha)
 VALUES ("paulojrn@email.com", "$2y$10$oRUPiDSMyOpKcBsjrxC6/.fsZwo1A2jTcinErBELdDKdqHHKg00Q6")'
* composer require psr/http-message: interface para mensagens http (psr-7)
* https://github.com/php-fig/http-message
* composer require nyholm/psr7: implementação da psr-7
* composer require nyholm/psr7-server : pacote para criar requisições com as superglobais do php (use psr-17 (fabrica para requisições, fluxos, uri, etc))
* https://github.com/Nyholm/psr7
* composer require psr/http-server-handler: psr-15 (controlador de requisições)
* https://github.com/php-fig/http-server-handler
* : psr-11 (container de dependência)
* https://php-di.org/