<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_users';

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function companies() {
        return $this->belongsToMany('App\Company', 'company_role_users', 'role_user_id', 'company_id');
    }

    public function syndicates() {
        return $this->belongsToMany('App\Syndicate', 'syndicate_role_users', 'role_user_id', 'syndicate_id');
    }

    public function toString() {
        $role = $this->role()->get()->first();
        $user = $this->user()->get()->first();
        $output = [];
        if ($user) {
            $output[] = $user->name;
        }
        if ($role && $user) {
            $output[] = "($role->name)";
        }
        return implode(' ', $output);
    }
}
