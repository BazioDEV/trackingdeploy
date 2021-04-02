<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];
    public function userClient(){
		return $this->hasOne('App\UserClient', 'client_id' , 'id');
	}
}
