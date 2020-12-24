<?php

namespace Phnock\Network\Overrides;

use AspectMock\Test;
use Phnock\Detection\NamespaceFinder;

class Curl implements OverrideInterface
{
  /** @var string[] */
  protected static $namespaces = [];
  public function setup(): void 
  { 
    if(empty(self::$namespaces)) {
      self::$namespaces = NamespaceFinder::forFunction(
        \AspectMock\Kernel::getInstance()->getOptions()['includePaths'],
        'curl_exec'
      );
    }
  }
  public function isValid(): bool
  {
    return function_exists('curl_exec');
  }
  public function hook(callable $override): void
  { 
    foreach (self::$namespaces as $namespace) {
      Test::func($namespace, 'curl_exec', function($ch) use ($override) {
        $info = curl_getinfo($ch);
        return $override($info['url']);
      });
    }
  }
}