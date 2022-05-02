<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ContactoReferencia extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['numero_telefono_referencia','numero_celular_referencia','email_referencia','referencia_id'];
    protected $dates = ['created_at','updated_at','deleted_at'];
 

 
   
}
