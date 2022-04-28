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
            $table->integer("meetup_id")->unsigned();
            $table->integer("speaker_id")->unsigned();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("meetup_speaker");
    }
};
