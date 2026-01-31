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
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('image')->nullable();

            // Platform & Participation
            $table->string('platform')->nullable(); // e.g., Zealy
            $table->string('participate_link')->nullable(); // "Participate Now" link

            // Token Details
            $table->decimal('total_supply', 20, 2)->nullable();
            $table->decimal('total_airdrop_qty', 20, 2)->nullable();
            $table->decimal('airdrop_value', 20, 2)->nullable()->comment('Value in USD');
            $table->decimal('supply_percentage', 5, 2)->nullable();

            // Winners
            $table->integer('winner_count')->nullable();
            $table->date('winner_announcement_date')->nullable();

            // Dates
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            // Categorization
            $table->string('project_category')->nullable();
            $table->string('blockchain_network')->nullable();

            // Content
            $table->longText('description')->nullable()->comment('About Project');
            $table->longText('how_to_participate')->nullable();

            // Social Links
            $table->string('website_url', 500)->nullable();
            $table->string('twitter_url', 500)->nullable();
            $table->string('telegram_url', 500)->nullable();
            $table->string('discord_url', 500)->nullable();
            $table->string('whitepaper_url', 500)->nullable();

            // Meta / SEO
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('canonical', 500)->nullable();

            // Statuses
            $table->enum('status', ['Active', 'Inactive'])->default('Inactive');
            $table->enum('airdrop_status', ['Upcoming', 'Ongoing', 'Ended'])->default('Upcoming');

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
