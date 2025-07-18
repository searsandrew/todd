<?php

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Multicaret\Acquaintances\Models\Friendship;

Route::get('/all', function(): Collection {
    return Auth::user()->getAllFriendships();
})->name('all');

Route::get('/pending', function(): Collection {
    return Auth::user()->getPendingFriendships();
})->name('pending');

Route::get('/accepted', function(): Collection {
    return Auth::user()->getAcceptedFriendships();
})->name('accepted');

Route::get('/denied', function(): Collection {
    return Auth::user()->getDeniedFriendships();
})->name('denied');

Route::get('/blocked', function(): Collection {
    return Auth::user()->getBlockedFriendships();
})->name('blocked');

Route::get('/requests', function(): Collection {
    return Auth::user()->getFriendRequests();
})->name('requests');

Route::get('/requests#count', function(): Collection {
    return Auth::user()->getPendingsCount();
})->name('requests.count');

Route::get('/count', function(): Collection {
    return Auth::user()->getFriendsCount();
})->name('count');

Route::get('/{friend}', function(User $friend): User {
    return Auth::user()->getFriendship($friend);
})->name('get');

Route::post('/request/{friend}', function(User $friend): Friendship {
    return Auth::user()->befriend($friend);
})->name('request');

Route::post('/accept/{friend}', function(User $friend): Friendship {
    return Auth::user()->acceptFriendRequest($friend);
})->name('accept');

Route::post('/deny/{friend}', function(User $friend): Friendship {
    return Auth::user()->denyFriendRequest($friend);
})->name('deny');

Route::post('/remove/{friend}', function(User $friend): Friendship {
    return Auth::user()->unfriend($friend);
})->name('remove');

Route::post('/block/{friend}', function(User $friend): Friendship {
    return Auth::user()->blockFriend($friend);
})->name('block');

Route::post('/unblock/{friend}', function(User $friend): Friendship {
    return Auth::user()->unblockFriend($friend);
})->name('unblock');
