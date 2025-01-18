<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodosTable extends Migration
{
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('priority', ['high', 'normal', 'low']);
            $table->enum('status', ['active', 'completed', 'skipped'])->default('active');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Assuming a user is related to each todo
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('todos');
    }
}
