Interview test
=====

## Reference / Requirements

`./reference/PHP Developer test.pdf`

## Requirements

`PHP >=8.0.2`

## Installation

`composer install`

## Tests

Running tests

`./vendor/bin/phpunit .`

## Docker setup

```
// Run PHP (see ./docker/php/Dockerfile for exact setup)
`docker-compose up`

// You can instal vendor files via
docker-compose exec php composer install

// To run tests execute (while running container)
docker-compose exec php ./vendor/bin/phpunit .
```

