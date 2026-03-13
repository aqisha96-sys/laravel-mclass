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
        Schema::create('watchlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //if user is deleted, delete their watchlist items too
            $table->unsignedBigInteger('movie_id'); // TMDB movie ID
            $table->string('title');
            $table->string('poster_path')->nullable();
            $table->decimal('vote_average', 4, 2)->nullable(); // e.g. 8.5
            $table->date('release_year')->nullable();
            $table->boolean('watched')->default(false); // new column to track if user has watched the movie
            $table->timestamps();

            //one user can only have a movie in their watchlist once
            $table->unique(['user_id', 'movie_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('watchlists');
    }
};
