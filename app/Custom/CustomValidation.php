<?php
namespace App\Custom;

use Validator;
use App\Part;
class CustomValidation 
{
	  //TODO validate if there are posted more attributes then necesary 
        var $rules=[
                'number'     => 'required|integer',
                'brand_name' => 'required',
                'description'=>'required',
                'qty'        => 'required|integer',
                'price'      => 'required|numeric',
                'condition'  => 'required',
                'location'   => 'required',
                ];


/**
     * Determine if the given array is valid Product according to $rules
     *
     * @param  array  $product
     * @return arr
     */
     public function validate($product)
     {
         $validator = Validator::make($product,$this->rules);
         if($validator->fails())
         {
         	return $validator->errors(); 
         }
         else 
         	return [];
      }


}