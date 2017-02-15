<?php

namespace Drakythe\Ember\Commands;

use Discord\Parts\Channel\Message;
use Drakythe\Ember\Annotation\Command;

/**
 * @Command(
 *   pluginId = "help",
 *   expression = "/^help$/mi",
 *   help = "",
 *   factory = "\Drakythe\Ember\Factory\HelpFactory"
 * )
 */
class HelpCommand extends CommandBase {

  /**
   * @var \Drakythe\Ember\Commands\CommandDictionary
   */
  protected $dictionary;

  /**
   * HelpCommand constructor.
   *
   * @param \Drakythe\Ember\Annotation\Command $definition
   *   The command definition.
   * @param \Drakythe\Ember\Commands\CommandDictionary $dictionary
   *   The command dictionary.
   */
  public function __construct(Command $definition, CommandDictionary $dictionary) {
    parent::__construct($definition);
    $this->dictionary = $dictionary;
  }

  /**
   * {@inheritdoc}
   */
  public function execute(Message $message): string {
    $response = '```markdown';
    $response .= "\n";
    $response .= "#Available Commands:";
    $response .= "\n";
    $response .= "\n";
    /** @var Command $definition */
    foreach ($this->dictionary->getDefinitions() as $definition) {
      if ($definition->getPluginId() != 'help') {
        $response .= "{$definition->getHelp()}\n\n";
      }
    }
    $response .= '```';

    $message->reply("A list of available commands has been sent to your Private Messages");
    $author = $message->author->user;
    $author->sendMessage("$response");
  }

}