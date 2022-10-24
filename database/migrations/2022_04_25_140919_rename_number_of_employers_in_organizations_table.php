<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        DB::statement('ALTER TABLE organizations ALTER COLUMN 
                  number_of_employers TYPE integer USING (number_of_employers)::integer');

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
