<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("meetup_speaker", function (Blueprint $table): void {
            $table->id();
            $table->foreignId("meetup_id")->constrained()->onDelete("cascade");
            $table->foreignId("speaker_id")->constrained()->onDelete("cascade");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("meetup_speaker");
    }
};
