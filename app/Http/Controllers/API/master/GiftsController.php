<?php

namespace App\Http\Controllers\API\master;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Gift;
use Validator;
use File;

class GiftsController extends BaseController
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $pageno = 1; $pagelength = 20;
            if (isset($request->pagelength, $request->pageno) && !empty($request->pagelength)) {
                $pagelength = $request->pagelength;
                $pageno = $request->pageno;
            }

            $totalrecords = Gift::count();
            $list = Gift::orderBy('id', 'desc');
            $list =$list->skip( ($pageno-1)*$pagelength )->take($pagelength)
                    ->get();
            $data['data'] = $list;
            $data['current_page'] = $pageno;
            $data['total'] = $totalrecords;
            $data['per_page'] = $pagelength;

            if($totalrecords){
                return $this->sendResponse(false, 200, $data, 'Gift Details.');
            } else {
                return $this->sendResponse(true, 233, null, 'Failed to get Gift details');
            }

        } catch(\Exception $e){
             return $this->sendResponse(true, 233, null, $e->GetMessage());
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function active_list()
    {
        try{
            
            $list = Gift::where('status',1)->orderBy('id', 'desc')->get();
            if($list){
                return $this->sendResponse(false, 200, $list, 'Gift Details.');
            } else {
                return $this->sendResponse(true, 233, null, 'Failed to get Gift details');
            }

        } catch(\Exception $e){
             return $this->sendResponse(true, 233, null, $e->GetMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'title'    => ['required', 'unique:gifts,title,NULL,id,deleted_at,NULL'],
            'category_id'=>'required',
            'diamonds' => 'required|numeric',
            'picture' => ['required', 'mimes:jpeg,jpg,png', 'max:1024' ],
            'json_file' => ['required', 'mimes:json', 'max:5024' ],
            'music_file' => ['required', 'mimes:mp3', 'max:5024' ],
            'status' => 'required'
        ]);

        if($validator->fails()){
            $errors = [];
            foreach(json_decode($validator->messages()) as $key => $value)
                $errors[] = $value[0];
            return $this->sendResponse(true, 312, $errors, 'Validation error, recheck all fields.');
        }

        try{

            if($request->hasFile('picture')) {
               $request['gift_pic']=$this->uploadPicture($request,'gifts/pictures');
            }
            if($request->hasFile('json_file')) {
               $request['gift_json']=$this->uploadJson($request,'gifts/json');
            }
            if($request->hasFile('music_file')) {
               $request['gift_music']=$this->uploadMusic($request,'gifts/music');
            }
            $request['created_at'] = date('Y-m-d H:i:s');
            $result=Gift::create($request->except('picture','json_file','music_file'));

            if($result){
                return $this->sendResponse(false, 200, null, 'Gift has been created successfully.');
            } else {
                return $this->sendResponse(true, 233, null, 'Failed to submit Gift details');
            }
        } catch(\Exception $e){
             return $this->sendResponse(true, 233, null, $e->GetMessage());
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
         try{
            $data=Gift::where('id', $id)->first();
            if(!empty($data)){
                return $this->sendResponse(false, 200, $data, 'Gift data found');
            }else{
                return $this->sendResponse(true, 233, null, 'Data not found');
            }
        } catch(\Exception $e){
             return $this->sendResponse(true, 233, null, $e->GetMessage());
        }
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
    public function update(Request $request, $id)
    {
        $rules=[
            'title'    => ['required', 'unique:gifts,title,'.$id.',id,deleted_at,NULL'],
            'category_id'=>'required',
            'diamonds' => 'required|numeric',
            'status' => 'required'
        ];

        if ($file=$request->file('picture')) {
            $rules = array_merge($rules, array(
                'picture' => 'mimes:jpeg,jpg,png|max:1024' 
            )); 
        }

        if ($file=$request->file('json_file')) {
            $rules = array_merge($rules, array(
                'json_file' => 'mimes:json|max:5024' 
            )); 
        }
        if ($file=$request->file('music_file')) {
            $rules = array_merge($rules, array(
                'music_file' => 'mimes:mp3|max:5024' 
            )); 
        }

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            $errors = [];
            foreach(json_decode($validator->messages()) as $key => $value)
                $errors[] = $value[0];
            return $this->sendResponse(true, 312, $errors, 'Validation error, recheck all fields.');
        }

        try{

            if($request->hasFile('picture')) {
               $request['gift_pic']=$this->uploadPicture($request,'gifts/pictures');
            }
            if($request->hasFile('json_file')) {
               $request['gift_json']=$this->uploadJson($request,'gifts/json');
            }
            if($request->hasFile('music_file')) {
               $request['gift_music']=$this->uploadMusic($request,'gifts/music');
            }
            $request['updated_at'] = date('Y-m-d H:i:s');
            $result=Gift::where('id', $id)->update($request->except('picture','json_file','music_file'));

            if($result){
                return $this->sendResponse(false, 200, null, 'Gift has been updated successfully.');
            } else {
                return $this->sendResponse(true, 233, null, 'Failed to submit Gift details');
            }
        } catch(\Exception $e){
             return $this->sendResponse(true, 233, null, $e->GetMessage());
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
       try{
            $data=Gift::where('id', $id)->first();
            if($data){
                Gift::where('id', $id)->delete();
                return $this->sendResponse(false, 200, null, 'Gift details removed');
            }else{
                return $this->sendResponse(true, 233, null, 'Data not found');
            }
        } catch(\Exception $e){
             return $this->sendResponse(true, 233, null, $e->GetMessage());
        }
    }
}
