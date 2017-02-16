<?php

use Discord\Parts\Channel\Message;
use Drakythe\Ember\Bootstrap;
use Drakythe\Ember\Commands\CommandInterface;
use EclipseGc\Plugin\Namespaces;
use Symfony\Component\DependencyInjection\ContainerBuilder;

$autoloader = include __DIR__.'/vendor/autoload.php';
$config = include __DIR__.'/config.php';

$container = new ContainerBuilder();
$container->setParameter('autoloader', $autoloader);
// Extract namespaces to find any available plugins.
$container->setParameter('namespaces', Namespaces::extractNamespaces($autoloader));

Bootstrap::collectServices($container, $container->getParameter('namespaces'));

$commands = [];
/** @var Drakythe\Ember\Commands\CommandDictionary $commandDictionary */
$commandDictionary = $container->get('dictionary.command');
/** @var \Drakythe\Ember\Annotation\Command $definition */
foreach ($commandDictionary as $definition) {
  $commands[] = $commandDictionary->createInstance($definition->getPluginId());
}

$discord = new \Discord\Discord([
    'token' => $config['token'],
]);

$discord->on('ready', function ($discord) use ($commands) {
    echo "Bot is ready.", PHP_EOL;
    !empty($config['bot_nick']) ? $discord->username = $config['bot_nick'] : false;
    $discord->save();
    print_r($discord->guilds);

    // Listen for events here
    $discord->on('message', function (Message $message) use ($commands) {
      echo "Recieved a message from {$message->author->username}: {$message->content}", PHP_EOL;

      foreach ($commands as $command) {
        if ($command->match($message->content)) {
          $command->execute($message);
        }
      }
    });
    $discord->on(\Discord\WebSockets\Event::GUILD_MEMBER_ADD, function ($info) use ($discord) {
      echo "New user joined";
      $user = $info->user;
      print_r($user);

      //stuff here
    });
});

$discord->run();
