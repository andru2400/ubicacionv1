<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';

    protected $fillable = [
      'key','group_dependent_id'
    ];

    public function parameters()
    {
      return $this->hasMany('App\Models\Parameter');
    }

}
