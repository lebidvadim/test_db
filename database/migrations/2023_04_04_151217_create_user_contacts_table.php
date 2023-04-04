<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_contacts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('contact_type_id')->unsigned()->nullable();
            $table->string('value');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('contact_type_id')->references('id')->on('contact_types')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_contacts');
    }
};
