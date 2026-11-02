<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Modules\Pendaftaran\Models\Daftar;

uses(RefreshDatabase::class);

function payload(array $override = []): array
{
    return array_merge([
        'nama' => 'Budi Santoso',
        'asal_sekolah' => 'SMA Negeri 1 Bandung',
        'prodi_tujuan' => 'Informatika',
        'email' => 'budi@example.com',
        'no_hp' => '081234567890',
    ], $override);
}

it('returns every registration as JSON', function () {
    $user = App\Models\User::factory()->create();
    Daftar::factory()->count(3)->create();

    $this->actingAs($user)->getJson('/pendaftaran/data')
        ->assertOk()
        ->assertJsonCount(3);
});

it('stores a registration with an uploaded file', function () {
    Storage::fake('public');
    $user = App\Models\User::factory()->create();

    $this->actingAs($user)
        ->postJson('/pendaftaran', payload(['berkas' => UploadedFile::fake()->image('rapor_budi.png')]))
        ->assertOk()
        ->assertJsonPath('success', 'Data berhasil disimpan.');

    $daftar = Daftar::first();

    expect($daftar->nama_berkas)->toBe('rapor_budi.png')
        ->and($daftar->berkas)->not->toBeNull()
        ->and($daftar->berkas_url)->toContain('/storage/');

    Storage::disk('public')->assertExists($daftar->berkas);
});

it('rejects an empty form with a 422 response', function () {
    $user = App\Models\User::factory()->create();

    $this->actingAs($user)->postJson('/pendaftaran', [])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['nama', 'asal_sekolah', 'prodi_tujuan', 'email', 'no_hp', 'berkas']);
});

it('rejects a zip file', function () {
    Storage::fake('public');
    $user = App\Models\User::factory()->create();

    $this->actingAs($user)
        ->postJson('/pendaftaran', payload(['berkas' => UploadedFile::fake()->create('data.zip', 100)]))
        ->assertStatus(422)
        ->assertJsonValidationErrors('berkas');

    $this->assertDatabaseCount('daftars', 0);
});

it('rejects a file larger than 2 MB', function () {
    Storage::fake('public');
    $user = App\Models\User::factory()->create();

    $this->actingAs($user)
        ->postJson('/pendaftaran', payload(['berkas' => UploadedFile::fake()->image('besar.png')->size(3000)]))
        ->assertStatus(422)
        ->assertJsonValidationErrors('berkas');
});

it('rejects a duplicate email', function () {
    Storage::fake('public');
    $user = App\Models\User::factory()->create();
    Daftar::factory()->create(['email' => 'budi@example.com']);

    $this->actingAs($user)
        ->postJson('/pendaftaran', payload(['berkas' => UploadedFile::fake()->image('a.png')]))
        ->assertStatus(422)
        ->assertJsonValidationErrors('email');
});

it('returns a single registration for editing', function () {
    $user = App\Models\User::factory()->create();
    $daftar = Daftar::factory()->create();

    $this->actingAs($user)->getJson("/pendaftaran/{$daftar->id}/edit")
        ->assertOk()
        ->assertJsonPath('nama', $daftar->nama);
});

it('returns 404 for an unknown registration', function () {
    $user = App\Models\User::factory()->create();

    $this->actingAs($user)->getJson('/pendaftaran/9999/edit')->assertNotFound();
});

it('replaces the old file when a new one is uploaded', function () {
    Storage::fake('public');
    $user = App\Models\User::factory()->create();

    $this->actingAs($user)->postJson('/pendaftaran', payload([
        'berkas' => UploadedFile::fake()->image('rapor_budi.png'),
    ]))->assertOk();

    $daftar = Daftar::first();
    $oldPath = $daftar->berkas;

    $this->actingAs($user)->putJson("/pendaftaran/{$daftar->id}", payload([
        'prodi_tujuan' => 'Sistem Informasi',
        'berkas' => UploadedFile::fake()->create('surat_keterangan_lulus.pdf', 20, 'application/pdf'),
    ]))->assertOk();

    $daftar->refresh();

    expect($daftar->prodi_tujuan)->toBe('Sistem Informasi')
        ->and($daftar->nama_berkas)->toBe('surat_keterangan_lulus.pdf')
        ->and($daftar->berkas)->not->toBe($oldPath);

    Storage::disk('public')->assertMissing($oldPath);
    Storage::disk('public')->assertExists($daftar->berkas);
});

it('keeps the old file when the update has no new upload', function () {
    Storage::fake('public');
    $user = App\Models\User::factory()->create();

    $this->actingAs($user)->postJson('/pendaftaran', payload([
        'berkas' => UploadedFile::fake()->image('rapor_budi.png'),
    ]))->assertOk();

    $daftar = Daftar::first();
    $oldPath = $daftar->berkas;

    $this->actingAs($user)->putJson("/pendaftaran/{$daftar->id}", payload(['prodi_tujuan' => 'Teknik Elektro']))
        ->assertOk();

    expect($daftar->fresh()->berkas)->toBe($oldPath);
    Storage::disk('public')->assertExists($oldPath);
});

it('deletes a registration and its file', function () {
    Storage::fake('public');
    $user = App\Models\User::factory()->create();

    $this->actingAs($user)->postJson('/pendaftaran', payload([
        'berkas' => UploadedFile::fake()->image('rapor_budi.png'),
    ]))->assertOk();

    $daftar = Daftar::first();

    $this->actingAs($user)->deleteJson("/pendaftaran/{$daftar->id}")
        ->assertOk()
        ->assertJsonPath('success', 'Data berhasil dihapus.');

    $this->assertDatabaseCount('daftars', 0);
    Storage::disk('public')->assertMissing($daftar->berkas);
});
