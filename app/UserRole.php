<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table    = 'user_roles';
    protected $fillable = [ 
      'id',
      'name',
      'description',
      'created_at',
      'updated_at'
    ];

    public function user_role()
    {
      return $this->hasMany('App\user', 'user_role_id', 'id');
    }
}
