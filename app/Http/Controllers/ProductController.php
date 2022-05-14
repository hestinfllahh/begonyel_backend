<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Photo;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return (Request::segment(1));
        $product = Product::all();
        return view('product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate(
            [
                'name' => 'required|min:5',
                'price' => 'required',
                'photos' => 'required',
                'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048'
            ],
            [
                    'name.required'=> 'jangan kosongkan nama anda',
                    'name.min'=> 'minimal 5 karakter',
                    'price.required'=> 'harga tidak boleh kosong',
                    'photos.required'=> 'foto tidak boleh kosong',
                    'photos.image'=> 'foto harus berupa gambar',
                    'photos.mimes'=> 'foto harus berupa gambar jpeg, png dan jpg',
                    'photos.max'=> 'foto tidak boleh lebih dari 2MB',
                    
            ]);
        
        //return request
        $product = Product::create([
            'name'=>$request->name,
            'price'=>$request->price,
        ]);
        
        foreach($request->file('photos')as $photo){
            $filename = date('YmdHis'). '_product_' .$photo->getClientOriginalName();
            $photo->move(public_path('product'), $filename);
            Photo::create([
                'photos_name' => $filename,
                'product_id' => $product->id
            ]);
        }

        

        return redirect('/master-data/products')->with('status', 'Data berhasil ditambahkan!');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // return $product->photo;
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // validasi
        $request->validate([
                'name' => 'required|min:5',
                'price' => 'required',
            
    
                ],
                [
                    'name.required'=> 'jangan kosongkan nama anda',
                    'name.min'=> 'minimal 5 karakter',
                    'price.required'=> 'harga tidak boleh kosong',
                    'photos.required'=> 'foto tidak boleh kosong',
                    'photos.image'=> 'foto harus berupa gambar',
                    'photos.mimes'=> 'foto harus berupa gambar jpeg, png dan jpg',
                    'photos.max'=> 'foto tidak boleh lebih dari 2MB',
                    
            ]);

            Product::where('id', $product->id)->update([
                'name'=>$request->name,
                'price'=>$request->price,
            ]);

            if($request->hasfile('photos'))
            {
                
                foreach($request->file('photos') as $photo){
                    // return $photo;
                    $filename = date('YmdHis'). '_product_' .$photo->getClientOriginalName();
                    if(file_exists(public_path('product/'. $product->photo->photos_name))){
                        unlink(public_path('product/'. $product->photo->photos_name));
                    }
                    $photo->move(public_path('product'), $filename);

                    Photo::where('id', $product->photo->id)->update([
                        'photos_name' => $filename,
                        'product_id' => $product->id
                    ]);
            }
        }

        // Product::where('id', $product->id)->update([
        //     'name' => $request->name,
        //     'price' => $request->price
        // ]);
    
        return redirect('/master-data/products')->with('status', 'Data berhasil ditambahkan!');
            
        }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Product::destroy($product->id);
        return redirect('/master-data/products')->with('status', 'Data berhasil dihapus!');
    }

    
}
