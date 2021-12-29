<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaravelLivewire2BannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laravel_livewire2_banners', function (Blueprint $table) {
            $table->id();
            $table->foreignId("element_id")->constrained("elements")->onDelete("cascade");
            $table->string("title");
            $table->longText("content");
            $table->string("vertical_align")->default("top-1/2 -translate-y-1/2");
            $table->string("column")->default("lg:w-1/2");
            $table->string("overlay_color")->default("rgba(0, 0, 0, 0.2)");
            $table->integer("display_order");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laravel_livewire2_banners');
    }
}
