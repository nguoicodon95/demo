<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $table = 'members';

    public $primaryKey = 'id';

    public $incrementing = 'false';

    protected $fillable = [
        'first_name', 'last_name', 'role', 'email', 'password', 'phone', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getIdAttribute($value) {
        return (string) $value;
    }

    public function room() {
        return $this->hasMany('\App\Models\Room');
    }
}
