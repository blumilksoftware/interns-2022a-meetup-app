<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table("users", function (Blueprint $table): void {
            $table->string("location")->nullable();
            $table->date("birthday")->nullable();
            $table->string("gender")->nullable();
        });
    }

    public function down(): void
    {
        Schema::table("users", function (Blueprint $table): void {
            $table->dropColumn("location");
            $table->dropColumn("birthday");
            $table->dropColumn("gender");
        });
    }
};
