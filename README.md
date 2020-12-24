# Phnock - PHP Network Mocks

Mock network request in your PHP tests

## Getting Started

### Installing

```
composer require --dev mcannucci/phnock
```

### Bootstraping
Within the bootstrap file include Phnock::bootstrap() method with all the directories that need to be intercepted
```php
<?php

use Phnock\Phnock;

require __DIR__ . "/../vendor/autoload.php";
Phnock::bootstrap([
  'includePaths' => [
    __DIR__.'/../src',
    __DIR__.'/../vendor/guzzle',
  ]
]);
```
### Usage
Within your testcase include the trait "Phnock\Traits\HTTPMock" and call the method "$this->matchUriWithResponse"
```php
<?php

use Phnock\Traits\HTTPMock;
use PHPUnit\Framework\TestCase;

class MyTest extends TestCase
{
 use HTTPMock

 public function test_my_test()
 {
   $this->matchUriWithResponse('example.com', 'Intercepted!');
   // Network Request to 'example.com' from either curl or guzzle
   $this->assertEquals($response, 'Intercepted!');
 }
}
```

### Possible Return Types
Using a regex pattern to match urls:
```php
// This will return 'Intercepted!' for any url that matches this regex
// Ex:
//  https\\example.com?paramter=1
//  https\\example.com?paramter=2
$this->matchUriWithResponse('/https\\\\example\.com\?parameter=.+/','Intercepted');
```
Possible Response Bodies
```php
// Use a file's contents as the body
$this->matchUriWithResponse(
 'example.com', 
 Phnock\ResponseTypes\FileResponse::of('filepath')
);
// Use an array that will be returned as json
$this->matchUriWithResponse(
 'example.com', 
 [
  'a' => [
   'b' => 'c'
  ]
 ]
);
// Use an iterable to change the contents of the response by how many times it's called
$this->matchUriWithResponse(
 'example.com',
 use Phnock\ResponseTypes\IterableResponse::from(['1','2','3'])
);
```

## Development

The provided docker compose setup can be use to build a development environment
```sh
docker-compose up -d
# Creating a shell inside the container
docker-compose run -rm php bash
# running phpstan and tests
composer all
# running only the tests
composer test
# running phpstan
composer analyse
```

## Built With

* [CodeCeption/AspectMock](https://github.com/Codeception/AspectMock) - The underlying mocking framework used

## Versioning

[SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Shamelessly basing the name off [nock](https://github.com/nock/nock)
