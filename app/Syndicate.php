<?php

namespace App;

use App\Entity;
use Illuminate\Database\Eloquent\SoftDeletes;


class Syndicate extends Entity
{
    protected $table = 'syndicates';

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'logo', 'certificate', 'number_people', 'rating', 'year_created'
    ];

    public function role_users() {
        return $this->belongsToMany('App\RoleUser', 'syndicate_role_users', 'syndicate_id', 'role_user_id');
    }
}
