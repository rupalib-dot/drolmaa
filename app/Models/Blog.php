<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use DB;

class Blog extends Model
{
    use SoftDeletes;
    protected $table    = 'blog';
    protected $primaryKey = 'blog_id';

    protected $fillable = [
        'blog_type',
        'blog_title',
        'blog_details',
        'blog_image',
    ];

    protected $dates = [ 'deleted_at' ];

    public function comment()
    {
        return $this->hasMany('App\Models\BlogComment','blog_id');
    }

}
