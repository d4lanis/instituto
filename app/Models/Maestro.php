<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maestro extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['nombre', 'paterno', 'materno'];
    protected $dates = ['created_at','updated_at','deleted_at'];
    protected $table ="maestros";

    protected $appends = ["fullname"];

    public function getFullnameAttribute(){
        return implode(", ",[ implode(" ",[$this->paterno,$this->materno]) , $this->nombre]); 
    }

  
}
