<?php

use Drakythe\Ember\Commands\CommandDictionary;
use Drakythe\Ember\Factory\FactoryResolver;


$container->register('command.factory.resolver', FactoryResolver::class)
  ->addArgument('service_container');

$container->register('dictionary.command', CommandDictionary::class)
  ->addArgument('%namespaces%', '@command.factory.resolver');