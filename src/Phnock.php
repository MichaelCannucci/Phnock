<?php

namespace Phnock;

use AspectOverride\Core\Core;

class Phnock {
  /** @param array<string,true|string|string[]> $options*/
  public static function bootstrap(array $options): void {
    Core::getInstance()->init($options);
  }
}