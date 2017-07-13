<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Custom
        Schema::create('social_networks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_id')->unsigned()->default(1);
            $table->integer('order')->nullable()->default(0);
            $table->string('code');
            $table->string('url');
            $table->timestamps();
            $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');
        });
        Schema::create('titles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->timestamps();
        });
        Schema::create('title_translation', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('title_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name');
            $table->unique(['title_id','locale']);
            $table->foreign('title_id')->references('id')->on('titles')->onDelete('cascade');
        });
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->timestamps();
        });
        Schema::create('content_translation', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('content_id')->unsigned();
            $table->string('locale')->index();
            $table->text('content');
            $table->unique(['content_id','locale']);
            $table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade');
        });
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order')->nullable()->default(0);
            $table->string('name')->nullable();
            $table->string('subtext')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
        Schema::create('subbanners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order')->nullable()->default(0);
            $table->string('name')->nullable();
            $table->text('subtext')->nullable();
            $table->string('video')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
        Schema::create('newsletters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
        Schema::create('delivery_times', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('day_of_week')->nullable();
            $table->time('time')->nullable();
            $table->timestamps();
        });
        Schema::create('contact_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->text('message');
            $table->timestamps();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->text('additional_information')->nullable()->after('offer_price');
            $table->text('content')->nullable()->after('offer_price');
            $table->text('summary')->nullable()->after('offer_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_forms');
        Schema::dropIfExists('delivery_times');
        Schema::dropIfExists('ads');
        Schema::dropIfExists('newsletters');
        Schema::dropIfExists('subbanners');
        Schema::dropIfExists('banners');
        Schema::dropIfExists('content_translation');
        Schema::dropIfExists('contents');
        Schema::dropIfExists('title_translation');
        Schema::dropIfExists('titles');
        Schema::dropIfExists('social_networks');
    }
}
