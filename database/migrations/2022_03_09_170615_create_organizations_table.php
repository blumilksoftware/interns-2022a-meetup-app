<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("organizations", function (Blueprint $table): void {
            $table->id();
            $table->string("name");
            $table->text("description")->nullable();
            $table->string("location");
            $table->string("organization_type");
            $table->dateTime("foundation_date");
            $table->string("number_of_employees");
            $table->string("logo");
            $table->string("website_url")->nullable();
            $table->string("facebook_url")->nullable();
            $table->string("linkedin_url")->nullable();
            $table->string("instagram_url")->nullable();
            $table->string("youtube_url")->nullable();
            $table->string("twitter_url")->nullable();
            $table->string("github_url")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("organizations");
    }
};
