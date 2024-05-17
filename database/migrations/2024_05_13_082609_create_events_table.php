<?php

use App\Models\Event;
use App\Models\User;
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
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('event_user', function (Blueprint $table) {
            $table->primary(['event_id', 'user_id']);
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Event::class)->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
