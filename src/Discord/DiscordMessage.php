<?php

namespace Drakythe\Ember\Discord;

use Discord\Parts\Channel\Message;
use Drakythe\Ember\Commands\CommandDictionary;

class DiscordMessage {

  /**
   * @var \Drakythe\Ember\Commands\CommandInterface[]
   */
  protected $commands = [];


  /**
   * DiscordMessage constructor.
   *
   * @param \Drakythe\Ember\Commands\CommandDictionary $dictionary
   *   The command dictionary.
   */
  public function __construct(CommandDictionary $dictionary) {

    foreach ($dictionary->getDefinitions() as $command) {
      $this->commands[] = $dictionary->createInstance($command->getPluginId());
    }
  }

  public function onMessage(Message $message) {
    echo "Received a message from {$message->author->username}: {$message->content}", PHP_EOL;

    foreach ($this->commands as $command) {
      if ($command->match($message->content)) {
        $command->execute($message);
      }
    }
  }
}