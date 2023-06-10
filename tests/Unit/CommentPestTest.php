<?php

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a comment belongs to a user', function () {
    $user = User::factory()->create();
    $comment = Comment::factory()->create([
        'user_id' => $user->id
    ]);

    expect($comment->user)->toBeInstanceOf(User::class);
});
