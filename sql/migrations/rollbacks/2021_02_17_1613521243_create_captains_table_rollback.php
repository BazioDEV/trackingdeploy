<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaptainsTableRollback extends Migration
{
    public function up()
    {
        Schema::dropIfExists('captains');
    }

    public function down()
    {
        Schema::dropIfExists('captains');
    }
}