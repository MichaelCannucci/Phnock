<?php

namespace Phnock\Models\ResponseTypes;

interface ResponseTypeInterface
{
  public function unwrap(): string;
}