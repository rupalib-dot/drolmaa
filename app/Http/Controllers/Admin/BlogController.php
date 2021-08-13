<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DB;
use CommonFunction;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Category;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $record_list    = Blog::OrderBy('created_at','DESC')->paginate(10);
        $title          = "Blog";
        $data           = compact('title','record_list');
        return view('admin.blogs.blog_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title              = "Blog";
        $category    = Category::OrderBy('created_at','DESC')->get();
        $data               = compact('title','category');
        return view('admin.blogs.blog_create', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($blog_id)
    {
        $record_data        = Blog::where('blog_id',base64_decode($blog_id))->first(); 
        $category           = Category::OrderBy('created_at','DESC')->get();
        $title              = "Blog";
        $data               = compact('title','record_data','category');
        return view('admin.blogs.blog_create', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($blog_id)
    { 
        $record_data        = Blog::where('blog_id',base64_decode($blog_id))->first();
        $title              = "Blog";
        $data               = compact('title','record_data');
        return view('admin.blogs.blog-details', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $blog_id)
    {
        $blog_id = base64_decode($blog_id);
        $error_message = 	[
			'blog_category.required'    => 'Blog Category should be required',
			'blog_title.required'   => 'Blog title should be required',
			'blog_details.required' => 'Blog details should be required',
			'blog_file.required'    => 'Blog image should be required',
			'mimes'                 => 'Image should be jpg, jpeg, png, webp',
            'max'                   => 'Image size max 2MB'
		];

		$validatedData = $request->validate([
			'blog_category' 	    => 'required',
			'blog_title' 	    => 'required',
			'blog_details' 	    => 'required',
        ], $error_message);

        if($blog_id != 0)
        {
            $validatedData[] = $request->validate([
                'blog_file' 	    => 'mimes:jpeg,jpg,png,webp|max:2048',
            ], $error_message);
        }
        else
        {
            $validatedData[] = $request->validate([
                'blog_file' 	    => 'required|mimes:jpeg,jpg,png,webp|max:2048',
            ], $error_message);
        }

        try
		{
            if(!empty($request->file('blog_file')))
            {
                $imageName = time().'_'.rand(1111,9999).'.'.$request->file('blog_file')->getClientOriginalExtension();  
                $request->file('blog_file')->move(public_path('blog_image'), $imageName);  
            }else{
                if($blog_id == 0)
                {
                    $imageName="";
                }
                else
                {
                    $image  = Blog::where('blog_id',$blog_id)->first();
                    $imageName=$image->blog_image;
                }
            }

            if($blog_id == 0)
            {   
                \DB::beginTransaction();
                    $blog = new Blog();
                    $blog->fill($validatedData);
                    $blog->blog_image = $imageName;
                    $blog->blog_type = $request->blog_category;
                    $blog->save();
                \DB::commit();
                return redirect()->route('blogs.index')->with('Success','Blog created successfully');
            }
            else
            {  
                $data = array(
                    'blog_type'=>$request->blog_category,
                    'blog_title'=>$request->blog_title,
                    'blog_details'=> $request->blog_details,
                    'blog_image' 	=> $imageName,
                ); 
                Blog::where('blog_id',$blog_id)->update($data);
                      
                return redirect()->route('blogs.index')->with('Success','Blog updated successfully');
            }
        }
        catch (\Throwable $e)
    	{
            \DB::rollback();
            return back()->with('Failed',$e->getMessage())->withInput();
    	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($blog_id)
    {
        Blog::where('blog_id',base64_decode($blog_id))->delete();
        return redirect()->route('blogs.index')->with('Success','Blog deleted successfully');
    }

  
}
