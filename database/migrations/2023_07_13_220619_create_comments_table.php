<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            //Isso aplica um constraint nessa tabela
            $table->foreignId('post_id')->constrained()->cascadeOnDelete(); //ON DELETE CASCADE
            //Outra forma de fazer a mesma coisa. O tipo da coluna precisa ser o mesmo da chave estrangeira.
            $table->unsignedBigInteger('user_id');

            $table->text('body');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
