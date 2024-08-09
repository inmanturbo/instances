<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('instances', function (Blueprint $table) {
            $table->id();

            $table->string('event_version')->default('1.0.0');
            $table->string('event');

            $table->string('model');
            $table->string('key', 40);
            $table->bigInteger('tally')->default(1);

            $table->string('property');
            $table->longText('value')->nullable();
            $table->json('values');

            $table->timestamps();

            $table->unique(['key', 'tally']);
        });

        Schema::create('instance_snapshots', function (Blueprint $table) {
            $table->id();
            $table->string('class');
            $table->string('key', 40);
            $table->bigInteger('tally')->default(1);
            $table->foreignId('instance_id');
            $table->json('values');
        });
    }
};
