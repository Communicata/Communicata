<?php

namespace Drakythe\Ember\Commands;

use Drakythe\Ember\Annotation\Command;
use EclipseGc\Plugin\Traits\PluginTrait;

abstract class CommandBase implements CommandInterface {
  use PluginTrait;

  /**
   * @var array
   */
  protected $matches;

  /**
   * CommandBase constructor.
   *
   * @param \Drakythe\Ember\Annotation\Command $definition
   *   The command plugin definition.
   */
  public function __construct(Command $definition) {
    $this->definition = $definition;
  }

  public function match(string $message): bool {
    $matches = [];
    /** @var \Drakythe\Ember\Annotation\Command $definition */
    $definition = $this->getPluginDefinition();
    preg_match_all($definition->getExpression(), $message, $matches, PREG_OFFSET_CAPTURE);
    if (array_filter($matches)) {
      $this->matches = $matches;
      return TRUE;
    }
    return FALSE;
  }

}

