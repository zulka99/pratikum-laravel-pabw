<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('lets an admin open the user management page', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)->get('/admin/users')
        ->assertOk()
        ->assertSee('Kelola User');
});

it('forbids a regular user from opening the user management page', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get('/admin/users')->assertForbidden();
});

it('redirects guests from the user management page', function () {
    $this->get('/admin/users')->assertRedirect('/login');
});

it('lets both roles open the registration page', function (string $state) {
    $user = $state === 'admin' ? User::factory()->admin()->create() : User::factory()->create();

    $this->actingAs($user)->get('/pendaftaran')->assertOk();
})->with(['admin', 'user']);
