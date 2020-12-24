<?php

namespace Tests\Unit;

use Phnock\Models\ResponseTypes\FileResponse;
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
}