<?php

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('stores a new user', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)->post('/admin/users', [
        'name' => 'User Baru',
        'email' => 'baru@example.com',
        'role' => 'admin',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ])->assertRedirect(route('admin.users.index'));

    $user = User::where('email', 'baru@example.com')->first();

    expect($user->name)->toBe('User Baru')
        ->and($user->role)->toBe(UserRole::Admin);
});

it('validates the store form', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)->from('/admin/users/create')
        ->post('/admin/users', ['name' => '', 'email' => 'bukan-email', 'role' => 'superadmin', 'password' => ''])
        ->assertSessionHasErrors(['name', 'email', 'role', 'password']);
});

it('updates a user and keeps the old password when it is blank', function () {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create(['email' => 'lama@example.com']);
    $oldPassword = $user->password;

    $this->actingAs($admin)->put("/admin/users/{$user->id}", [
        'name' => 'Nama Baru',
        'email' => 'lama@example.com',
        'role' => 'admin',
        'password' => '',
    ])->assertRedirect(route('admin.users.index'));

    $user->refresh();

    expect($user->name)->toBe('Nama Baru')
        ->and($user->role)->toBe(UserRole::Admin)
        ->and($user->password)->toBe($oldPassword);
});

it('prevents an admin from demoting their own account', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)->put("/admin/users/{$admin->id}", [
        'name' => $admin->name,
        'email' => $admin->email,
        'role' => 'user',
    ])->assertSessionHasErrors('role');

    expect($admin->fresh()->role)->toBe(UserRole::Admin);
});

it('prevents an admin from deleting their own account', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)->delete("/admin/users/{$admin->id}")
        ->assertRedirect(route('admin.users.index'))
        ->assertSessionHas('error');

    $this->assertDatabaseHas('users', ['id' => $admin->id]);
});

it('deletes another user', function () {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create();

    $this->actingAs($admin)->delete("/admin/users/{$user->id}")
        ->assertRedirect(route('admin.users.index'));

    $this->assertDatabaseMissing('users', ['id' => $user->id]);
});
