<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIcosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('launchpad')->nullable(); // On Website, etc.
            $table->string('stage')->nullable(); // ICO, IEO, IDO, etc.
            $table->decimal('total_supply_qty', 20, 2)->nullable();
            $table->decimal('tokens_for_sale', 20, 2)->nullable();
            $table->decimal('supply_percentage', 8, 2)->nullable(); // % of Supply
            $table->decimal('ico_price', 20, 6)->nullable(); // ICO Price
            $table->string('ico_price_currency')->default('USDT');
            $table->string('one_usdt_value')->nullable(); // 1 USDT = ? tokens (TBA if not set)
            $table->decimal('fundraising_goal', 20, 2)->nullable();
            $table->string('project_category')->nullable(); // Web3, DeFi, etc.
            $table->string('contract_address')->nullable();
            $table->string('blockchain_network')->nullable(); // Binance-Smart-Chain, Ethereum, etc.
            $table->string('buy_link')->nullable();
            $table->string('soft_cap')->nullable();
            $table->string('hard_cap')->nullable();
            $table->string('personal_cap')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('website_url')->nullable();
            $table->string('whitepaper_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('telegram_url')->nullable();
            $table->string('discord_url')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('canonical')->nullable();
            $table->enum('ico_status', ['Upcoming', 'Ongoing', 'Ended'])->default('Upcoming');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
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
        Schema::dropIfExists('icos');
    }
}

