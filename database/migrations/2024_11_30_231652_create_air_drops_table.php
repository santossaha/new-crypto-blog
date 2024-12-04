<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirDropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('air_drops', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['Token','Coin','NFTs']);
            $table->string('name');
            $table->string('coin_token_symbol');
            $table->date('start_date');
            $table->date('end_date'); 
            $table->date('winner_announcement_date');
            $table->string('coin_token_image');
            $table->bigInteger('coin_token_qty');
            $table->bigInteger('total_airdrop_qty');
            $table->integer('no_of_winners');
            $table->string('project_website')->comment('link');
            $table->string('email')->nullable();
            $table->longText('description_of_project');
            $table->longText('task_details');
            $table->string('project_based_on');
            $table->string('country');
            $table->string('tast_link');
            $table->string('facebook_link')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('reddit_url')->nullable();
            $table->string('medium_url')->nullable();
            $table->string('telegram_url')->nullable();
            $table->string('discord_url')->nullable();
            $table->string('contract_address');
            $table->enum('contact',['telegram_id','whatsapp_number']);
            $table->string('contact_id')->nullable();
            $table->enum('aprove_status',['Pending','Aproved'])->default('Pending');
            $table->integer('upvote')->default(0);
            $table->enum('airdrop_status',['Upcomming','Previous','Trending'])->default('Upcomming  ');
            
            // $table->bigInteger('total_air_drop_qty');
            // $table->bigInteger('Total Token Supply');
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
        Schema::dropIfExists('air_drops');
    }
}
