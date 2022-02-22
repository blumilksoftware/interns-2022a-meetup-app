## Meetup core

### Development
### Setup app for development
1. create file ./server.php and paste this content
```php
<?php
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

require_once __DIR__.'/public/index.php';
```
2. create files for ./public/index.php and paste this content
```php
<?php

use Blumilk\Meetup\Core\MeetupApplication;

require __DIR__ . '/../vendor/autoload.php';

$application = new MeetupApplication((string)__DIR__."/../");
$application->run();
```
### Run env for Mac/Linux
1. `$ Make install`
2. `$ Make start`
3. `$ Make bash`

### Run env for Windows

1. `docker-compose up`
2. `docker-compose exec php /bin/bash`
3. `$ composer install`
4. `$ cp .env.dist .env`
5. `$ php artisan key:generate`

### Address where the environment is available
- `http://localhost/`
## All commands
1. `Make install`
2. `Make start`
3. `Make stop`
4. `Make phpstan`
5. `Make cs-check`
6. `Make cs-fix`
7. `Make run-tests`