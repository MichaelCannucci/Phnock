<?php

use Phnock\Phnock;

require __DIR__ . "/../vendor/autoload.php";
Phnock::bootstrap([
  'directories' => [
    __DIR__.'/../src',
    __DIR__.'/../tests/',
    __DIR__.'/../vendor/guzzle',
  ]
]);