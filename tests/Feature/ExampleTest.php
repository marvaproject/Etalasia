<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('returns a successful response', function () {
    $this->withoutVite();

    $this->get('/')
        ->assertStatus(200)
        ->assertSee('Etalasia');
});
