<?php

namespace Phnock\ResponseTypes;

interface ResponseTypeInterface
{
  public function unwrap(): string;
}