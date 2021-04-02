<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    CONST MESSION_TYPE = 1;
    CONST SHIPMENT_TYPE = 2;

    CONST CAPTAIN = 1;
    CONST CLIENT = 2;
    CONST BRANCH = 3;

    CONST DEBIT = 1;
    CONST CREDIT = 2;
}
