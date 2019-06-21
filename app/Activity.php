<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Activity extends Model
{
    //
    protected $fillables = ['activity_name','description','activity_date','hours_spent'];

    public function user(){
    	return belongsTo(User::class);
    }

}

