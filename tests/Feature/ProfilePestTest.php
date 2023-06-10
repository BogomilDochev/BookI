<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\delete;
use function Pest\Laravel\from;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;

uses(RefreshDatabase::class);

test('profile page is displayed', function () {
    actingAs(User::factory()->create());

    get(route('profile.edit'))->assertOk();
});

test('profile information can be updated', function () {
    actingAs($user = User::factory()->create());

    patch(route('profile.update'), [
        'name' => 'Test User',
        'email' => 'test@example.com'
    ])->assertSessionHasNoErrors()
      ->assertRedirect(route('profile.edit'));

    expect($user->fresh()->name)->toBe('Test User');
    expect($user->fresh()->email)->toBe('test@example.com');
    expect($user->email_verified_at)->toBeNull();
});

test('email verification status is unchanged when the email address is unchanged', function () {
    actingAs($user = User::factory()->create());

    patch(route('profile.update'), [
        'name' => 'Test User',
        'email' => $user->email
    ])->assertSessionHasNoErrors()
        ->assertRedirect(route('profile.edit'));

    expect($user->email_verified_at)->not()->toBeNull();
});

test('user can delete their account', function () {
    actingAs($user = User::factory()->create());

    delete(route('profile.destroy'), [
        'password' => 'password'
    ])->assertSessionHasNoErrors()
      ->assertRedirect(route('home'));

    assertGuest();
    expect($user->fresh())->toBeNull();
});

test('correct password must be provided to delete account', function () {
    actingAs($user = User::factory()->create());

    from(route('profile.edit'))->delete(route('profile.destroy'), [
        'password' => 'wrong-password'
    ])->assertSessionHasErrorsIn('userDeletion', 'password')
      ->assertRedirect(route('profile.edit'));

    expect($user->fresh())->not()->toBeNull();
});
