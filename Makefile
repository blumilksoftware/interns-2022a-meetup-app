install:
	cp -n .env.dist .env
	docker-compose build
	docker-compose run php composer install

db-create:
	docker-compose exec php php artisan migrate

start:
	docker-compose up -d

stop:
	docker-compose down --remove-orphans

bash:
	docker-compose exec php ash

phpunit:
	docker-compose exec php composer test

cs-check:
	docker-compose exec php composer ecs

cs-fix:
	docker-compose exec php composer ecsf

run-tests:
	docker-compose exec php composer ecs
	docker-compose exec php composer test
