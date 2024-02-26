<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

public function productKey(Product $key){
return $key;
}


    public function addData(Request $req)
    {
        $validatedData = $req->validate([
            'name' => 'required',
            // 'img' => 'required|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the file types and max size as needed.
        ]);
    
        $d = new Product();
        $d->name = $validatedData['name'];
    
        if ($req->hasFile('img')) {
            $image = $req->file('img');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $imagePath = public_path('/Products').'/'.$imageName;
            // Compress and save the image
            Image::make($image)
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($imagePath);
           
            $d->img = $imageName;
        }
        $d->save();
        // $req->session()->flash('message', 'Data uploaded and saved successfully!');
        return redirect('newproduct');
    }
    


    public function deleteData($id){
        $d = Product::find($id);
        $d->delete();
        return redirect('product');
    }
    
    public function listData()
    {
        $items = Product::all(); // Fetch all products from the 'products' table
        return view('product', ['items' => $items]);
    }

    public function listDataPage()
    {
        $items = Product::paginate(3); // Fetch all products from the 'products' table
        return view('product', ['items' => $items]);
    }
    

    public function byIdData($id){
        $d = Product::find($id);
        return view('editData',['data'=>$d]);
    }



    public function editData(Request $req)
    {
        $d = Product::find($req->id);
    
        // // Validate input fields
        // $req->validate([
        //     'name' => 'required|string|max:255',
        //     'img' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
        // ]);
    
        // Update name if provided
        $name = $req->input('name');
        if (!empty($name)) {
            $d->name = $name;
        }
    
        // Update image if provided
        if ($req->hasFile('img')) {
            $img = $req->file('img');
            $imageName = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('/Products'), $imageName);
            $d->img = $imageName;
        }
    
        $d->save();
        return redirect('product');
      
    }
    
}
