## Meetup core

### Development
Use Artisan helper:
```
docker-compose run --rm -u "$(id -u):$(id -g)" php php artisan
```
### Mac/Linux
1. `$ Make install`
2. `$ Make start`
3. `$ Make bash`

### Windows

1. `docker-compose up`
2. `docker-compose exec php /bin/bash`
3. `$ composer install`
4. `$ cp .env.dist .env`
5. `$ php artisan key:generate`

## All commands
1. `Make install`
2. `Make start`
3. `Make stop`
4. `Make phpstan`
5. `Make cs-check`
6. `Make cs-fix`
7. `Make run-tests`