<?php

namespace Phnock\Traits;

use Phnock\Network\Overrides\Curl;
use Phnock\Network\Overrides\Guzzle;
use Phnock\Network\Overrides\OverrideInterface;
use Phnock\Network\MockContainer;
use Phnock\Network\MockContainerSearcher;

trait HTTPMock
{
  use MockContainer;
  use MockContainerSearcher;
  
  /** @var OverrideInterface[] */
  protected $overrides = [];

  private function __init()
  {
    if(empty($this->overrides)) {
      foreach([new Curl(),new Guzzle()] as $override) {
        if($override->isValid()) {
          $override->setup();
          $this->overrides[] = $override;
        }
      }
    }
  }
  /** 
  * @param string|ResponseType|array<mixed,mixed> $response 
  * @return string|ResponseType
  */
  public function normalize($response)
  {
    if (is_array($response)) {
      $response = json_encode($response);
      if(false === $response) {
        throw new \RuntimeException("Response Body failed to serialize");
      }
    }
    return $response;
  }
  /**
   * @param string $uri Regex or Static URI to match against
   * @param string|array<mixed,mixed> $response
   */
  public function matchUriWithResponse(string $uri, $response)
  {
    $this->__init();
    $this->addMock($uri, $response);
    foreach ($this->overrides as $override) {
      $responses = [];
      foreach ($this->getMockedRequests() as $uri => $response) {
        /** @var array<string,string> */
        $responses[$uri] = $this->normalize($response);
        /** 
         * Basically setting up a closure with all the data regarding the mocks
         * That the "Overrides" can use to find responses and return their respective objects
         */
        $override->hook(function(string $uri) use ($responses) {
          return $this->findResponse($responses, $uri);
        });
      }
    }
  }
}