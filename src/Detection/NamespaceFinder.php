<?php

namespace Phnock\Detection;

class NamespaceFinder
{
  /** 
  * @param string[] $paths 
  * @return string[]
  */
  public static function forFunction(array $paths, string $function): array
  {
    $resultingNamespaces = [];
    foreach ($paths as $path) {
      if(!is_dir($path)) { continue; }
      // Search for curl_exec and then search those files for the matches on namespace (take only the matches)
      $raw = shell_exec("grep -lRIP '$function\(.+\)' $path | xargs grep -hoP 'namespace [\\a-zA-Z0-9]+;'") ?? '';
      $namespaces = explode("\n", $raw);
      foreach ($namespaces as $namespace) {
        $resultingNamespaces[] = trim(str_replace(['namespace',';'], '', $namespace));
      }
    }
    return array_filter(array_unique($resultingNamespaces));
  }
}

