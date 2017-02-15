<?php

namespace Drakythe\Ember\Commands;

use DiceCalc\Calc;
use Discord\Parts\Channel\Message;

/**
 * @Command(
 *   pluginId = "roll",
 *   expression = "/^roll: (\dd\d+[\+*\d]*)/mi",
 *   help = "roll: <dice and modifier>: Returns results of <dice>. Example 'roll: 2d4+6'"
 * )
 */
class RollCommand extends CommandBase {

  /**
   * {@inheritdoc}
   */
  public function execute(Message $message) {
    $response = '';
    foreach ($this->matches[1] as $match) {
      $match = $match[0];
      $calc = new Calc($match);
      $response .= "Rolling {$calc->infix()} Result is: {$calc()}\n";
    }
    $message->reply($response);
  }

}
