<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("organization_profiles", function (Blueprint $table): void {
            $table->id();
            $table->foreignId("organization_id")->constrained()->onDelete("cascade");
            $table->string("link");
            $table->string("label");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("organization_profiles");
    }
};
