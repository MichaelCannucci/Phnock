<?php

namespace Tests\Unit;

use Phnock\ResponseTypes\FileResponse;
use Phnock\ResponseTypes\IterableResponse;
use Phnock\Traits\HTTPMock;
use PHPUnit\Framework\TestCase;
use Tests\Mock\CurlNetworkRequest;

class ResponseTypesTest extends TestCase
{
  use HTTPMock;

  public function test_can_mock_response_with_file()
  {
    $filePath = __DIR__ . '/../Util/Resources/example.json';
    $this->matchUriWithResponse(
      "example.com",
      FileResponse::of($filePath)
    );
    $response = CurlNetworkRequest::get('example.com');
    $this->assertEquals(
      $response, 
      file_get_contents($filePath)
    );
  }
  public function test_can_mock_response_with_multiple_results()
  {
    $this->matchUriWithResponse(
      "example.com",
      IterableResponse::from([
        'test1',
        'test2',
        'test3'
      ])
    );  
    foreach (range(1,3) as $iteration) {
      $response = CurlNetworkRequest::get('example.com');
      $this->assertEquals("test{$iteration}", $response);
    }
  }
}