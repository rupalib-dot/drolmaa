<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use DB;

class Testimonial extends Model
{
    use SoftDeletes;
    protected $table    = 'testimonial';
    protected $primaryKey = 'testimonial_id';

    protected $fillable = [
        'person_name',
        'testimonial_detail',
        'person_photo',
    ];

    protected $dates = [ 'deleted_at' ];

}
