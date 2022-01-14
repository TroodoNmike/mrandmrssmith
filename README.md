Interview test
=====

## Reference / Requirements

`./reference/PHP Developer test.pdf`

## Web Server Requirements

`PHP >=8.0.2`

## Installation

`composer install`

## Running Web Server


```
// for local environment use it with docker but running it with any web server would work
docker-compose up

// make sure php container is running
docker-compose exec php symfony serve

// http://localhost:8000/calculator to access application
```

## Tests

Running tests (if you dont have PHP 8 please use docker setup provided)

`./bin/phpunit .`

## Docker setup

```
// Run PHP (see ./docker/php/Dockerfile for exact setup)
`docker-compose up`

// You can instal vendor files via
docker-compose exec php composer install

// To run tests execute (while running container)
docker-compose exec php ./bin/phpunit
```

