<?php

namespace Drakythe\Ember\Discord;

use Discord\Discord;
use Discord\Parts\User\Member;

class DiscordGuildMember {

  /**
   * @var \Discord\Discord
   */
  protected $discord;

  /**
   * @var array
   */
  protected $config;

  /**
   * DiscordGuildMember constructor.
   */
  public function __construct(Discord $discord, array $config) {
    $this->discord = $discord;
    $this->config = $config;
  }

  public function onGuildMemberAdd(Member $member) {
    if (!empty($this->config['greeting'])) {
      /** @var \Discord\Parts\User\User $user */
      $user = $member->user;
      $channel = $this->discord->guilds->get('id', $member->guild_id)->channels->getAll('type', 0)
        ->first();
      $channel->sendMessage("<@{$user->id}> {$this->config['greeting']}");
    }
  }

}
