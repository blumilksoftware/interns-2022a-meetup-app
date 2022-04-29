<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table("organizations", function (Blueprint $table): void {
            $table->integer("number_of_employers")->change();
        });

        Schema::table("organizations", function (Blueprint $table): void {
            $table->renameColumn("number_of_employers", "number_of_employees");
        });
    }

    public function down(): void
    {
        Schema::table("organizations", function (Blueprint $table): void {
            $table->string("number_of_employees")->change();
        });

        Schema::table("organizations", function (Blueprint $table): void {
            $table->renameColumn("number_of_employees", "number_of_employers");
        });
    }
};
