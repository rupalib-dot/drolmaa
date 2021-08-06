<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImages extends Authenticatable
{ 
    use SoftDeletes;
    use HasFactory, Notifiable;

    protected $table    = 'product_images';
    protected $primaryKey = 'product_image_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_image_id','product_id','image_name','image_path','created_at','updated_at'
    ];

    protected $dates = [ 'deleted_at' ];
 
   
    public function prod_image_list($product_id)
    { 
        $prod_image_data      = ProductImages::where('product_id',$product_id)->get();
        return $prod_image_data;
    }
    
}
