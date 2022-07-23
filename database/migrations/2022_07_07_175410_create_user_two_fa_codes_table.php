<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("user_two_fa_codes", function (Blueprint $table): void {
            $table->id();
            $table->foreignId("user_id")
                ->references("id")->on("users")
                ->onDelete("cascade");
            $table->string("code");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("user_two_fa_codes");
    }
};
