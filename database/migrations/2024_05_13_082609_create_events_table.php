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
            $table->foreignIdFor(Venue::class)->constrained('venues');
            $table->string('title');
            $table->text('description');
            $table->dateTime('date');
            $table->integer('price');
            $table->string('thumbnail');
            $table->string('type');
            $table->timestamps();
        });

        Schema::table('event_user', function (Blueprint $table) {
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
