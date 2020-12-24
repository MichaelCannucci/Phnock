<?php

namespace Phnock\ResponseTypes;

use Phnock\Exceptions\ResponseUnresolvable;
use RuntimeException;
use Traversable;

class IterableResponse implements ResponseTypeInterface
{
  /** @var string[]> */
  protected $iterable;

  /** @param iterable<string> $iterable */
  public function __construct(iterable $iterable)
  {
    if(is_array($iterable)) {
      $this->iterable = $iterable;
    } elseif($iterable instanceof Traversable) {
      $this->iterable = iterator_to_array($iterable);
    } else {
      throw new RuntimeException("Iterable must be Traversable or an array");
    }
  }
  /** @param iterable<string> $iterable */
  public static function from(iterable $iterable): self
  {
    return new self($iterable);
  }
  public function unwrap(): string
  {
    $value = current($this->iterable);
    next($this->iterable);
    if(false === $value) {
      throw new ResponseUnresolvable("Iterable Response contains no more elements");
    }
    return $value;
  }
}