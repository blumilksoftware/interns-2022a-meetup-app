<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('organizations', function (Blueprint $table): void {
            $table->dropColumn("website_url");
            $table->dropColumn("facebook_url");
            $table->dropColumn("linkedin_url");
            $table->dropColumn("instagram_url");
            $table->dropColumn("youtube_url");
            $table->dropColumn("twitter_url");
            $table->dropColumn("github_url");
        });
    }

    public function down()
    {
        Schema::table('organizations', function (Blueprint $table): void {
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
