<?php

namespace Tests\Unit;

use Phnock\Traits\HTTPMock;
use Guzzle\Http\Client;
use PHPUnit\Framework\TestCase;
use Tests\Mock\CurlNetworkRequest;
use TRegx\DataProvider\CrossDataProviders;

class GuzzleTest extends TestCase
{
  use HTTPMock;

  /**
   * @dataProvider guzzle_return_providers
   */
  public function test_always_returns_what_we_want($url, $request, $expected)
  {
    $urlToSend = $url;
    if(is_array($url)) {
      $urlToSend = $url[1];
      $url = $url[0];
    }
    $this->matchUriWithResponse($url, $expected);
    $actual = $request($urlToSend);
    $this->assertEquals($expected, $actual);
  }
  public function guzzle_return_providers()
  {
    // TODO: Curl and Guzzle Tests
    return CrossDataProviders::cross(
      [
        [["/example\.com\/[a-zA-Z]/", "example.com/test"]],
        [["/example\.com\?(test|other)&?=\d/", "example.com?test=1&other=2"]],
        ["example.com"],
      ],
      [
        [function(string $url): string {
          return CurlNetworkRequest::get($url);
        }],
        [function(string $url): string {
          return (new Client($url))->get()->send()->getBody(true);
        }]
      ],
      [
        ['Overrides Body!']
      ]
    );
  }
}