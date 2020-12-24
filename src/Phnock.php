<?php

namespace Phnock;

class Phnock {
  /** @param array<string,true|string|string[]> $options*/
  public static function bootstrap(array $options = []): void {
    $defaults = [
      'debug' => true,
      'cacheDir' => '/tmp/phnock',
    ];
  
    $options += $defaults;
    $kernel = \AspectMock\Kernel::getInstance();
    $kernel->init($options);
  }
}