<?php

namespace Palma;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public function roles()
    {
        return $this->belongsToMany('Palma\Role')->withTimestamps();
    }
    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)){
            return true;
        }
        abort(401, 'Esta acción no esta autorizada');
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles))
        {
            foreach ($roles as $role)
            {
                if ($this->hasRole($role)) 
                {
                    return true;    
                }
            }
        }
        else
        {
            if ($this->hasRole($roles))
            {
                return true;
            }
        }
        return false;
    }
    public function hasRole($role)
    {
        if($this->roles()->where('name', $role)->first())
        {
            return true;
        }
        return false;
    }
    use Notifiable;
protected $table = "users";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type', 'remember_token','created_at', 'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
