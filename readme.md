## Meetup core

### Development
Run the environment:
```
docker-compose up -d
docker-compose run --rm -u "$(id -u):$(id -g)" php composer install
```

Use Artisan helper:
```
docker-compose run --rm -u "$(id -u):$(id -g)" php php artisan
```
