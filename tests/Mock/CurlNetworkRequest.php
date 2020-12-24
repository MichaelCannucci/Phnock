<?php

namespace Tests\Mock;

class CurlNetworkRequest
{
  public static function get($url)
  {
    $ch = curl_init($url);
    $options = [ CURLOPT_RETURNTRANSFER => true ];
    curl_setopt_array($ch, $options);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
  }
}