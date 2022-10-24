<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    private const CONFIG_KEY_FOR_DEFAULT_DB = "database.default";

    public function up(): void
    {
        if (config(self::CONFIG_KEY_FOR_DEFAULT_DB) === "pgsql") {
            DB::statement("ALTER TABLE organizations ALTER COLUMN 
                  number_of_employers TYPE integer USING (number_of_employers)::integer");
        }

        if (config(self::CONFIG_KEY_FOR_DEFAULT_DB) === "sqlite") {
            Schema::table("organizations", function (Blueprint $table): void {
                $table->integer("number_of_employers")->change();
            });
        }

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
