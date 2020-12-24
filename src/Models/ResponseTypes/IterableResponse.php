<?php

namespace Phnock\Models\ResponseTypes;

class IterableResponse implements ResponseTypeInterface
{
  /** @var iterable<string> */
  protected $iterable;

  /** @param iterable<string> $iterable */
  public function __construct(iterable $iterable)
  {
    $this->iterable = $iterable;
  }
  /** @param iterable<string> $iterable */
  public static function from(iterable $iterable): self
  {
   return new self($iterable);
  }
  /** @return \Generator<string> */
  public function unwrap()
  {
    foreach ($this->iterable as $response) {
      yield $response;
    }
  }
}