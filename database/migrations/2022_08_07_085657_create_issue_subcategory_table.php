<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueSubcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_subcategory', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('issue_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->timestamps();

            $table->foreign('issue_id')->references('id')->on('issues');
            $table->foreign('subcategory_id')->references('id')->on('subcategories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issue_subcategories');
    }
}
