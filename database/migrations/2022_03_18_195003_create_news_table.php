<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("news", function (Blueprint $table): void {
            $table->id();
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->string("title");
            $table->longText("text");
            $table->string("slug")->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("news");
    }
};
