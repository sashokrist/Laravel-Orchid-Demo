<?php

namespace App\Traits;

use App\Models\User;

trait ProductTrait
{
    public function scopeByRoleCustomer(\Illuminate\Database\Eloquent\Builder $query)
    {
        $users = $query->get();
        foreach ($users as $user) {
            foreach ($user->roles as $role) {
                if ($role->name === 'customer'){
                    return $user;
                }
            }
        }
    }

}
