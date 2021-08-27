<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use DB;

class Training extends Model
{
    use SoftDeletes;
    protected $table    = 'training';
    protected $primaryKey = 'training_id';

    protected $fillable = [
        'training_title',
        'training_image',
    ];

    protected $dates = [ 'deleted_at' ];
}
