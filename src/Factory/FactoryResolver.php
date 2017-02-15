<?php

namespace Drakythe\Ember\Factory;

use EclipseGc\Plugin\Factory\FactoryInterface;
use EclipseGc\Plugin\Factory\FactoryResolverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FactoryResolver implements FactoryResolverInterface {

  public function __construct(ContainerInterface $container) {
    $this->container = $container;
  }

  public function getFactoryInstance(string $factoryClass): FactoryInterface {
    if ($factoryClass instanceof ContainerAwareFactoryInterface) {
      return $factoryClass::create($this->container);
    }
    return new $factoryClass();
  }

}
