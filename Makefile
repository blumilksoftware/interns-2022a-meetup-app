install:
	cp -n .env.dist .env
	docker compose build
	docker compose run php composer install

db-create:
	docker compose exec php php artisan migrate

start:
	docker compose up -d

stop:
	docker compose down --remove-orphans

bash:
	docker compose exec php bash

phpstan:
	docker compose exec php composer phpstan

phpunit:
	docker compose exec php composer test

cs-check:
	docker compose exec php composer cs:check

cs-fix:
	docker compose exec php composer cs:fix

run-tests:
	docker compose exec php composer cs:check --quiet
	docker compose exec php composer test

fix-permissions:
	docker compose exec php	usermod -u 1000 www-data