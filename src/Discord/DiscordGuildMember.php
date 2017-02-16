<?php

namespace Drakythe\Ember\Discord;

use Discord\Parts\User\Member;

class DiscordGuildMember {

  public function onGuildMemberAdd(Member $member) {
    print_r($member);
    echo "New user joined";
    $user = $member->user;
    print_r($user);

    //stuff here
  }

}
