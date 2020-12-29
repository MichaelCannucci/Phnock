<?php

namespace Phnock\Network\Overrides;

use AspectOverride\Override;
use Guzzle\Http\Client;
use Guzzle\Http\Message\RequestInterface;
use Guzzle\Http\Message\Response;

class Guzzle implements OverrideInterface
{
  public function isValid(): bool
  {
    return class_exists(Client::class);
  }
  public function hook(callable $getContentFn): void 
  {
    Override::method(Client::class, 'send', function($requests) use ($getContentFn) {
      $asUrl = function(RequestInterface $request) {
        return $request->getUrl() . $request->getQuery();
      };
      $asResponse = function(string $body) {
        return new Response("202", [], $body);
      };
      // Handle the cases where Guzzle is sending multiple requests at once 
      // and only one request
      if (!($requests instanceof RequestInterface)) {
        // Guzzle::Request[] -> string[] {Actual Urls} -> string[] {Requests Content} -> Guzzle::Response[]
        return array_map($asResponse, array_map($getContentFn, array_map($asUrl, $requests)));
      }
      return $asResponse($getContentFn($asUrl($requests)));
    });
  }
}