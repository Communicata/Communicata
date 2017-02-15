<?php

/**
 * @file
 * Contains \Drakythe\Ember\Bootstrap.
 */

namespace Drakythe\Ember;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class Bootstrap {

  public static function collectServices(ContainerBuilder $container, \Traversable $namespaces) {
    $service_directories = [];
    foreach ($namespaces as $directory) {
      // $directory will correspond to the src dir, so up one level.
      $service_directories[] = $directory . DIRECTORY_SEPARATOR . '..';
    }
    $loader = new PhpFileLoader($container, new FileLocator($service_directories));
    $loader->load('services.php');
  }

}