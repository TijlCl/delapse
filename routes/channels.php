<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('comment', function () {
    return true;
});

Broadcast::channel('message.{to}', function ($user, int $to) {
    return $user->id === $to;
});

Broadcast::channel('group-message.{chatId}', function ($user, int $chatId) {
    return \App\Models\ChatGroup::where('id', $chatId)->whereHas('users', function ($query) use ($user) {
        $query->where('users.id', '=', $user->id);
    })->count() === 1;
});
