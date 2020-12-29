#!/bin/bash

versions=(8.0 7.4 7.3 7.2)
for version in "${versions[@]}"
do
  echo $version
  docker run --rm -v $(pwd)/:/app -w /app php:$version vendor/bin/phpunit
done