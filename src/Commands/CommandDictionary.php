<?php

namespace Drakythe\Ember\Commands;

use EclipseGc\Plugin\Dictionary\PluginDictionaryInterface;
use EclipseGc\Plugin\Factory\FactoryResolverInterface;
use EclipseGc\Plugin\Traits\PluginDictionaryTrait;
use EclipseGc\PluginAnnotation\Discovery\AnnotatedPluginDiscovery;

class CommandDictionary implements PluginDictionaryInterface {
  use PluginDictionaryTrait;


  /**
   * CommandDictionary constructor.
   *
   * @param \Traversable $namespaces
   *   A traversable list of namespaces and directories.
   * @param \EclipseGc\Plugin\Factory\FactoryResolverInterface $resolver
   *   The factory resolver.
   */
  public function __construct(\Traversable $namespaces, FactoryResolverInterface $resolver) {
    $this->discovery = new AnnotatedPluginDiscovery($namespaces, 'Commands', 'Drakythe\Ember\Commands\CommandInterface', 'Drakythe\Ember\Annotation\Command');
    $this->factoryClass = 'Drakythe\Ember\Factory\CommandFactory';
    $this->factoryResolver = $resolver;
    $this->pluginType = 'ember_commands';
  }

}
