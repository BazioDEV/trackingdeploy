<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserClientTableRollback extends Migration
{
    public function up()
    {
        Schema::dropIfExists('user_client');
    }

    public function down()
    {
        Schema::dropIfExists('user_client');
    }
}