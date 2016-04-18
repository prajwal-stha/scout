<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Attempting;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

/**
 * Class LogAuthenticationAttempt
 * @package App\Listeners
 */
class LogAuthenticationAttempt
{
    public $user;
    /**
     * LogAuthenticationAttempt constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * @param Attempting $event
     * @return bool
     */
    public function handle(Attempting $event)
    {
        $user = User::whereUsername($event->credentials['username'])->firstOrFail();
        if($user->verified != 1){
            return view('auth.login');
        }
    }
}
