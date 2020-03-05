<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendors extends Model
{
    public $table = 'vendors';

    protected $fillable = [
        'uuid', 'id', 'vendor_name', 'vendor_email', 'vendor_contact','vendor_note', 'vendor_logo','is_live'
    ];

    public static function getLogo($image)
    { 
      $img = $image;                       
      $full_img = asset('images/vendor/').'/'.$img;
        
        // if($img == ''){
        //   $empty =  'no-image.gif';
        //   $full_img = asset('images/vendor/').'/'.$empty; 
        // }  

      return $full_img;
    }
}
