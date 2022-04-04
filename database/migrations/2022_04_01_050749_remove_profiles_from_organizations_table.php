<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::table("organizations", function (Blueprint $table): void {
            $table->dropColumn(["website_url", "facebook_url", "linkedin_url", "instagram_url", "youtube_url", "twitter_url", "github_url"]);
        });
    }

    public function down(): void
    {
        Schema::table("organizations", function (Blueprint $table): void {
            $table->string("website_url")->nullable();
            $table->string("facebook_url")->nullable();
            $table->string("linkedin_url")->nullable();
            $table->string("instagram_url")->nullable();
            $table->string("youtube_url")->nullable();
            $table->string("twitter_url")->nullable();
            $table->string("github_url")->nullable();
        });
    }
};
