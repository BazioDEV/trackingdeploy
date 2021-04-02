<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTableRollback extends Migration
{
    public function up()
    {
        Schema::dropIfExists('clients');
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}