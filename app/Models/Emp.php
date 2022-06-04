<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emp extends Model
{

     protected $fillable = [
      'school_id', 'name', 'email', 'address',
     ];

      protected $hidden = [
            ];




    public function getempsalary(){
          return $this->hasOne(Empsalary::class);
    }

}
