<?php

namespace Tests\Feature;

use Phnock\Detection\NamespaceFinder;
use PHPUnit\Framework\TestCase;

class NamespaceFinderTest extends TestCase
{
  public function test_finds_namespace_for_folder()
  {
    $namespaces = NamespaceFinder::forFunction(
      [__DIR__ . '/../Mock'],
      'curl_exec'
    );
    $this->assertEquals(['Tests\Mock'], $namespaces);
  }
}