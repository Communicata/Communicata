<?php

namespace Drakythe\Ember\Annotation;

use EclipseGc\PluginAnnotation\Definition\AnnotatedPluginDefinition;

class Command extends AnnotatedPluginDefinition {

  /**
   * A help text for display when the help command is invoked.
   *
   * @var string
   */
  protected $help;

  /**
   * A regular expression for matching a command.
   *
   * @var string
   */
  protected $expression;

  /**
   * Gets the regular expression for pattern matching.
   *
   * @return string
   */
  public function getExpression() {
    return $this->expression;
  }

  /**
   * Gets the help text.
   *
   * @return string
   */
  public function getHelp() {
    return $this->help;
  }

}
