<?php

use App\Models\Venue;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Venue::class)->constrained('venues')->restrictOnDelete();
            $table->string('slug')->unique();
            $table->string('title');
            $table->dateTime('date');
            $table->text('description')->nullable();
            $table->integer('price')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('type');
            $table->boolean('published')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
