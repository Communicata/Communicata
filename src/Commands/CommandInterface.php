<?php

namespace Drakythe\Ember\Commands;

use Discord\Parts\Channel\Message;
use EclipseGc\Plugin\PluginInterface;

interface CommandInterface extends PluginInterface {

  /**
   * Matches messages to commands.
   *
   * @param string $message
   *   The message that should be matched.
   *
   * @return bool
   *   Whether the message matches a command's expectations.
   */
  public function match(string $message) : bool ;

  /**
   * Executes the command based on the matched message.
   *
   * @param \Discord\Parts\Channel\Message $message
   *   The matched message.
   */
  public function execute(Message $message);

}
