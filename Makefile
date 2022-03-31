build:
	docker-compose -f ./docker/docker-compose.yml build

up:
	docker-compose -f ./docker/docker-compose.yml up -d --remove-orphans

status:
	docker-compose -f ./docker/docker-compose.yml ps

logs:
	docker-compose -f ./docker/docker-compose.yml logs -f

down:
	docker-compose -f ./docker/docker-compose.yml down -v --rmi=all --remove-orphans

bash:
	docker-compose -f ./docker/docker-compose.yml exec -u www-data php-fpm bash

test:
	docker-compose -f ./docker/docker-compose.yml exec -u www-data php-fpm bin/phpunit

migrate:
	docker-compose -f ./docker/docker-compose.yml exec -u www-data php-fpm bin/console doctrine:migrations:migrate
