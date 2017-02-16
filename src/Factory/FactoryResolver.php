<?php

namespace Drakythe\Ember\Factory;

use EclipseGc\Plugin\Factory\FactoryInterface;
use EclipseGc\Plugin\Factory\FactoryResolverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FactoryResolver implements FactoryResolverInterface {

  /**
   * @var \Symfony\Component\DependencyInjection\ContainerInterface
   */
  protected $container;

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
    $interfaces = class_implements($factoryClass);
    if($interfaces && in_array('Drakythe\Ember\Factory\ContainerAwareFactoryInterface', $interfaces)) {
      return $factoryClass::create($this->container);
    }
    return new $factoryClass();
  }

}
