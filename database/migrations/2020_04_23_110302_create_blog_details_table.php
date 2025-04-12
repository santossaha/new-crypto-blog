<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->enum('type',['Blog','News'])->nullable();
            $table->string('slug');
            $table->string('image')->nullable();
            $table->text('content')->nullable();
            $table->text('short_description')->nullable();
            $table->enum('status',['Active','Inactive'])->default('Active');
            $table->string('meta_keyword')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('author')->nullable();
            $table->string('canonical')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('category_id')->references('id')->on('blog_categories')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_details', function(Blueprint $table) {
            $table->dropForeign('blog_details_category_id_foreign');
        });
        Schema::table('blog_details', function(Blueprint $table) {
            $table->dropForeign('blog_details_user_id_foreign');
        });
        Schema::dropIfExists('blog_details');
    }
}
