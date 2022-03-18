## Meetup core

### Development
### Run env for Mac/Linux
1. `$ make install`
2. `$ make start`
3. if the artisan starts serving the website, then you can do the migrations `$ make db-create`

### Run env for Windows

1. `docker-compose up`
2. `cp .env.example .env`
3. if the artisan starts serving the website, then you can do the migrations 
   `docker-compose exec php php artisan migrate`

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