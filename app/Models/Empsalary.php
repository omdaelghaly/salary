<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empsalary extends Model
{
    
    public function getemp(){
        return $this->blongsTo(Emp::class);
       }
       


}
