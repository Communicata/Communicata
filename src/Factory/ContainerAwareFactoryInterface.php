<?php

namespace Drakythe\Ember\Factory;

use EclipseGc\Plugin\Factory\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

interface ContainerAwareFactoryInterface extends FactoryInterface {

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *
   * @return mixed
   */
  public static function create(ContainerInterface $container);

}
