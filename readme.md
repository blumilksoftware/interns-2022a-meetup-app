## Meetup core

### Development
### Run env for Mac/Linux
1. `$ make install`
2. `$ make start`
3. `$ make bash` amd run this commnad `composer install`
3. `$ make db-create`

### Run env for Windows

1. `docker-compose up -d`
2. `cp .env.example .env`
3. `touch database/database.sqlite`
4. `docker-compose exec php ash` and run this commnad `composer install`
5. `docker-compose exec php php artisan migrate`

### Address where the environment is available
- `http://localhost`
## All commands
1. `make install`
2. `make start`
3. `make stop`
4. `make phpstan`
5. `make cs-check`
6. `make cs-fix`
7. `make run-tests`