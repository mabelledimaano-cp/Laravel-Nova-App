<?php

use App\Models\Director;
use App\Models\Genre;
use App\Models\Studio;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignIdFor(Genre::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Genre::class, 'subgenre_id')->nullable()->constrained('genres')->nullOnDelete();
            $table->foreignIdFor(Director::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Studio::class)->constrained()->cascadeOnDelete();
            $table->integer('year');
            $table->string('description')->nullable();
            $table->integer('rating_out_of_five');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
