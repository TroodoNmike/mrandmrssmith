Interview test
=====

## Reference / Requirements

`./reference/PHP Developer test.pdf`

## Web Server Requirements

`PHP >=8.0.2`


## Docker / local setup

```
// any web server would work however docker setup below is recommended

// Run PHP container (see ./docker/php/Dockerfile for exact setup)
docker-compose up -d

// You can instal vendor files via (php container must be running)
docker-compose exec php composer install

// To run tests execute (php container must be running)
docker-compose exec php ./bin/phpunit

// for web server you can use command below (php container must be running)
docker-compose exec php symfony serve

// http://localhost:8000/calculator to access application
```

