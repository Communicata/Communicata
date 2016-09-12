<?php
/**
 * Created by PhpStorm.
 * User: timhouseman
 * Date: 9/10/16
 * Time: 2:56 PM
 */

function bot_send_help($author) {
  $pm = $author->getPrivateChannel();
  $pm->sendMessage("Hi!");
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

  require_once __DIR__ . '/dicecalc/src/DiceCalc/Calc.php';
  require_once __DIR__ . '/dicecalc/src/DiceCalc/CalcSet.php';
  require_once __DIR__ . '/dicecalc/src/DiceCalc/CalcDice.php';
  require_once __DIR__ . '/dicecalc/src/DiceCalc/CalcOperation.php';
  require_once __DIR__ . '/dicecalc/src/DiceCalc/Random.php';

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