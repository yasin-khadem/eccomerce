<?php

namespace App\Listeners;

use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Events\AccessTokenCreated;


class RevokeOldToken
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AccessTokenCreated  $event
     * @return void
     */
    public function handle(AccessTokenCreated $event)
    {
        try {
            DB::table('oauth_access_tokens')
                ->where('id', '<>', $event->tokenId)
                ->where('user_id', $event->userId)
                ->where('client_id', $event->clientId)
                ->update(['revoked' => true]);
        } catch (Exception $e) {
            dump($e);
        }
    }
}
