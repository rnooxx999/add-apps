<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Apps;

class Country extends Model
{
    protected $fillable = [
        'name'
    ];

    public function apps(){
        return  $this->hasMany(Apps::class);
    }
}
