<?php

use Drakythe\Ember\Commands\CommandDictionary;
use Drakythe\Ember\Discord\DiscordGuildMember;
use Drakythe\Ember\Discord\DiscordMessage;
use Drakythe\Ember\Discord\DiscordReady;
use Drakythe\Ember\Factory\FactoryResolver;
use Symfony\Component\DependencyInjection\Reference;


$container->register('command.factory.resolver', FactoryResolver::class)
  ->addArgument(new Reference('service_container'));

$container->register('dictionary.command', CommandDictionary::class)
  ->addArgument('%namespaces%')
  ->addArgument(new Reference('command.factory.resolver'));

$container->register('discord.ready', DiscordReady::class)
  ->addArgument('%configuration%');

$container->register('discord.message', DiscordMessage::class)
  ->addArgument(new Reference('dictionary.command'));

$container->register('discord.guild.member', DiscordGuildMember::class)
  ->addArgument('%discord%')
  ->addArgument('%configuration%');
