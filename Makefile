init: docker-init project-init
docker-init: docker-down-clear docker-pull docker-build docker-up
project-init: api-composer-install migrations-init fixtures-init
up: docker-up
down: docker-down
restart: down up

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

api-composer-install:
	docker-compose run --rm api-php-cli composer install

frontend-npm-install:
	docker-compose run --rm frontend-node-cli npm install

migrations-init:
	docker-compose run --rm api-php-cli php bin/console doctrine:migrations:migrate --no-interaction

fixtures-init:
	docker-compose run --rm api-php-cli php bin/console doctrine:fixtures:load --no-interaction

score-init:
	docker-compose run --rm api-php-cli php bin/console app:calculate-score

test-run:
	docker-compose run --rm api-php-cli php bin/phpunit
