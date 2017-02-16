<?php

namespace Drakythe\Ember\Factory;

use Drakythe\Ember\Commands\CommandDictionary;
use EclipseGc\Plugin\PluginDefinitionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HelpFactory implements ContainerAwareFactoryInterface {

  /**
   * @var \Drakythe\Ember\Commands\CommandDictionary
   */
  protected $dictionary;

  /**
   * HelpFactory constructor.
   *
   * @param \Drakythe\Ember\Commands\CommandDictionary $dictionary
   *   The command dictionary.
   */
  public function __construct(CommandDictionary $dictionary) {
    $this->dictionary = $dictionary;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static($container->get('dictionary.command'));
  }

  /**
   * {@inheritdoc}
   */
  public function createInstance(PluginDefinitionInterface $definition, ...$constructors) {
    $class = $definition->getClass();
    return new $class($definition, $this->dictionary);
  }

}
