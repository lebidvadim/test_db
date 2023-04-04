<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\Artisan::call('db:seed',['--class' => 'ContactTypesSeeder']);
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_types');
    }
};
