<?php

namespace Drakythe\Ember\Commands;

use Discord\Parts\Channel\Message;
use Drakythe\Ember\Annotation\Command;

/**
 * @Command(
 *   pluginId = "eight_ball",
 *   expression = "/^8ball: [\w\s]+\?$/mi",
 *   help = "8ball: Try your luck and ask the bot a question. Example: '8ball: Should I order takeout?'"
 * )
 */
class EightBallCommand extends CommandBase {

  /**
   * {@inheritdoc}
   */
  public function execute(Message $message) {
    $answers = [
      'It is certain',
      'It is decidedly so',
      'Without a doubt',
      'Yes, definitely',
      'You may rely on it',
      'As I see it, yes',
      'Most likely',
      'Outlook good',
      'Yes',
      'Signs point to yes',
      'Reply hazy try again',
      'Ask again later',
      'Better not tell you now',
      'Cannot predict now',
      'Concentrate and ask again',
      'Don\'t count on it',
      'My reply is no',
      'My sources say no',
      'Outlook not so good',
      'Very doubtful',
    ];

    $choice = rand(0, count($answers) - 1);

    return $answers[$choice];
  }

}
