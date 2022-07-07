<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("user_2fa_codes", function (Blueprint $table): void {
            $table->id();
            $table->integer("user_id");
            $table->string("code");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("user_2fa_codes");
    }
};
