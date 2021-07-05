<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CountryController extends Controller
{
    public function index(){
        $categories =Category::paginate(18);
        return view('pages.categories')->with(
            ['categories' => $categories,
            'showLinks' => true
            ]
        );
    } 

    
    
    public function store(Request $request){
        $request->validate([
            'category_name' => 'required',
                    ]);
        $categoryName = $request->input('category_name');
        $category =new Category();
        $category->name = $categoryName;

       
        $category->save();
        return redirect()->back();
    }


    
    public function search(Request $request){
        $request->validate([
            'category_search' => 'required',
        ]);
        $serchterm = $request->input('category_search');
        //وير تعود على البحث ونستخد او وير لاننا نريد البحث بخانتين
        $categories = Category::where( 'name' , 'LIKE', '%' . $serchterm . '%' )->get(); // لجلب ما نبحث عنه
        if(count($categories)>0){
            return view('pages.categories')->with(
                ['categories' => $categories,
                'showLinks' => false
                ]
            );
        }
        return redirect()->back();
    }

    
    public function delete(Request $request){
        $request->validate([
            'category_id' => 'required'
                    ]);
         $id= $request->input('category_id');
         Category::destroy($id);
        // Session::flash('message', 'unit has been deleted'); 
         return redirect()->back();
     }

     
    public function update(Request $request){
        $request->validate([
            'category_id' => 'required',
            'category_name' => 'required',
        ]);

        //يعطيني قيمة الانتجر
    $categoriesID =intval($request->input('category_id'));
    $categories = Category::find($categoriesID);
    //$categoriesName = $request->input('category_name');
    $categories->name = $request->input('category_name');
    $categories->save();
    return redirect()->back();
    }
}
