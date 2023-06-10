<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\artisan;
use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

test('database has admin data', function () {
    artisan('db:seed');

    assertDatabaseHas('users', [
        'name' => 'Admin',
        'email' => 'admin@admin.com'
    ]);
});
