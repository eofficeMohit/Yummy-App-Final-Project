<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use Validator;

class ChatsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $pageno = 1; $pagelength = 20;
            if (isset($request->pagelength, $request->pageno) && !empty($request->pagelength)) {
                $pagelength = $request->pagelength;
                $pageno = $request->pageno;
            }
             
            $end_date = date('Y-m-d 23:59:59');
            $start_date = date('Y-m-d 00:00:00', strtotime( $end_date . ' -7 day' ) );

            $totalrecords = Chat::count();
            $list = Chat::orderBy('id', 'desc')
                    ->whereBetween('created_at', [$start_date, $end_date]);

            if(isset($request->category_id)){
                $list=$list->where('category_id', $request->category_id);
            }

            $list =$list->skip( ($pageno-1)*$pagelength )->take($pagelength)
                    ->get();
            $data['data'] = $list;
            $data['current_page'] = $pageno;
            $data['total'] = $totalrecords;
            $data['per_page'] = $pagelength;

            if($totalrecords){
                return $this->sendResponse(false, 200, $data, 'Chat Details.');
            } else {
                return $this->sendResponse(true, 233, null, 'Failed to get chat details');
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
            'category_id' => 'required|numeric',
            'title' => 'required',
            'tags' => 'required',
            'live_type' => 'required',
            'username' => 'required',
            'userid' => 'required|numeric',
            'profile_url' => 'required',
            'room_id' => 'required|numeric',
            'level' => 'required|numeric',
            'call_status' => 'required',
            'user_status' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }

        try{
            $request['created_at']=date('Y-m-d H:i:s');
            $result=Chat::insert($request->all()); 

            if($result){
                return $this->sendResponse(false, 200, null, 'Chat has been created successfully.');
            } else {
                return $this->sendResponse(true, 233, null, 'Failed to submit chat details');
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
            $data=Chat::where('id', $id)->first();
            if(!empty($data)){
                return $this->sendResponse(false, 200, $data, 'chat data found');
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
         $validator = Validator::make($request->all(), [
            'category_id' => 'required|numeric',
            'title' => 'required',
            'tags' => 'required',
            'live_type' => 'required',
            'username' => 'required',
            'userid' => 'required|numeric',
            'profile_url' => 'required',
            'room_id' => 'required|numeric',
            'level' => 'required|numeric',
            'call_status' => 'required',
            'user_status' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }

        try{
            $request['updated_at']=date('Y-m-d H:i:s');
            $result=Chat::where('id', $id)->update($request->all()); 

            if($result){
                return $this->sendResponse(false, 200, null, 'Chat status updated successfully.');
            } else {
                return $this->sendResponse(true, 233, null, 'Failed to modify chat details');
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
            $data=Chat::where('id', $id)->first();
            if($data){
                Chat::where('id', $id)->delete();

                return $this->sendResponse(false, 200, null, 'Chat details removed');
            }else{
                return $this->sendResponse(true, 233, null, 'Data not found');
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
    public function destroy_all($id)
    {
        try{
            $data=User::where('id', $id)->first();
            
            if($data){
                Chat::where('userid', $id)->delete();

                return $this->sendResponse(false, 200, null, 'Chat details removed');
            }else{
                return $this->sendResponse(true, 233, null, 'Data not found');
            }
        } catch(\Exception $e){
             return $this->sendResponse(true, 233, null, $e->GetMessage());
        }
    }
}
