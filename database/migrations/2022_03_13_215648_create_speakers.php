<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("speakers", function (Blueprint $table): void {
            $table->id();
            $table->string("name");
            $table->text("description")->nullable();
            $table->string("avatar")->unique()->nullable();
            $table->string("linkedin_url")->nullable();
            $table->string("github_url")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("speakers");
    }
};
