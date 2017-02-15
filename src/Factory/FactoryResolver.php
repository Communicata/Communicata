<?php

namespace Drakythe\Ember\Factory;

use EclipseGc\Plugin\Factory\FactoryInterface;
use EclipseGc\Plugin\Factory\FactoryResolverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FactoryResolver implements FactoryResolverInterface {

  /**
   * FactoryResolver constructor.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   The dependency injection container.
   */
  public function __construct(ContainerInterface $container) {
    $this->container = $container;
  }

  /**
   * {@inheritdoc}
   */
  public function getFactoryInstance(string $factoryClass): FactoryInterface {
    if ($factoryClass instanceof ContainerAwareFactoryInterface) {
      return $factoryClass::create($this->container);
    }
    return new $factoryClass();
  }

}
