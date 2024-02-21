<?php

namespace App\Http\Controllers\API\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Theme;
use Validator;
use App\Http\Controllers\BaseController;

class ThemesController extends BaseController
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

            $totalrecords = Theme::count();
            $list = Theme::orderBy('id', 'desc');
            $list =$list->skip( ($pageno-1)*$pagelength )->take($pagelength)
                    ->get();
            $data['data'] = $list;
            $data['current_page'] = $pageno;
            $data['total'] = $totalrecords;
            $data['per_page'] = $pagelength;

            if($totalrecords){
                return $this->sendResponse(false, 200, $data, 'Theme Details.');
            } else {
                return $this->sendResponse(true, 233, null, 'Failed to get frame details');
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
            
            $list = Theme::where('status',1)->orderBy('id', 'desc')->get();
            if($list){
                return $this->sendResponse(false, 200, $list, 'Frame Details.');
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
            'title'    => ['required', 'unique:themes,title,NULL,id,deleted_at,NULL'],
            'diamond_weekly' => 'required|numeric',
            'diamond_twoweeks' => 'required|numeric',
            'diamond_montly' => 'required|numeric',
            'diamond_yearly' => 'required|numeric',
            'picture' => ['required', 'mimes:jpeg,jpg,png', 'max:1024' ],
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
               $request['theme_pic']=$this->uploadPicture($request,'themes/pictures');
            }
             
            $request['created_at'] = date('Y-m-d H:i:s');
            $result=Theme::create($request->except('picture'));

            if($result){
                return $this->sendResponse(false, 200, null, 'Theme has been created successfully.');
            } else {
                return $this->sendResponse(true, 233, null, 'Failed to submit theme details');
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
            $data=Theme::where('id', $id)->first();
            if(!empty($data)){
                return $this->sendResponse(false, 200, $data, 'Theme data found');
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
            'title'    => ['required', 'unique:themes,title,'.$id.',id,deleted_at,NULL'],
            'diamond_weekly' => 'required|numeric',
            'diamond_twoweeks' => 'required|numeric',
            'diamond_montly' => 'required|numeric',
            'diamond_yearly' => 'required|numeric',
            'status' => 'required'
        ];

        if ($file=$request->file('picture')) {
            $rules = array_merge($rules, array(
                'picture' => 'mimes:jpeg,jpg,png|max:1024' 
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
               $request['theme_pic']=$this->uploadPicture($request,'themes/pictures');
            }
            
            $request['updated_at'] = date('Y-m-d H:i:s');
            $result=Theme::where('id', $id)->update($request->except('picture'));

            if($result){
                return $this->sendResponse(false, 200, null, 'Theme has been updated successfully.');
            } else {
                return $this->sendResponse(true, 233, null, 'Failed to submit theme details');
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
            $data=Theme::where('id', $id)->first();
            if($data){
                Theme::where('id', $id)->delete();
                return $this->sendResponse(false, 200, null, 'Theme details removed');
            }else{
                return $this->sendResponse(true, 233, null, 'Data not found');
            }
        } catch(\Exception $e){
             return $this->sendResponse(true, 233, null, $e->GetMessage());
        }
    }
}
