<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Country;
use App\Models\Visual;
use Illuminate\Support\Facades\Storage;


class AppsController extends Controller
{
    public function index( $id = null ){
        $apps = null;
        if (! is_null($id)){
        $apps =Apps::with(['category' , 'country','visuals' ])->find($id);
        }
    //     else{
    //     $apps =Apps::with(['category' , 'country','visuals']);
    //    }

        $categories =Category::all();
            $visuals =Visual::all();    
                $countries =Country::all();
        
        return view('addapps',[
            'apps' => $apps,
            'countries' => $countries,
            'visuals' => $visuals,
            'categories'=> $categories,
            ]);
    }

  
    
    public function store(Request $request  , Apps $app ,$update=false ){
        $request->validate([
            'app_title' => 'required',
            'app_shortcut' => 'required', 
            'app_monitoring' => 'required' ,
        'app_description' => 'required', 
        'app_forchildren' => 'required',
        'category_name' => 'required',
        'country_name' => 'required',
        'visual_id' => 'required',
         'title_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',]);

         
        
                    
         $app->title  = $request->input('app_title');
         $app->shortcut  = $request->input('app_shortcut');
         $app->forchildren = $request->input('app_forchildren') ;
         $app->monitoring  = $request->input('app_monitoring');
         $app->description  = $request->input('app_description');
       $app->category= $request->input('category_name');
       $app->countries= $request->input('country_name');
       $app->visual_id = intval($request->input('visual_id'));
        
 
     // $game->player_id  = $request->input('player_id');
     // $services = $request->input('player_id');
     //    foreach($services as $service){
     //     $game->player_id = $service;
     //    }
     $title = $request->file('tite_image');
     $name = $title->getClientOriginalName();
     $app->tite_image = $name;
     $title->storeAs('public' , $name);
         $app->save();
 
     //    if($file = $request->file('file')){
     //       $name = $file->getClientOriginalName();
     //      if ($file->move('storage', $name)){
     //           $visuals = new Visual();
     //          $visuals->game_id =  $request->id;
     //          $visuals->link = $name;
     //          $visuals->save();
     //       }  }
 
    
 
 
     $files = $request->file('vis');
      foreach($files as $file){
         $name = $file->getClientOriginalName();
             $visuals = new Visual();
              $visuals->game_id = $app->id;
              $visuals->link = $name;
              $file->storeAs('public' , $name);
              var_dump($files[0]);
              $visuals->video_or_image = $request->input('video_or_image') ;
              $app->vis_id = $this->visuals->id;
              $visuals->save();
              $app->save();
             }
 
         //  $request->url
 
     //    if($request->file('file')){
         
     //        $visuals = $request->file('file');
     //         foreach($visuals as $visual){
     //            $path = $visual->store('public');
     //            $visual = new Visual();
     //            $visual->link = $path;
     //            $visual->product_id =  $game->id;
     //            $visual->save();}} 
 
 
 return $app;
                    
                    
 
    }




    public function update( Request $request){
        $request->validate([
            'game_title' => 'required',
            'game_shortcut' => 'required',
            'game_phrase' => 'required',
            'game_dengerous' => 'required',
            'game_coordinator' => 'required',
            'game_order' => 'required',
            'game_description' => 'required',
            // 'category_id' => 'required',
            // 'player_id' => 'required',
            // 'place_name' => 'required',
                    ]);

                    $id = $request->input('apps_id');
                    $apps = Apps::find($id);
                    $this->store($request , $apps, true);
                    return back();

    }

    public function delete($id ){
    }
    public function newProduct( ){
            $game = Game::all();
            
       // $units = Unit::all();
        //$categories = Category::all();
        return view('pages.game')->with(
            [ 'game' => $game,
                // 'units' => $units,
               //  'categories' => $categories,
                 //'images' => $products->images
                 ]);     
        }
}
