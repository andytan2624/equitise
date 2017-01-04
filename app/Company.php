<?php

namespace App;

use App\Entity;
use Illuminate\Database\Eloquent\SoftDeletes;


class Company extends Entity
{
    use SoftDeletes;

    protected $table = 'companies';

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
        return $this->belongsToMany('App\RoleUser', 'company_role_users', 'company_id', 'role_user_id');
    }
}
