<?php

namespace Drakythe\Ember\Discord;

use Discord\Discord;

class DiscordReady {

  /**
   * @var array
   */
  protected $config;

  public function __construct(array $config) {
    $this->config = $config;
  }

  public function onReady(Discord $discord) {
    echo "Bot is ready.", PHP_EOL;
    !empty($this->config['bot_nick']) ? $discord->username = $this->config['bot_nick'] : false;
    $discord->save();
  }

}
