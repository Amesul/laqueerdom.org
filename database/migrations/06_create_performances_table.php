<?php

use App\Models\Show;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('performances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained('users')->cascadeOnDelete();
            $table->foreignIdFor(Show::class)->constrained('shows')->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->string('title')->default('Performance vierge');
            $table->text('description')->nullable();
            $table->text('stage_requirements')->nullable();
            $table->text('others')->nullable();
            $table->time('duration')->nullable();
            $table->string('file')->nullable();
            $table->integer('order')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('performances');
    }
};
