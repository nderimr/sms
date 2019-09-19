<?php

namespace App\Http\Controllers;
use Response;
use Illuminate\Http\Request;
use App\Http\Requests; 
use App\Part;
use App\Http\Resources\Part as PartResource;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductValidationRequest as ProductValidator;
use Validator;
use App\Custom\CustomValidation;


class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parts=Part::get();
        return PartResource::collection($parts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$part=$request->isMethod('put')? Part::findOrFail($request->id): new Part;
      $part =new Part;
      $part->number=$request['number'];
      $part->description=$request['description'];
      $part->brand_name=$request['brand_name'];
      $part->qty=$request['qty'];
      $part->price=$request['price'];
      $part->condition=$request['condition'];
      $part->location=$request['location'];
      if($part->save()){
            return new PartResource($part);
        
        }
        //return Response::json(array('message' =>'success')); 
    }



    /**
     * Store array of Parts resource in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeArr(Request $request)
    {  
            
   
        // return Response::json(array('success' =>json_decode($request->getContent()))); 
        //validate if the data is valid json 
        $parts=array();
        $arrParts=array();
        
          
        $products=json_decode($request->getContent());
         
         $validData=true; 
         DB::beginTransaction(); 
         
         for($i=0;$i<count($products);$i++)  
           {  
                $parts[$i]=new Part;  
                
                $parts[$i]->number=$products[$i]->number;
                $parts[$i]->description=$products[$i]->description;
                $parts[$i]->brand_name=$products[$i]->brand_name;
                $parts[$i]->qty=$products[$i]->quantity;
                $parts[$i]->price=$products[$i]->price;
                $parts[$i]->condition=$products[$i]->condition;
                $parts[$i]->location=$products[$i]->location;
                
                 $arrParts[$i] = json_decode(json_encode($parts[$i]), true);//convert object to array for validation 
                 
                 $validation=new CustomValidation;
                 //validator accepts an associative array as a parameter
                   $errors=$validation->validate($arrParts[$i]); 
                 
                 if(count($errors)>0)
                 { 
                       DB::rollBack();
                       $validData=false; 
                       return Response::json(array('message' =>'invalid data format no data updated or inserted into database'));
                  }
                  else 
                      { 
                        Part::updateOrCreate(['number'=>$parts[$i]->number],$arrParts[$i]);
                    }//end else count($errors)>0
           } //end for    
        
         if($validData)
          {
              DB::commit();
              return Response::json(array('message' =>'success'));
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $part=Part::findOrFail($id);

        return new PartResource($part);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         $part=Part::findOrFail($id);
          
         $part->number=$request->input('number');
         $part->description=$request->input('description');
         $part->brand_name=$request->input('brand_name');
         $part->qty=$request->input('qty');
         $part->price=$request->input('price');
         $part->condition=$request->input('condition');
         $part->location=$request->input('location');
        
        if($part->save()){
            return new PartResource($part);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $part=Part::findOrFail($id);
         if($part->delete()){
          return new PartResource($part);
        }
    }
}
