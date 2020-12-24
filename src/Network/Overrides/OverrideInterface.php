<?php

namespace Phnock\Network\Overrides;

interface OverrideInterface
{
  public function setup(): void;
  public function isValid(): bool;
  public function hook(callable $getContentFn): void;
}