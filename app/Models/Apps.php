<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\Country;
use App\Models\Visual;


class Game extends Model {

    
    protected $fillable = [
        'title','shortcut' ,'title_image', 'monitoring' ,
        'description', 'category' , 'forchildren',	
        'vis_id', 'countries'
    ];

    protected $casts = [

        'category' => 'array',
        'countries'=> 'array',
    ];

    public function category(){
        return $this->belongsTo(Category::class );
    }

    public function countries(){
        return $this->belongsTo(Country::class );
    }

  
    public function visuals(){
        return $this->hasMany(Visual::class );
    }
}
   