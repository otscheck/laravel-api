<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index () {
        $brands = Brand::paginate(10);
        return response()->json($brands, 200);
    }

    public function show ($id) {
        $brand = Brand::find($id);
        if($brand){
            response()->json($brand, 200);
        }else return resposne()->json('la marque nest pas dispo');
    }

    public function store (Request $request) {
        try{
            $validated = $request->validate([
                'name'=>'required|unique:brands|name'
            ]);
            $brand = new Brand();
            $brand->name=$request->name;
            $brand->save();
            return response()->json('marque ajoutée !', 200);
        }catch(Exception $e){
            return response()->json($e, 500);
        }
    }

    public function update_brand ($id,Request $request) {
        try{
            $validated = $request->validate([
                'name'=>'required|unique:brands|name'
            ]);
            Brand::where('id', $id)->update(['name'=>$request->name]);          
            return response()->json('marque mise à jour !', 200);
        }catch(Exception $e){
            return response()->json($e, 500);
        }
    }

    public function delete_brand ($id) {
        $brand = Brand::find($id);
        if($brand){
            $brand->delete();
            return response()->json('la marque a été supprimée !');
        }else return response()->json('la marque na pas été trouvée !');
    }
}
