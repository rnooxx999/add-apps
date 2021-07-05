<?php

namespace App\Models;
use App\Models\Apps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visual extends Model
{
    protected $fillable = [
        'id', 'link', 'video_or_image' ,'game_id'
     ];
 
     public function games(){
         return  $this->belongsTo(Apps::class , 'id', 'game_id');
     }
}
