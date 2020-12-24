<?php

namespace Phnock\Network;

use Phnock\ResponseTypes\ResponseTypeInterface;
use Phnock\Exceptions\OverwriteFailedException;


trait MockContainerSearcher
{
  /** @param ResponseTypeInterface|string $data */
  protected function unwrap($data)
  {
    if($data instanceof ResponseTypeInterface) {
      return $data->unwrap();
    }
    return $data;
  }
  /** 
   * @param array<string,ResponseTypeInterface|string> $name
   * @return mixed 
   */
  protected function findResponse(array $mocks, string $uri)
  {
    foreach ($mocks as $mockUri => $mock) {
      // Use different comparisons if it's a regex or literal
      if(preg_match("/^\/.+\/$/", $mockUri) && preg_match($mockUri, $uri)) {
        return $this->unwrap($mock);
      } elseif ($mockUri === $uri) {
        return $this->unwrap($mock);
      }
    }
    throw new OverwriteFailedException("Couldn't find a matching url for this response: $uri");
  }
}