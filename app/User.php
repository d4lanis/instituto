<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Role;
use App\Models\Catalogo;

class User extends Authenticatable
{
    use Notifiable,HasRoles,SoftDeletes;

    protected $fillable = ['name', 'email', 'password','rfc'];
    protected $hidden = ['password', 'remember_token',];
    protected $casts = ['email_verified_at' => 'datetime',];
    protected $appends = ["fullname"];

    public function getFullnameAttribute(){
        return implode(", ",[ implode(" ",[$this->paterno,$this->materno]) , $this->nombre]); 
    }

    public function persona() {
        return $this->hasOne('App\Models\Persona', 'id', 'persona_id');
    }
}
