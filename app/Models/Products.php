<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Authenticatable
{ 
    use SoftDeletes;
    use HasFactory, Notifiable;

    protected $table    = 'products';
    protected $primaryKey = 'product_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id','product_name','description','instructions','referenceses','rating','category_id','created_by','quantity','selling_price','mrp','expiry_date','status','created_at','updated_at'
    ];

    protected $dates = [ 'deleted_at' ];
  

    public function product_list()
    { 
        $products_data      = Products::orderBy('product_id','desc')->paginate(15);
        return $products_data;
    }
    
}
