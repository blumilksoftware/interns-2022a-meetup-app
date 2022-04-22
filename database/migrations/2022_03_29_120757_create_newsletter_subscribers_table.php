<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("newsletter_subscribers", function (Blueprint $table): void {
            $table->id();
            $table->string("email")->unique();
            $table->boolean("subscribed")->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("newsletter_subscribers");
    }
};
