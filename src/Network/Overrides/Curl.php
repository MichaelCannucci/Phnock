<?php

namespace Phnock\Network\Overrides;

use AspectOverride\Override;

class Curl implements OverrideInterface
{
  public function isValid(): bool
  {
    return function_exists('curl_exec');
  }
  public function hook(callable $override): void
  { 
    Override::function('curl_exec', function($ch) use ($override) {
      $info = curl_getinfo($ch);
      return $override($info['url']);
    });
  }
}