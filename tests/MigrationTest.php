<?php

use Illuminate\Support\Facades\Schema;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

it('can create the instances table', function () {
    $this->artisan('instances:migrate')->assertExitCode(0);

    assertDatabaseHas('migrations', ['migration' => '2024_08_09_131035_create_instances_tables']);

    assertTrue(Schema::hasTable('instances'));
});

it('can run migrations with --fresh option', function () {
    $this->artisan('instances:migrate')->assertExitCode(0);
    $this->artisan('instances:migrate --fresh')->assertExitCode(0);

    assertDatabaseHas('migrations', ['migration' => '2024_08_09_131035_create_instances_tables']);

    assertTrue(Schema::hasTable('instances'));
});

it('can run migrations with --wipe option', function () {
    $this->artisan('instances:migrate')->assertExitCode(0);
    $this->artisan('instances:migrate --wipe')->assertExitCode(0);

    assertDatabaseMissing('migrations', ['migration' => '2024_07_07_131035_create_instances_table']);

    assertFalse(Schema::hasTable('instances'));
});

it('can run migrations with --log-only option', function () {
    $this->artisan('instances:migrate')->assertExitCode(0);
    $this->artisan('instances:migrate --wipe')->assertExitCode(0);
    $this->artisan('instances:migrate --log-only')->assertExitCode(0);

    assertDatabaseHas('migrations', ['migration' => '2024_08_09_131035_create_instances_tables']);

    assertFalse(Schema::hasTable('instances'));
});
