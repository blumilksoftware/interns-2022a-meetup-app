<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("meetups", function (Blueprint $table): void {
            $table->id();
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->string("title");
            $table->text("description")->nullable();
            $table->dateTime("date");
            $table->string("place");
            $table->string("language");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("meetups");
    }
};
