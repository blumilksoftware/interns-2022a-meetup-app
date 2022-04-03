<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('organization_profiles', function (Blueprint $table): void {
            $table->id();
            $table->foreignId("organization_id")->constrained()->onDelete("cascade");
            $table->string("link");
            $table->string("label");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('organization_profiles');
    }
};
