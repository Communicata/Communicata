<?php

use Drakythe\Ember\Commands\CommandDictionary;
use Drakythe\Ember\Factory\FactoryResolver;
use Symfony\Component\DependencyInjection\Reference;


$container->register('command.factory.resolver', FactoryResolver::class)
  ->addArgument(new Reference('service_container'));

$container->register('dictionary.command', CommandDictionary::class)
  ->addArgument('%namespaces%')
  ->addArgument(new Reference('command.factory.resolver'));

