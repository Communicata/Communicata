<?php

namespace Drakythe\Ember\Commands;

use Discord\Parts\Channel\Message;
use Drakythe\Ember\Annotation\Command;

/**
 * @Command(
 *   pluginId = "choice",
 *   expression = "/^choice:((?: [\w ]+;)+)/mi",
 *   help = "choice: <choice1; choice2; choice3; ...>: Returns a random choice from provided options. Example: 'choice: Chinese; Pizza; Chicken;'"
 * )
 */
class ChoiceCommand extends CommandBase {

  /**
   * {@inheritdoc}
   */
  public function execute(Message $message) {
    $response = '';
    foreach ($this->matches[1] as $match) {
      $choices = explode('; ', trim($match[0], ';'));
      $choice = rand(0, count($choices) - 1);
      $response .= "I choose: $choices[$choice]}\n";
    }
    $message->reply($response);
  }

}
