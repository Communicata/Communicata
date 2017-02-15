<?php

namespace Drakythe\Ember\Factory;

use EclipseGc\Plugin\Factory\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

interface ContainerAwareFactoryInterface extends FactoryInterface {

  /**
   * Instantiates a new instance of this factory with relevant dependencies.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   The dependency injection container.
   *
   * @return static
   *   A new instance of this factory.
   */
  public static function create(ContainerInterface $container);

}
