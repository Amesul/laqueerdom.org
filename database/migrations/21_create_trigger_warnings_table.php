<?php

use App\Models\Performance;
use App\Models\TriggerWarning;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('trigger_warnings', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('performance_trigger_warning', function (Blueprint $table) {
            $table->primary(['trigger_warning_id', 'performance_id']);
            $table->foreignIdFor(TriggerWarning::class);
            $table->foreignIdFor(Performance::class);
        });
    }
};
