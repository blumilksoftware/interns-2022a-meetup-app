.DEFAULT_GOAL := help
install: ## Copy .env.example to .env and build docker image
	cp .env.example .env
	docker-compose build

db-create: ## Run db migrates
	docker-compose exec php php artisan migrate

db-seed: ## Run db seeders
	docker-compose exec php php artisan db:seed

db-fresh: ## Refresh db migrate
	docker-compose exec php php artisan migrate:fresh

start: ## Run server http
	docker-compose up -d

stop: ## Stop server http
	docker-compose down --remove-orphans

bash: ## Enter to bash a container php
	docker-compose exec php ash

phpunit: ## Run tests
	docker-compose exec php composer test

cs-check: ## Run composer ecs
	docker-compose exec php composer cs

cs-fix: ## Run composer ecsf
	docker-compose exec php composer csf

run-tests: ## Run stage for test
	$(MAKE) cs-check
	$(MAKE) phpunit

phpstan: ## Run composer phpstan
	docker-compose exec php composer phpstan

composer-install: ## Run composer install
	docker-compose exec php composer install

sqlite-create: ## Create file for sqlite
	touch database/database.sqlite

key-generate: ## Create key for artisan
	docker-compose exec php php artisan key:generate

node-bash: ## Enter to bash a container node
	docker-compose exec node bash

node-install: ##  Install all dep for node
	docker-compose exec node npm install

node-build: ##  Build frontend for node
	docker-compose exec node npm run dev

init: ## First setup for project
	$(MAKE) install
	$(MAKE) node-install
	$(MAKE) node-build
	$(MAKE) sqlite-create
	$(MAKE) start
	$(MAKE) key-generate
	$(MAKE) sqlite-create
	$(MAKE) db-create

.PHONY: help
help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'
