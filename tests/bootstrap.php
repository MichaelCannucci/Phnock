<?php

use Phnock\Phnock;

require __DIR__ . "/../vendor/autoload.php";
Phnock::bootstrap([
  'includePaths' => [
    __DIR__.'/../src',
    __DIR__.'/../tests/',
    __DIR__.'/../vendor/guzzle',
  ]
]);