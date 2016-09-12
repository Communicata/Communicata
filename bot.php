<?php

include __DIR__.'/vendor/autoload.php';
include __DIR__.'/commands.php';

$discord = new \Discord\Discord([
    'token' => '',
]);


$discord->on('ready', function ($discord) {
    echo "Bot is ready.", PHP_EOL;

    // Listen for events here
    $discord->on('message', function ($message) {
        echo "Recieved a message from {$message->author->username}: {$message->content}", PHP_EOL;
      
      // Command Triggers
      if (strpos($message->content, '-e') === 0) {
        echo "Ember command triggered", PHP_EOL;
        $contents = explode(' ', $message->content);
        switch(preg_replace('/[^\da-z]/i', '', $contents[1])) {
          case 'help':
            $response = bot_set_help($message->author);
            break;
          case 'roll':
            echo "Triggering roll", PHP_EOL;
            $result = bot_roll($contents);
            $message->reply('Rolling out of ' . $result['max'] . '. The result is: ' . $result['result']);
            break;
          case 'choice':
            $result = bot_choice($contents);
            $message->reply('I choose: ' . $result);
            break;
          case '8ball':
            $result = bot_ball();
            $message->reply($result);
            break;
          case 'dice':
            $result = bot_dice($contents);
            $message->reply("Rolling " . $result['calculation'] . ". Result is: " . $result['result']);
            break;
          default:
            $message->reply("I'm sorry, I don't know that command.");
            break;
        }
      }
    });
});

$discord->run();
