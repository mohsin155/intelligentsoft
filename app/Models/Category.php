<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
    use SoftDeletes;

    protected $softDelete = true;
   
    protected $primaryKey = 'category_id';
    
}
