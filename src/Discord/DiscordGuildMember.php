<?php

namespace Drakythe\Ember\Discord;

class DiscordGuildMember {

  public function onGuildMemberAdd($info) {
    echo "New user joined";
    $user = $info->user;
    print_r($user);

    //stuff here
  }

}
