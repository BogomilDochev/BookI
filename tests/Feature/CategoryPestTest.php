<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->user = User::factory()->create();

    $this->admin = User::factory()->create([
        'is_admin' => true
    ]);
});

test('admin can access all categories page', function () {
    actingAs($this->admin)
        ->get(route('admin.categories'))
        ->assertStatus(200);

    actingAs($this->user)
        ->get(route('admin.categories'))
        ->assertStatus(403);
});

test('admin can access add category page', function () {
    actingAs($this->admin)
        ->get(route('categories.create'))
        ->assertStatus(200);

    actingAs($this->user)
        ->get(route('categories.create'))
        ->assertStatus(403);
});

test('admin can access edit category page', function () {
    $category = Category::factory()->create();

    actingAs($this->admin)
        ->get(route('categories.edit', $category->id))
        ->assertStatus(200);

    actingAs($this->user)
        ->get(route('categories.edit', $category->id))
        ->assertStatus(403);
});

test('create category successfully', function () {
    $category = [
        'name' => 'Romance'
    ];

    actingAs($this->admin)
        ->post(route('categories.store'), $category)
        ->assertStatus(302)
        ->assertRedirect(route('admin.categories'));

    assertDatabaseHas('categories', $category);
});

test('update category successfully', function () {
    $category = Category::factory()->create();

    assertDatabaseHas('categories', ['name' => $category->name]);

    actingAs($this->admin)
        ->patch(route('categories.update', $category->id), [
            'name' => 'New Name'
            ])
        ->assertStatus(302)
        ->assertRedirect(route('admin.categories'));

    assertDatabaseHas('categories', ['name' => 'New Name']);
});

test('delete category', function () {
    $category = Category::factory()->create();

    assertDatabaseHas('categories', ['name' => $category->name]);

    actingAs($this->admin)
        ->delete(route('categories.delete', $category->id))
        ->assertStatus(302)
        ->assertRedirect(session()->previousUrl());

    assertDatabaseMissing('categories', ['name' => $category->name]);
});
