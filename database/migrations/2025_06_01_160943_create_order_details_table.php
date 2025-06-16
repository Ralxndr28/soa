<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('kitchen_tasks', function (Blueprint $table) {
        $table->id('kitchen_task_id');
        $table->unsignedBigInteger('kitchen_id');
        $table->string('menu');
        $table->integer('quantity');
        $table->string('chef')->nullable();
        $table->enum('status', ['pending', 'cooking', 'done'])->default('pending');
        $table->text('notes')->nullable();
        $table->timestamps();

        $table->foreign('kitchen_id')->references('id')->on('kitchens')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kitchen_tasks');
    }
};
