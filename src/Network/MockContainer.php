<?php

namespace Phnock\Network;

trait MockContainer 
{
  /** @var array<string,ResponseTypeInterface|string> */
  protected $networkRequests = [];

  /** 
   * @param ResponseTypeInterface|string $payload 
   */
  protected function addMock(string $url, $payload): self
  {
    $this->networkRequests[$url] = $payload;
    return $this;
  }
  /** @return array<string,ResponseTypeInterface|string> */
  protected function getMockedRequests(): array
  {
    return $this->networkRequests;
  }
}