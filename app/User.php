<?php
namespace App;
use App\Http\Requests\Request;
use Auth;

use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable

{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function commandes() {
        return $this->hasMany('App\Commande');
    }

    public function estAdmin( )
    {
        if(Auth::user()->admin == 1)
        {
            return true;
        }
        return false;
    }
}