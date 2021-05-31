<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Doctrine\DBAL\Schema\View;

class ProductController extends Controller
{
    public function getAllProducts(Request $request){
        $products = Product::orderBy('id','DESC');

        if ($request->id) {
            $products->where('id',$request->id);
        }

        if ($request->name) {
            $products->where('name','LIKE', '%'. $request->name . '%');
        }

        if ($request->category) {
            $products->where('category', $request->category);
        }

        if ($request->price) {
            $products->where('price', '>', $request->price);
        }

        if ($request->sale) {
            $products->where('sale', '=', $request->sale);
        }


        if ($request->stok) {
            $products->where('stok','<', $request->stok);
        }

        
        

        $products = $products->get();
        return view('products-page')->with('products',$products );
    }


    public function saveProducts(Request $request){
        Product::create([
            'name'=> $request->name,
            'category'=> $request->category,
            'price'=> $request->price,
            'sale'=> $request->sale,
            'stok'=> $request->stok,
        ]);
       
        return redirect()->route('products.all'); 

    }


    //update
    public function updateProducts(Request $request,$id){
         Product::where('id', $id)->update([
            'name'      => $request->name,
            'price'     => $request->price,
            'sale'      => $request->sale,
            'stok'      => $request->stok,
            'category'  =>$request->category,
         ]);

        //  return redirect()->back();
        return redirect()->route('products.all'); 
    }

    //edit
    public function editProducts($id){
        $product_to_edit = Product::where('id', $id)->firstOrfail();
        return view('edit-form')->with('product', $product_to_edit);
        return redirect()->back();
    }


    //delete
    public function deleteProducts($id){
        Product::where('id', $id)->delete();
        return redirect()->back();
    }
    
}
