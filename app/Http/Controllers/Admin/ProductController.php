<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category; 
use App\Models\ProductImages;
use Session;

class ProductController extends Controller
{
    public function __construct()
    { 
        $this->Products     = new Products; 
        $this->ProductImages     = new ProductImages; 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title  = "Products";
        $products = $this->Products->product_list();  
        $data   = compact('title','products','request');
        return view('admin.product.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title  = "Add Product"; 
        $category = Category::where('category_status',config('constant.BLK_UNBLK.UNBLOCK'))->get();
        $data   = compact('title','category');
        return view('admin.product.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $error_message = 	[
			'product_name.required'        => 'Product name should be required',
            'product_name.min'             => 'Product name should be minimum of 3 characters',
            'product_name.max'             => 'Product name should be maximum of 50 characters',
            'product_name.regex'             => 'Product name should be alphanumeric only',
            'product_name.unique' 		   => 'Product name already exist', 
			'selling_price.required' 	   => 'Selling price should be required', 
            'description.required'         => 'Description should be required', 
            'instructions.required'        => 'Instructions should be required', 
            'referenceses.required'          => 'References should be required', 
            'quantity.required'            => 'Quantity should be required',
            'rating'                       => 'Rating must not be empty',
            'mrp.required'                 => 'MRP should be required',
            'expiry_date.required'         => 'Expiry date should be required',
            'category.required'         => 'Category must not be empty'
		];

		$validatedData = $request->validate([
			'product_name' 	  => 'required|min:3|max:30|regex:/^[\pL0-9\s]+$/u|unique:products,product_name',
			'selling_price'   => 'required|numeric',
            'description' 	  => 'required',
            'instructions'    => 'required',
            'referenceses'      => 'required',
            'rating'            =>'required',
            'quantity' 	      => 'required|numeric', 
            'mrp' 	          => 'required|numeric',
            'expiry_date' 	  => 'required', 
            'category' 	  => 'required',
        ], $error_message);

        
        try 
        { 
            $product = Products::create([ 
                'product_name'  => $request['product_name'], 
                'description'   => $request['description'],  
                'instructions'    => $request['instructions'],
                'referenceses'      => $request['referenceses'],
                'category_id'   => $request['category'],
                'created_by'    => Session::get('user_id'),
                'quantity'      => $request['quantity'],
                'selling_price' => $request['selling_price'],
                'rating'            =>$request['rating'],
                'mrp'           => $request['mrp'],
                'expiry_date'   => date('Y-m-d',strtotime($request['expiry_date'])),
                'status'        => Config('constant.BLK_UNBLK.UNBLOCK'),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);  
            if(!empty($product['product_id'])){
                if($request->hasFile('images'))
                {
                    $sImages     = $request->file('images');
                    foreach ($sImages as $item){
                        $product_pic = time() * rand() . '.' . $item->getClientOriginalExtension();
                        $item->move(public_path('products'), $product_pic); 

                        $product_image_data = ProductImages::create([
                            'product_id'   => $product['product_id'],
                            'image_name'   => $product_pic, 
                            'image_path'   => public_path('products').'/'.$product_pic,  
                            'created_at'   => date('Y-m-d H:i:s'),
                            'updated_at'   => date('Y-m-d H:i:s'),
                        ]); 
                    }
                } 
                return redirect()->route('product.index')->with('Success','Product created Successfully.'); 
            }
            else{
                return redirect()->back()->withInput($request->all())->with('Failed','Something went wrong!!!, Please try again.');
            }
        }
        catch (\Throwable $e) 
        {
            return redirect()->back()->withInput($request->all())->with('Failed',$e->getMessage());
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        $title  = "Product Detail";
        $product = Products::find($id);   
        $product_image = $this->ProductImages->prod_image_list($id);
        $data   = compact('title','product','product_image');
        return view('admin.product.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title  = "Edit Product";
        $product = Products::find($id);   
        $product_image = $this->ProductImages->prod_image_list($id);
        $category = Category::get();
        $data   = compact('title','product','category','product_image');
        return view('admin.product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        $error_message = 	[
			'product_name.required'        => 'Product name should be required',
            'product_name.min'             => 'Product name should be minimum of 3 characters',
            'product_name.max'             => 'Product name should be maximum of 50 characters',
            'product_name.regex'             => 'Product name should be alphanumeric only',
            'product_name.unique' 		   => 'Product name already exist', 
			'selling_price.required' 	   => 'Selling price should be required', 
            'description.required'         => 'Description should be required', 
            'instructions.required'        => 'Instructions should be required',
            'rating'            =>'Rating must not be empty', 
            'referenceses.required'          => 'References should be required', 
            'quantity.required'            => 'Quantity should be required',
            'mrp.required'                 => 'MRP should be required',
            'expiry_date.required'         => 'Expiry date should be required',
            'category.required'         => 'Category must not be empty'
		];

		$validatedData = $request->validate([
			'product_name' 	  => 'required|min:3|max:30|regex:/^[\pL0-9\s]+$/u|unique:products,product_name,'.$id.',product_id',
			'selling_price'   => 'required|numeric',
            'description' 	  => 'required',
            'instructions'    => 'required',
            'referenceses'      => 'required',
            'rating'            =>'required',
            'category' 	  => 'required',
            'quantity' 	      => 'required|numeric', 
            'mrp' 	          => 'required|numeric',
            'expiry_date' 	  => 'required', 
        ], $error_message);

        
        try 
        { 
            $product = Products::where('product_id',$id)->update([ 
                'product_name'  => $request['product_name'], 
                'description'   => $request['description'],  
                'instructions'    => $request['instructions'],
                'referenceses'      => $request['referenceses'],
                'category_id'   => $request['category'],
                'quantity'      => $request['quantity'],
                'rating'            =>$request['rating'],
                'selling_price' => $request['selling_price'],
                'mrp'           => $request['mrp'],
                'expiry_date'   => date('Y-m-d',strtotime($request['expiry_date'])), 
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);  
            
            if($request->hasFile('images'))
            {
                $sImages     = $request->file('images'); 
                foreach ($sImages as $item){
                    $product_pic = time() * rand() . '.' . $item->getClientOriginalExtension();
                    $item->move(public_path('products'), $product_pic); 

                    $product_image_data = ProductImages::create([
                        'product_id'   => $id,
                        'image_name'   => $product_pic, 
                        'image_path'   => public_path('products').'/'.$product_pic,  
                        'created_at'   => date('Y-m-d H:i:s'),
                        'updated_at'   => date('Y-m-d H:i:s'),
                    ]); 
                }
            } 
            return redirect()->route('product.index')->with('Success','Product Updated Successfully.'); 
            
        }
        catch (\Throwable $e) 
        {
            return redirect()->back()->withInput($request->all())->with('Failed',$e->getMessage());
        } 
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_data = Products::where('product_id',$id)->update([
            'deleted_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]); 
        if(!empty($product_data)){
            return redirect()->back()->with('Success', 'Product Deleted Successfully');
        }else{
            return redirect()->back()->withInput($request->all())->with('Failed', 'Something went wrong');
        } 
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_pImage($id,$product_id)
    {
        $product_image_data = ProductImages::where('product_image_id',$id)->update([
            'deleted_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]); 
        if(!empty($product_image_data)){
            return redirect()->back()->with('Success', 'Product Image deleted successfully');
        }else{
            return redirect()->back()->withInput($request->all())->with('Failed', 'Something went wrong');
        } 
    }

    /**
     * change status the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus($id,$status)
    {
        $product_data = Products::where('product_id',$id)->update([
            'status'    => $status,
            'updated_at'    => date('Y-m-d H:i:s'),
        ]); 
        if(!empty($product_data)){
            return redirect()->route('product.index')->with('Success', 'Product '.ucwords(strtolower(array_search($status,config('constant.BLK_UNBLK')))).' Successfully');
        }else{
            return redirect()->back()->withInput($request->all())->with('Failed', 'Something went wrong');
        } 
    }
}
