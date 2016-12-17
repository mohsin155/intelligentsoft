<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
class ProviderDetails extends Model
{
   
    use SoftDeletes;

    protected $softDelete = true;
   
    protected $primaryKey = 'details_id';
   
    protected $fillable = ['user_id','category_id','description'];
    
    public function getProvidersList($category_id){
        $query = User::join('provider_details as p','users.user_id','=','p.user_id')->where('users.status','=',1)->where('p.is_approved','=',1)
                ->where('p.category_id','=',$category_id)
                ->get();
        return $query;
    }
    
}
