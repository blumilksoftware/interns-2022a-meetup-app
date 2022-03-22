.DEFAULT_GOAL := help
install: ## Copy .env.example to .env and build docker image
	cp .env.example .env
	docker-compose build

db-create: ## Run db migrates
	docker-compose exec php php artisan migrate

start: ## Run server http
	docker-compose up -d

stop: ## Stop server http
	docker-compose down --remove-orphans

bash: ## Enter to bash a container php
	docker-compose exec php ash

phpunit: ## Run tests
	docker-compose exec php composer test

cs-check: ## Run composer ecs
	docker-compose exec php composer ecs

cs-fix: ## Run composer ecsf
	docker-compose exec php composer ecsf

run-tests: ## Run stage for test
	docker-compose exec php composer ecs
	docker-compose exec php composer test

phpstan: ## Run composer phpstan
	docker-compose exec php composer phpstan

composer-install: ## Run composer install
	docker-compose exec php composer install

sqlite-create: ## Create file for sqlite
	touch database/database.sqlite

key-generate: ## Create key for artisan
	docker-compose exec php php artisan key:generate

init: ## Setup for project
	make install
	make sqlite-create
	make start
	make key-generate
	make composer-install
	make sqlite-create
	make db-create

.PHONY: help
help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'