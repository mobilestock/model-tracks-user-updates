<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('test_models', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('updated_by_user')->nullable();
            $table->timestamps();
        });

        Schema::create('test_model_without_fillables', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });
    }
};
