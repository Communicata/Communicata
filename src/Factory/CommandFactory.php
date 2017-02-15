<?php

/**
 * @file
 * Contains \Drakythe\Ember\Factory\CommandFactory.
 */

namespace Drakythe\Ember\Factory;

use EclipseGc\Plugin\Factory\FactoryInterface;
use EclipseGc\Plugin\PluginDefinitionInterface;

class CommandFactory implements FactoryInterface {

  public function createInstance(PluginDefinitionInterface $definition, ...$constructors) {
    $class = $definition->getClass();
    return new $class($definition, ...$constructors);
  }

}