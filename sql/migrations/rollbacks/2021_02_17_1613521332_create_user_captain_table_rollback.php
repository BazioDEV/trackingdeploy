<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCaptainTableRollback extends Migration
{
    public function up()
    {
        Schema::dropIfExists('user_captain');
    }

    public function down()
    {
        Schema::dropIfExists('user_captain');
    }
}