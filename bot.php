<?php

use Discord\WebSockets\Event;
use Drakythe\Ember\Bootstrap;
use EclipseGc\Plugin\Namespaces;
use Symfony\Component\DependencyInjection\ContainerBuilder;

$autoloader = include __DIR__.'/vendor/autoload.php';

$container = new ContainerBuilder();
$container->setParameter('autoloader', $autoloader);
// Extract namespaces to find any available plugins.
$container->setParameter('namespaces', Namespaces::extractNamespaces($autoloader));
$container->setParameter('configuration', include __DIR__.'/config.php');

Bootstrap::collectServices($container, $container->getParameter('namespaces'));

$discord = new \Discord\Discord([
    'token' => $container->getParameter('configuration')['token'],
]);

$container->setParameter('discord', $discord);

$discord->on('ready', [$container->get('discord.ready'), 'onReady']);
$discord->on('message', [$container->get('discord.message'), 'onMessage']);
$discord->on(Event::GUILD_MEMBER_ADD, [$container->get('discord.guild.member'), 'onGuildMemberAdd']);
$discord->run();
