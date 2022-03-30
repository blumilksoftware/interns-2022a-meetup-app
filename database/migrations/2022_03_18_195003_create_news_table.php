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
            $table->foreignId("author")->constrained()->onDelete("cascade");
            $table->string("name");
            $table->text("content");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("news");
    }
};
