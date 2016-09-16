<?php
/**
 * Created by PhpStorm.
 * User: timhouseman
 * Date: 9/10/16
 * Time: 2:56 PM
 */

function bot_set_help() {
  $response = '```markdown';
  $response .= "\n";
  $response .= "#Available Commands:";
  $response .= "\n";
  $response .= "\n";
  $response .= "-e Roll <number>: Returns result between 1 and <number>. Example; '-e roll 100'";
  $response .= "\n";
  $response .= "\n";
  $response .= "-e dice <dice and modifier>: Returns results of <dice>. Example '-e dice 2d4 +6'";
  $response .= "\n";
  $response .= "\n";
  $response .= "-e choice <choice1; choice2; choice3; ...>: Returns a random choice from provided options. Example; '-e choice Chinese; Pizza; Chicken;'";
  $response .= "\n";
  $response .= "\n";
  $response .= "-e 8ball: Try your luck and ask the bot a question. Example '-e Hey bot, Should I order takeout?'";
  $response .= "\n";
  $response .= "\n";
  $response .= '```';

  return $response;
}

function bot_roll($contents) {
  echo "In bot Roll func", PHP_EOL;
  isset($contents[2]) && is_numeric($contents[2]) ? $max = $contents[2] : $max = 100;
  $result = [
    'max' => $max,
    'result' => rand(1, $max),
  ];
  return $result;
}

function bot_dice($contents) {
  /**
  if (count($contents) > 2) {
    if (stripos($contents[2], 'd') !== FALSE) {
      $dice = strtolower($contents[2]);
      $dice_roll = explode('d', $dice);
      $result = [];

      if (!is_numeric($dice_roll[0]) || !is_numeric($dice_roll[1])) {
        return('Error: I\'m Sorry I don\'t know how to roll that');
      }

      for ($i = 1; $i < $dice_roll[0]; $i++) {
        $result[] = rand(1, $dice_roll[1]);
      }

      if (isset($contents[3])) {
        if (substr($contents[3], 0) == '-' && strlen($contents[3]) > 1) {
          $modifier = '-';
        }
        else {
          $modifier = '+';
        }
      }
    }
  }
   */

  unset($contents[0], $contents[1]);
  $expression = implode(' ', $contents);
  $calc = new \DiceCalc\Calc($expression);

  echo $expression;
  echo PHP_EOL;
  echo $calc->infix();
  echo PHP_EOL;
  echo $calc();
  echo PHP_EOL;

  $result = [
    'calculation' => $calc->infix(),
    'result' => $calc(),
  ];

  return $result;
}

function bot_choice($contents) {
  unset($contents[0], $contents[1]);

  $full_string = implode($contents);
  $choices = explode(";", $full_string);

  $choice = rand(0, count($choices) - 1);

  return $choices[$choice];
}

function bot_ball() {
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