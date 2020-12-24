<?php

namespace Phnock\Models\ResponseTypes;

interface ResponseTypeInterface
{
  /**
   * @return string|\Generator<string>
   */
  public function unwrap();
}