<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBranchTable extends Migration
{
    public function up()
    {
        Schema::create('user_branch', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('user_id')->unsigned();
		$table->integer('branch_id')->unsigned();
		

        });
    }

    public function down()
    {
        Schema::dropIfExists('user_branch');
    }
}