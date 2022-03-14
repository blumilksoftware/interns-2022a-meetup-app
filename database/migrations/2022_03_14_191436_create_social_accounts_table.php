<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("social_accounts", function (Blueprint $table): void {
            $table->id();
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->string("provider");
            $table->string("provider_id");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("social_accounts");
    }
};
