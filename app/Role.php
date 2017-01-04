<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{

    protected $table = 'roles';

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
    ];

    public function users() {
        return $this->belongsToMany('App\User', 'role_users');
    }

    public function role_user() {
        return $this->hasMany('App\RoleUser');
    }
}
