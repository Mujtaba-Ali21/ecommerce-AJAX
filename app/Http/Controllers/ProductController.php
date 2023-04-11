<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{


    // Create
    public function createProduct(Request $req)
    {

        $validated = $req->validate(['productName' => 'required', 'productImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 'productStatus' => 'required', 'productDescription' => 'required']);

        // Get the file object from the image input field
        $image = $req->file('productImage');

        $data = ['name' => $validated['productName'], 'image' => $image->getClientOriginalName() , // Store the image filename
        'status' => $validated['productStatus'], 'description' => $validated['productDescription']];

        DB::table('products')->insert($data);

        // Move the uploaded file to public directory
        $image->move(public_path('images') , $image->getClientOriginalName());

    }



    // Read
    public function showProducts()
    {
        $data = DB::table('products')->get();

        return view('show', ['data' => $data]);
    }



    // Update
    public function showEdit($id)
    {
        $data = DB::table('products')->where(['id' => $id])->get();

        return view('edit', ['data' => $data]);
    }


    public function updateProduct(Request $req, $id)
    {
        $validated = $req->validate(['productName' => 'required', 'productImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 'productStatus' => 'required', 'productDescription' => 'required']);

        // Get the file object from the image input field
        $image = $req->file('productImage');

        $data = ['name' => $validated['productName'], 'image' => $image->getClientOriginalName() , // Store the image filename
        'status' => $validated['productStatus'], 'description' => $validated['productDescription']];

        DB::table('products')->where(['id' => $id])->update($data);;

        // Move the uploaded file to public directory
        $image->move(public_path('images') , $image->getClientOriginalName());

    }



    // Delete
    public function deleteProduct($id)
    {
        DB::table('products')->where(['id' => $id])->delete();

        return redirect('show')
            ->with('success', 'Product Created Successfully!');
    }
}

