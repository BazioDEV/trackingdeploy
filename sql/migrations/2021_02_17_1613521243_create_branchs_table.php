<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchsTable extends Migration
{
    public function up()
    {
        Schema::create('branchs', function (Blueprint $table) {

		$table->increments('id')->unsigned();
		$table->integer('code');
		$table->tinyInteger('type')->default(1);
		$table->string('img')->nullable();
		$table->string('name');
		$table->string('email');
		$table->string('responsible_name')->nullable();
		$table->string('responsible_mobile')->nullable();
	
		$table->string('national_id')->nullable();
		$table->integer('government_id')->unsigned()->nullable();
		$table->string('area')->nullable();
		$table->string('address')->nullable();
		$table->tinyInteger('is_archived')->default(0);
		$table->integer('created_by')->unsigned();
		$table->integer('updated_by')->unsigned();
		$table->timestamp('created_at');
		$table->timestamp('updated_at');
		

        });
    }

    public function down()
    {
        Schema::dropIfExists('branchs');
    }
}