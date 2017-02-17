<?php

namespace Drakythe\Ember\Commands;

use DiceCalc\Calc;
use Discord\Parts\Channel\Message;
use Drakythe\Ember\Annotation\Command;

/**
 * @Command(
 *   pluginId = "roll",
 *   expression = "/^roll: (\d+d\d+[\+*\d]*)|(^roll: (\d+))/mi",
 *   help = "roll: <dice and modifier>: Returns results of <dice>. Example 'roll: 2d4+6'"
 * )
 */
class RollCommand extends CommandBase {

  /**
   * {@inheritdoc}
   */
  public function execute(Message $message) {
    foreach ($this->matches[1] as $match) {
      if ($match[1] == -1) {
        continue;
      }
      $match = $match[0];
      $calc = new Calc($match);
      $message->reply("Rolling {$calc->infix()} Result is: {$calc()}");
    }
    foreach (array_filter($this->matches[3]) as $match) {
      $var = rand(1, $match[0]);
      $message->reply("Result: $var");
    }
  }

}
