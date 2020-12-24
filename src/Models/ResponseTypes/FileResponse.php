<?php

namespace Phnock\Models\ResponseTypes;

use Phnock\Exceptions\ResponseUnresolvable;
use Phnock\Models\ResponseTypes\ResponseTypeInterface;

final class FileResponse implements ResponseTypeInterface
{
  /** @var string */
  protected $uri;

  public function __construct(string $uri)
  {
    $this->uri = $uri;
  }
  public static function of(string $uri): self
  {
   return new self($uri);
  }
  public function unwrap(): string 
  {
    $contents = file_get_contents($this->uri);
    if(false === $contents) {
      throw new ResponseUnresolvable("File not found for: " . $this->uri);
    }
    return $contents;
  }
}