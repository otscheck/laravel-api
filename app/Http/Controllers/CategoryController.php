<?php

namespace App\Http\Controllers;

// use App\Models\Category;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index () {
        $categories = Category::paginate(10);
        return response()->json($categories, 200);
    }

    public function show ($id) {
        $category = Category::find($id);
        if($category){
            response()->json($category, 200);
        }else return resposne()->json('la catégorie nest pas dispo');
    }

    public function store (Request $request) {
        try{
            $validated = $request->validate([
                'name'=>'required|unique:Categorys|name',
                'name'=>'required'
            ]);
            $category = new Category();
            $category->name=$request->name;
            $category->image=$request->image;
            $category->save();
            return response()->json('catégorie ajoutée !', 200);
        }catch(Exception $e){
            return response()->json($e, 500);
        }
    }

    public function update_category ($id,Request $request) {
        try{
            $validated = $request->validate([
                'name'=>'required|unique:categories|name',
                'image'=>'required'
            ]);
            Category::where('id', $id)->update(['name'=>$request->name, 'image'=>$request->image]);          
            return response()->json('catégorie mise à jour !', 200);
        }catch(Exception $e){
            return response()->json($e, 500);
        }
    }

    public function delete_category ($id) {
        $category = Category::find($id);
        if($category){
            $category->delete();
            return response()->json('la catégorie a été supprimée !');
        }else return response()->json('la catégorie na pas été trouvée !');
    }
}
