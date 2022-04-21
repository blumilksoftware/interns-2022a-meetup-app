<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("newsletter_preferences", function (Blueprint $table): void {
            $table->id();
            $table->foreignId("newsletter_subscriber_id")
                ->references("id")->on("newsletter_subscribers")
                ->onDelete("cascade");
            $table->string("preference");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("newsletter_preferences");
    }
};
