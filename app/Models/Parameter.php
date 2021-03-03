<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    use HasFactory;

    protected $table = 'parameters';

    protected $fillable = [
      'value','parameter_dependent_id','group_id'
    ];

    //m:1
    public function group()
    {
       return $this->belongsTo('App\Group','group_id','id');    
    }
}
