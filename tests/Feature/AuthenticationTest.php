<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('redirects guests from the dashboard to login', function () {
    $this->get('/dashboard')->assertRedirect('/login');
});

it('registers a new user as a regular user and logs them in', function () {
    $response = $this->post('/register', [
        'name' => 'Pendaftar Baru',
        'email' => 'pendaftar@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertRedirect('/dashboard');
    $this->assertAuthenticated();

    $user = User::where('email', 'pendaftar@example.com')->first();
    expect($user->role->value)->toBe('user');
});

it('rejects registration when the password is not confirmed', function () {
    $response = $this->from('/register')->post('/register', [
        'name' => 'Pendaftar Baru',
        'email' => 'pendaftar@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password-lain',
    ]);

    $response->assertSessionHasErrors('password');
    $this->assertGuest();
    $this->assertDatabaseMissing('users', ['email' => 'pendaftar@example.com']);
});

it('logs a user in with valid credentials', function () {
    $user = User::factory()->create(['email' => 'user@example.com']);

    $this->post('/login', ['email' => 'user@example.com', 'password' => 'password'])
        ->assertRedirect('/dashboard');

    $this->assertAuthenticatedAs($user);
});

it('rejects a wrong password', function () {
    User::factory()->create(['email' => 'user@example.com']);

    $this->from('/login')
        ->post('/login', ['email' => 'user@example.com', 'password' => 'salah'])
        ->assertSessionHasErrors('email');

    $this->assertGuest();
});

it('throttles login after five failed attempts', function () {
    User::factory()->create(['email' => 'user@example.com']);

    foreach (range(1, 5) as $attempt) {
        $this->from('/login')->post('/login', ['email' => 'user@example.com', 'password' => 'salah']);
    }

    $response = $this->from('/login')->post('/login', ['email' => 'user@example.com', 'password' => 'salah']);

    $response->assertSessionHasErrors('email');
    expect(session('errors')->first('email'))->toContain('Terlalu banyak percobaan login');
});

it('logs the user out', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post('/logout')->assertRedirect('/login');

    $this->assertGuest();
});
