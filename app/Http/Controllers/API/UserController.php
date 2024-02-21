<?php

namespace App\Http\Controllers\API;

use Facade\FlareClient\Api;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Validator;
use DB;
use \Session;
use File;


class UserController extends Controllers\BaseController
{


    public function directoryForTemp(){
        return 'temp/user';
    }

    public function directoryForFiles(){
        return 'user/files';
    }

    public function directoryForImages(){
        return 'user/images';
    }

    public function directoryForVideos(){
        return 'user/videos';
    }


    public function directoryForAudios(){
        return 'user/audios';
    }

    public function moduleName(){
        return 'User';
    }



    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */



    public function apiSignIn(Request $request)
    {



        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;

            $success['user'] =  $user;

            $request->session()->put('project', $user);




            return $this->sendResponse(false, 200, $success, 'User login successfully.');

        }
        else{
            return $this->sendResponse(true, 342, null, 'Email or password is incorrect.');
        }



    }


















    public function SignUpCountryHead(Request $request)
    {


        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'full_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',


        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------




        //------------------------------Duplicate check for email----------------------------------------

        $usersData=DB::table('users')
            ->where('email',$request->email)
            ->count();

        if($usersData==1){
            return $this->sendResponse(true, 223, null, 'Email already exist.');
        }

        //------------------------------Duplicate check for email----------------------------------------





        //--------------------------------------User Registration---------------------------------------------

        $input = $request->all(); //Store all request data in variable
        $input['user_type_id'] = 7; //Country head
        $input['country_code_id'] = $request->country_code;

        $input['gender'] = $request->gender;
        $input['image'] = 'user/images/'.$request->profile_picture_details;


        $input['id_front'] = $request->front_gov_id_details;
        $input['id_back'] = $request->back_gov_id_details;
        $input['id_number'] = $request->id_number;

        $input['count_posts'] = 0;
        $input['count_followers'] = 0;
        $input['count_following'] = 0;

        $input['no_of_followings'] = 0;
        $input['no_of_followers'] = 0;

        $nine_digit_code = mt_rand(100000000, 999999999);

        $input['code'] = $nine_digit_code;

        $input['wallet'] = 0;
        $input['beans'] = 0;
        $input['coins'] = 0;
        $input['diamonds'] = 0;

        $input['status'] = 'Pending';

        $input['password'] = bcrypt($input['password']); //Encrypt password
        $user = User::create($input); //create user put all information
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['full_name'] =  $user->full_name;
        $user_id = $user->id;

        //-------------------------------------/User Registration---------------------------------------------



        if($request->address!=null){

            $address_id=DB::table('addresses')->insertGetId(
                [
                    'reference_id' => $user_id,
                    'reference_type' => 'User',

                    'address' => $request->address,

                    'created_by_user_id' => $user_id,
                    'status' => 'Active',
                ]
                , 'id');

        }






        if($request->resume_details!=null){

            $resume_id=DB::table('resumes')->insertGetId(
                [
                    'file' => $request->resume_details,

                    'created_by_user_id' => $user_id,
                    'status' => 'Active',
                ]
                , 'id');

        }



        if($request->company_name!=null || $request->company_registration_number!=null){

            $company_id=DB::table('companies')->insertGetId(
                [
                    'title' => $request->company_name,
                    'reg_number' => $request->company_registration_number,

                    'created_by_user_id' => $user_id,
                    'status' => 'Active',
                ]
                , 'id');



            if($request->company_address!=null){

                $address_id=DB::table('addresses')->insertGetId(
                    [
                        'reference_id' => $company_id,
                        'reference_type' => 'Company',

                        'address' => $request->company_address,

                        'created_by_user_id' => $user_id,
                        'status' => 'Active',
                    ]
                    , 'id');

            }

        }



        if($request->bank_name!=null || $request->iban!=null || $request->swift_bic_code!=null || $request->branch_code!=null || $request->account_title!=null || $request->account_number!=null){

            $payment_method_id=DB::table('payment_methods')->insertGetId(
                [
                    'bank_name' => $request->bank_name,
                    'iban' => $request->iban,
                    'swift_bic' => $request->swift_bic,
                    'branch_code' => $request->branch_code,
                    'account_title' => $request->account_title,
                    'account_number' => $request->account_number,

                    'created_by_user_id' => $user_id,
                    'status' => 'Active',
                ]
                , 'id');

        }




        $data= [
            'code' => url('/').'/sign-up/admin?head='.$nine_digit_code
        ];





        if($success==true){
            return $this->sendResponse(false, 200, $data, 'Country Head register successfully.');
        }else{
            return $this->sendResponse(true, 233, null, 'Country Head registration failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function SignUpAdmin(Request $request)
    {


        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'full_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',


        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------






        //------------------------------code check----------------------------------------

        $AdminData=DB::table('users')
            ->where('user_type_id',7) //Country Head
            ->where('code',$request->reference_code)
            ->count();

        if($AdminData==0){
            return $this->sendResponse(true, 223, null, 'Country Head reference code not found.');
        }

        //------------------------------code check----------------------------------------






        //------------------------------Duplicate check for email----------------------------------------

        $usersData=DB::table('users')
            ->where('email',$request->email)
            ->count();

        if($usersData==1){
            return $this->sendResponse(true, 223, null, 'Email already exist.');
        }

        //------------------------------Duplicate check for email----------------------------------------





        //--------------------------------------User Registration---------------------------------------------

        $input = $request->all(); //Store all request data in variable
        $input['user_type_id'] = 2; //Admin
        $input['country_code_id'] = $request->country_code;

        $input['gender'] = $request->gender;
        $input['image'] = 'user/images/'.$request->profile_picture_details;


        $input['id_front'] = $request->front_gov_id_details;
        $input['id_back'] = $request->back_gov_id_details;
        $input['id_number'] = $request->id_number;

        $input['count_posts'] = 0;
        $input['count_followers'] = 0;
        $input['count_following'] = 0;

        $input['no_of_followings'] = 0;
        $input['no_of_followers'] = 0;

        $nine_digit_code = mt_rand(100000000, 999999999);

        $input['code'] = $nine_digit_code;

        $input['wallet'] = 0;
        $input['beans'] = 0;
        $input['coins'] = 0;
        $input['diamonds'] = 0;


        $input['status'] = 'Pending';

        $input['password'] = bcrypt($input['password']); //Encrypt password
        $user = User::create($input); //create user put all information
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['full_name'] =  $user->full_name;
        $user_id = $user->id;

        //-------------------------------------/User Registration---------------------------------------------



        if($request->address!=null){

            $address_id=DB::table('addresses')->insertGetId(
                [
                    'reference_id' => $user_id,
                    'reference_type' => 'User',

                    'address' => $request->address,

                    'created_by_user_id' => $user_id,
                    'status' => 'Active',
                ]
                , 'id');

        }






        if($request->resume_details!=null){

            $resume_id=DB::table('resumes')->insertGetId(
                [
                    'file' => $request->resume_details,

                    'created_by_user_id' => $user_id,
                    'status' => 'Active',
                ]
                , 'id');

        }



        if($request->company_name!=null || $request->company_registration_number!=null){

            $company_id=DB::table('companies')->insertGetId(
                [
                    'title' => $request->company_name,
                    'reg_number' => $request->company_registration_number,

                    'created_by_user_id' => $user_id,
                    'status' => 'Active',
                ]
                , 'id');



            if($request->company_address!=null){

                $address_id=DB::table('addresses')->insertGetId(
                    [
                        'reference_id' => $company_id,
                        'reference_type' => 'Company',

                        'address' => $request->company_address,

                        'created_by_user_id' => $user_id,
                        'status' => 'Active',
                    ]
                    , 'id');

            }

        }



        if($request->bank_name!=null || $request->iban!=null || $request->swift_bic_code!=null || $request->branch_code!=null || $request->account_title!=null || $request->account_number!=null){

            $payment_method_id=DB::table('payment_methods')->insertGetId(
                [
                    'bank_name' => $request->bank_name,
                    'iban' => $request->iban,
                    'swift_bic' => $request->swift_bic,
                    'branch_code' => $request->branch_code,
                    'account_title' => $request->account_title,
                    'account_number' => $request->account_number,

                    'created_by_user_id' => $user_id,
                    'status' => 'Active',
                ]
                , 'id');

        }




        $data= [
            'code' => url('/').'/sign-up/agency?admin='.$nine_digit_code
        ];





        if($success==true){
            return $this->sendResponse(false, 200, $data, 'Admin register successfully.');
        }else{
            return $this->sendResponse(true, 233, null, 'Admin register failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function SignUpAgency(Request $request)
    {


        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'full_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',


        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------





        //------------------------------code check----------------------------------------

        $AdminData=DB::table('users')
            ->where('user_type_id',2) //Admin
            ->where('code',$request->reference_code)
            ->count();

        if($AdminData==0){
            return $this->sendResponse(true, 223, null, 'Admin reference code not found.');
        }

        //------------------------------code check----------------------------------------





        //------------------------------Duplicate check for email----------------------------------------

        $usersData=DB::table('users')
            ->where('email',$request->email)
            ->count();

        if($usersData==1){
            return $this->sendResponse(true, 223, null, 'Email already exist.');
        }

        //------------------------------Duplicate check for email----------------------------------------




        //--------------------------------------User Registration---------------------------------------------

        $input = $request->all(); //Store all request data in variable
        $input['user_type_id'] = 4; //Agency
        $input['country_code_id'] = $request->country_code;

        $input['reference_code'] = $request->reference_code;

        $input['gender'] = $request->gender;
        $input['image'] = 'user/images/'.$request->profile_picture_details;


        $input['id_front'] = $request->front_gov_id_details;
        $input['id_back'] = $request->back_gov_id_details;
        $input['id_number'] = $request->id_number;

        $input['count_posts'] = 0;
        $input['count_followers'] = 0;
        $input['count_following'] = 0;

        $input['no_of_followings'] = 0;
        $input['no_of_followers'] = 0;

        $nine_digit_code = mt_rand(100000000, 999999999);

        $input['code'] = $nine_digit_code;

        $input['wallet'] = 0;
        $input['beans'] = 0;
        $input['coins'] = 0;
        $input['diamonds'] = 0;


        $input['status'] = 'Pending';

        $input['password'] = bcrypt($input['password']); //Encrypt password
        $user = User::create($input); //create user put all information
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['full_name'] =  $user->full_name;
        $user_id = $user->id;

        //-------------------------------------/User Registration---------------------------------------------



        if($request->address!=null){

            $address_id=DB::table('addresses')->insertGetId(
                [
                    'reference_id' => $user_id,
                    'reference_type' => 'User',

                    'address' => $request->address,

                    'created_by_user_id' => $user_id,
                    'status' => 'Active',
                ]
                , 'id');

        }






        if($request->resume_details!=null){

            $resume_id=DB::table('resumes')->insertGetId(
                [
                    'file' => $request->resume_details,

                    'created_by_user_id' => $user_id,
                    'status' => 'Active',
                ]
                , 'id');

        }



        if($request->company_name!=null || $request->company_registration_number!=null){

            $company_id=DB::table('companies')->insertGetId(
                [
                    'title' => $request->company_name,
                    'reg_number' => $request->company_registration_number,

                    'created_by_user_id' => $user_id,
                    'status' => 'Active',
                ]
                , 'id');



            if($request->company_address!=null){

                $address_id=DB::table('addresses')->insertGetId(
                    [
                        'reference_id' => $company_id,
                        'reference_type' => 'Company',

                        'address' => $request->company_address,

                        'created_by_user_id' => $user_id,
                        'status' => 'Active',
                    ]
                    , 'id');

            }

        }



        if($request->bank_name!=null || $request->iban!=null || $request->swift_bic_code!=null || $request->branch_code!=null || $request->account_title!=null || $request->account_number!=null){

            $payment_method_id=DB::table('payment_methods')->insertGetId(
                [
                    'bank_name' => $request->bank_name,
                    'iban' => $request->iban,
                    'swift_bic' => $request->swift_bic,
                    'branch_code' => $request->branch_code,
                    'account_title' => $request->account_title,
                    'account_number' => $request->account_number,

                    'created_by_user_id' => $user_id,
                    'status' => 'Active',
                ]
                , 'id');

        }




        $data= [
            'code' => url('/').'/sign-up/host?agency='.$nine_digit_code
        ];





        if($success==true){
            return $this->sendResponse(false, 200, $data, 'Agency register successfully.');
        }else{
            return $this->sendResponse(true, 233, null, 'Agency register failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function SignUpHost(Request $request)
    {


        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'full_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',


        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------





        //------------------------------code check----------------------------------------

        $AgencyData=DB::table('users')
            ->where('user_type_id',4) //Agency
            ->where('code',$request->reference_code)
            ->count();

        if($AgencyData==0){
            return $this->sendResponse(true, 223, null, 'Agency reference code not found.');
        }

        //------------------------------code check----------------------------------------





        //------------------------------Duplicate check for email----------------------------------------

        $usersData=DB::table('users')
            ->where('email',$request->email)
            ->count();

        if($usersData==1){
            return $this->sendResponse(true, 223, null, 'Email already exist.');
        }

        //------------------------------Duplicate check for email----------------------------------------




        //--------------------------------------User Registration---------------------------------------------

        $input = $request->all(); //Store all request data in variable
        $input['user_type_id'] = 3; //Host
        $input['country_code_id'] = $request->country_code;

        $input['reference_code'] = $request->reference_code;

        $input['gender'] = $request->gender;
        $input['image'] = 'user/images/'.$request->profile_picture_details;


        $input['id_front'] = $request->front_gov_id_details;
        $input['id_back'] = $request->back_gov_id_details;
        $input['id_number'] = $request->id_number;

        $input['count_posts'] = 0;
        $input['count_followers'] = 0;
        $input['count_following'] = 0;

        $input['no_of_followings'] = 0;
        $input['no_of_followers'] = 0;

        $nine_digit_code = mt_rand(100000000, 999999999);

        $input['code'] = $nine_digit_code;

        $input['wallet'] = 0;
        $input['beans'] = 0;
        $input['coins'] = 0;
        $input['diamonds'] = 0;

        $input['status'] = 'Pending';

        $input['password'] = bcrypt($input['password']); //Encrypt password
        $user = User::create($input); //create user put all information
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['full_name'] =  $user->full_name;
        $user_id = $user->id;

        //-------------------------------------/User Registration---------------------------------------------



        if($request->address!=null){

            $address_id=DB::table('addresses')->insertGetId(
                [
                    'reference_id' => $user_id,
                    'reference_type' => 'User',

                    'address' => $request->address,

                    'created_by_user_id' => $user_id,
                    'status' => 'Active',
                ]
                , 'id');

        }






        if($request->resume_details!=null){

            $resume_id=DB::table('resumes')->insertGetId(
                [
                    'file' => $request->resume_details,

                    'created_by_user_id' => $user_id,
                    'status' => 'Active',
                ]
                , 'id');

        }



        if($request->company_name!=null || $request->company_registration_number!=null){

            $company_id=DB::table('companies')->insertGetId(
                [
                    'title' => $request->company_name,
                    'reg_number' => $request->company_registration_number,

                    'created_by_user_id' => $user_id,
                    'status' => 'Active',
                ]
                , 'id');



            if($request->company_address!=null){

                $address_id=DB::table('addresses')->insertGetId(
                    [
                        'reference_id' => $company_id,
                        'reference_type' => 'Company',

                        'address' => $request->company_address,

                        'created_by_user_id' => $user_id,
                        'status' => 'Active',
                    ]
                    , 'id');

            }

        }



        if($request->bank_name!=null || $request->iban!=null || $request->swift_bic_code!=null || $request->branch_code!=null || $request->account_title!=null || $request->account_number!=null){

            $payment_method_id=DB::table('payment_methods')->insertGetId(
                [
                    'bank_name' => $request->bank_name,
                    'iban' => $request->iban,
                    'swift_bic' => $request->swift_bic,
                    'branch_code' => $request->branch_code,
                    'account_title' => $request->account_title,
                    'account_number' => $request->account_number,

                    'created_by_user_id' => $user_id,
                    'status' => 'Active',
                ]
                , 'id');

        }




        $data= [
            'code' => url('/').'/sign-up/host?agency='.$nine_digit_code
        ];





        if($success==true){
            return $this->sendResponse(false, 200, $data, 'Host register successfully.');
        }else{
            return $this->sendResponse(true, 233, null, 'Host register failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function SignUpAgent(Request $request)
    {


        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'full_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',


        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------




        //------------------------------Duplicate check for email----------------------------------------

        $usersData=DB::table('users')
            ->where('email',$request->email)
            ->count();

        if($usersData==1){
            return $this->sendResponse(true, 223, null, 'Email already exist.');
        }

        //------------------------------Duplicate check for email----------------------------------------





        //--------------------------------------User Registration---------------------------------------------

        $input = $request->all(); //Store all request data in variable
        $input['user_type_id'] = 5; //Agent
        $input['country_code_id'] = $request->country_code;

        $input['gender'] = $request->gender;
        $input['image'] = 'user/images/'.$request->profile_picture_details;


        $input['id_front'] = $request->front_gov_id_details;
        $input['id_back'] = $request->back_gov_id_details;
        $input['id_number'] = $request->id_number;

        $input['count_posts'] = 0;
        $input['count_followers'] = 0;
        $input['count_following'] = 0;

        $input['no_of_followings'] = 0;
        $input['no_of_followers'] = 0;

        $nine_digit_code = mt_rand(100000000, 999999999);

        $input['code'] = $nine_digit_code;

        $input['wallet'] = 0;
        $input['beans'] = 0;
        $input['coins'] = 0;
        $input['diamonds'] = 0;


        $input['status'] = 'Pending';

        $input['password'] = bcrypt($input['password']); //Encrypt password
        $user = User::create($input); //create user put all information
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['full_name'] =  $user->full_name;
        $user_id = $user->id;

        //-------------------------------------/User Registration---------------------------------------------



        if($request->address!=null){

            $address_id=DB::table('addresses')->insertGetId(
                [
                    'reference_id' => $user_id,
                    'reference_type' => 'User',

                    'address' => $request->address,

                    'created_by_user_id' => $user_id,
                    'status' => 'Active',
                ]
                , 'id');

        }






        if($request->resume_details!=null){

            $resume_id=DB::table('resumes')->insertGetId(
                [
                    'file' => $request->resume_details,

                    'created_by_user_id' => $user_id,
                    'status' => 'Active',
                ]
                , 'id');

        }



        if($request->company_name!=null || $request->company_registration_number!=null){

            $company_id=DB::table('companies')->insertGetId(
                [
                    'title' => $request->company_name,
                    'reg_number' => $request->company_registration_number,

                    'created_by_user_id' => $user_id,
                    'status' => 'Active',
                ]
                , 'id');



            if($request->company_address!=null){

                $address_id=DB::table('addresses')->insertGetId(
                    [
                        'reference_id' => $company_id,
                        'reference_type' => 'Company',

                        'address' => $request->company_address,

                        'created_by_user_id' => $user_id,
                        'status' => 'Active',
                    ]
                    , 'id');

            }

        }



        if($request->bank_name!=null || $request->iban!=null || $request->swift_bic_code!=null || $request->branch_code!=null || $request->account_title!=null || $request->account_number!=null){

            $payment_method_id=DB::table('payment_methods')->insertGetId(
                [
                    'bank_name' => $request->bank_name,
                    'iban' => $request->iban,
                    'swift_bic' => $request->swift_bic,
                    'branch_code' => $request->branch_code,
                    'account_title' => $request->account_title,
                    'account_number' => $request->account_number,

                    'created_by_user_id' => $user_id,
                    'status' => 'Active',
                ]
                , 'id');

        }




        $data= [
            'code' => url('/').'/sign-up/agency?admin='.$nine_digit_code
        ];





        if($success==true){
            return $this->sendResponse(false, 200, $data, 'Admin register successfully.');
        }else{
            return $this->sendResponse(true, 233, null, 'Admin register failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function SignUpUser(Request $request)
    {


        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'full_name' => 'required',
            'email' => 'required|email',
//            'number' => 'required',
            'password' => 'required',


        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------




        //------------------------------Duplicate check for email----------------------------------------

        $usersData=DB::table('users')
            ->where('email',$request->email)
            ->count();

        if($usersData==1){
            return $this->sendResponse(true, 223, null, 'Email already exist.');
        }

        //------------------------------Duplicate check for email----------------------------------------





        //--------------------------------------User Registration---------------------------------------------

        $input = $request->all(); //Store all request data in variable
        $input['user_type_id'] = 6; //User
        $input['country_code_id'] = 181;

        $input['count_posts'] = 0;
        $input['count_followers'] = 0;
        $input['count_following'] = 0;

        $input['no_of_followings'] = 0;
        $input['no_of_followers'] = 0;


        $nine_digit_code = mt_rand(100000000, 999999999);

        $input['code'] = $nine_digit_code;

        $input['wallet'] = 0;
        $input['beans'] = 0;
        $input['coins'] = 0;
        $input['diamonds'] = 0;


        $input['status'] = 'Active';

        $input['password'] = bcrypt($input['password']); //Encrypt password
        $user = User::create($input); //create user put all information
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['full_name'] =  $user->full_name;
        $user_id = $user->id;

        //-------------------------------------/User Registration---------------------------------------------



        if($success==true){
            return $this->sendResponse(false, 200, null, 'User register successfully.');
        }else{
            return $this->sendResponse(true, 233, null, 'User register failed.');
        }

        //-------------------------------------------------------------------------

    }















    public function userUpdate(Request $request)
    {

        $timezone = "Asia/Dhaka";
        date_default_timezone_set($timezone);

        $is_session=$this->GetSession();

        if($is_session){
            $session_user_id = $request->session()->get('project')->id;
            $User=$this->GetUsersSqlData($request, $session_user_id, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        }else{
            $User=null;
        }



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'first_name' => 'required',
            'last_name' => 'required',
            'email_address' => 'required',
            'phone_number' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------



        $query=DB::table('users')
            ->where('id', $session_user_id)
            ->update(
                [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,

                    'full_name' => $request->first_name.' '.$request->last_name,

                    'gender' => $request->gender,
                    'username' => $request->username,
                    'email' => $request->email_address,
                    'number' => $request->phone_number,
                    'about' => $request->about,

                    'address' => $request->address,
                    'facebook' => $request->facebook,
                    'linkedin' => $request->linkedin,
                    'twitter' => $request->twitter,
                    'instagram' => $request->instagram,

                    'status' => 'Active',
                    'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
                    'updated_by_user_id' => $session_user_id,
                ]
            );

        //------------------------------------/Registration-----------------------------------------------



        if($query){
            return $this->sendResponse(false, 200, null, 'User register successfully.');
        }else{
            return $this->sendResponse(true, 233, null, 'User register failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function userDelete(Request $request)
    {


        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'id' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------


        //---------------------------Validation-------------------------------------
        $UserData = DB::table('users')
            ->leftJoin('user_types', 'users.user_type_id', '=', 'user_types.id')
            ->select(
                'users.id as id',
                'users.user_type_id as user_type_id',
                'user_types.title as user_type_title',
                'user_types.slug as user_type_slug',

                'users.status as status'
            )
            ->first();

        //---------------------------Validation-------------------------------------




        //-------------------------------------Delete-----------------------------------------------

        $query=DB::table('users')->where('id', '=', $request->id)->delete();

        if($UserData->user_type_slug=='agency'){
            $query=DB::table('agencies')->where('created_by_user_id', '=', $request->id)->delete();
        }

        //------------------------------------/Delete-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Record has been deleted.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function userBlock(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'id' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------


        $query=DB::table('users')
            ->where('id', '=', $request->id)
            ->update(
                [
                    'status' => 'Blocked',
                ]
            );

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'User has been blocked.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function userUnblocked(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'id' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------


        $query=DB::table('users')
            ->where('id', '=', $request->id)
            ->update(
                [
                    'status' => 'Active',
                ]
            );

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'User has been unblocked.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }




    public function userValidateEmail(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'email' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //------------------------------Duplicate check for email----------------------------------------

        $usersData=DB::table('users')
            ->where('email',$request->email)
            ->count();

        if($usersData>=1){
            return $this->sendResponse(true, 223, null, 'Email already exist.');
        }

        //------------------------------Duplicate check for email----------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Great, You can register through this email');
        }else{
            return $this->sendResponse(true, 233, null, 'Something went wrong');
        }

        //-------------------------------------------------------------------------

    }

    public function userValidateNumber(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'country_code' => 'required',
            'number' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //------------------------------Duplicate check for email----------------------------------------

        $usersData=DB::table('users')
            ->where('country_code_id',$request->country_code)
            ->where('number',$request->number)
            ->count();



        if($usersData>=1){
            return $this->sendResponse(true, 223, null, 'Number already exist.');
        }

        //------------------------------Duplicate check for email----------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Great, You can register through this number');
        }else{
            return $this->sendResponse(true, 233, null, 'Something went wrong');
        }

        //-------------------------------------------------------------------------

    }


    public function userValidateCountryHeadCode(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'reference_code' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //------------------------------Duplicate check for email----------------------------------------

        $usersData=DB::table('users')
            ->where('user_type_id',7) //Country Head
            ->where('code',$request->reference_code)
            ->count();



        if($usersData==0){
            return $this->sendResponse(true, 223, null, 'Code is invalid.');
        }

        //------------------------------Duplicate check for email----------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Great, You can register through this number');
        }else{
            return $this->sendResponse(true, 233, null, 'Something went wrong');
        }

        //-------------------------------------------------------------------------

    }


    public function userValidateAdminCode(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'reference_code' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //------------------------------Duplicate check for email----------------------------------------

        $usersData=DB::table('users')
            ->where('user_type_id',2) //Admin
            ->where('code',$request->reference_code)
            ->count();



        if($usersData==0){
            return $this->sendResponse(true, 223, null, 'Code is invalid.');
        }

        //------------------------------Duplicate check for email----------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Great, You can register through this number');
        }else{
            return $this->sendResponse(true, 233, null, 'Something went wrong');
        }

        //-------------------------------------------------------------------------

    }

    public function userValidateAgencyCode(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'reference_code' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //------------------------------Duplicate check for email----------------------------------------

        $usersData=DB::table('users')
            ->where('user_type_id',4) //Agency
            ->where('code',$request->reference_code)
            ->count();



        if($usersData==0){
            return $this->sendResponse(true, 223, null, 'Code is invalid.');
        }

        //------------------------------Duplicate check for email----------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Great, You can register through this number');
        }else{
            return $this->sendResponse(true, 233, null, 'Something went wrong');
        }

        //-------------------------------------------------------------------------

    }


    public function userApprove(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'id' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------


        $query=DB::table('users')
            ->where('id', '=', $request->id)
            ->update(
                [
                    'status' => 'Active',
                ]
            );

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'User has been Activated.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }





    public function agencyDelete(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'id' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //---------------------------Data-------------------------------------

        $AgencyData = DB::table('agencies')
            ->where('id',$request->id)
            ->first();

        //--------------------------/Data-------------------------------------








        //-------------------------------------Registration-----------------------------------------------

        $query=DB::table('agencies')->where('id', '=', $request->id)->delete();
        $query=DB::table('users')->where('id', '=', $AgencyData->created_by_user_id)->delete();

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Record has been deleted.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function agencyBlock(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'id' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------


        $query=DB::table('agencies')
            ->where('id', '=', $request->id)
            ->update(
                [
                    'status' => 'Blocked',
                ]
            );

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Agency has been blocked.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function agencyUnblocked(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'id' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------


        $query=DB::table('agencies')
            ->where('id', '=', $request->id)
            ->update(
                [
                    'status' => 'Active',
                ]
            );

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Agency has been unblocked.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function agencyApprove(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'id' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------


        $query=DB::table('agencies')
            ->where('id', '=', $request->id)
            ->update(
                [
                    'status' => 'Active',
                ]
            );

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Agency has been Activated.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }







    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;

            $success['user'] =  $user;

            $request->session()->put('project', $user);

            return $this->sendResponse(false, 200, $success, 'User login successfully.');

        }
        else{
            return $this->sendResponse(true, 342, null, 'Email or password is incorrect.');
        }



    }


    public function forgot(Request $request)
    {

        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //------------------------------Duplicate check for email----------------------------------------

        $usersData=DB::table('users')
            ->where('email',$request->email)
            ->count();

        if($usersData==0){
            return $this->sendResponse(true, 223, null, 'Email not found.');
        }

        //------------------------------Duplicate check for email----------------------------------------



        $six_digit_random_number = mt_rand(100000, 999999);


//        $details = [
//            'title' => 'Deal Board Password Reset Code',
//            'body' => 'You have requested a password reset, your password reset code is '.$six_digit_random_number
//        ];
//
//        \Mail::to($request->email)->send(new \App\Mail\ForgotPasswordMail($details));
//



        //------------------------------------Email Registration-----------------------------------------------


        $password_reset_id=DB::table('password_resets')->insertGetId(
            [
                'email' => $request->email,
                'code' => $six_digit_random_number,
                'token' => sha1(time()),
                'status' => 'Active',
            ]
            , 'id');

        //-----------------------------------/Email Registration-----------------------------------------------




        //-------------------------------------------------------------------------

        if(true){
            return $this->sendResponse(false, 200, null, 'User register successfully.');
        }else{
            return $this->sendResponse(true, 233, null, 'User register failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function validateCode(Request $request)
    {

        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------


        //------------------------------Duplicate check for email----------------------------------------

        $passwordResetCount=DB::table('password_resets')
            ->where('code',$request->code)
            ->where('status','Active')
            ->count();

        if($passwordResetCount==0){
            return $this->sendResponse(true, 223, null, 'Code is invalid.');
        }

        //------------------------------Duplicate check for email----------------------------------------



        $passwordResetData=DB::table('password_resets')
            ->where('code',$request->code)
            ->where('status','Active')
            ->first();






        //-------------------------------------------------------------------------

        if(true){
            return $this->sendResponse(false, 200, $passwordResetData->token, 'User register successfully.');
        }else{
            return $this->sendResponse(true, 233, null, 'User register failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function changePassword(Request $request)
    {

        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'token' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        $passwordResetCount=DB::table('password_resets')
            ->where('token',$request->token)
            ->where('status','Active')
            ->count();

        if($passwordResetCount==0){
            return $this->sendResponse(true, 223, null, 'Token expired.');
        }




        $passwordResetData=DB::table('password_resets')
            ->where('token',$request->token)
            ->where('status','Active')
            ->first();



        $query=DB::table('users')
            ->where('email', $passwordResetData->email)
            ->update(
                [
                    'password' => bcrypt($request->password),
                ]
            );


        $query=DB::table('password_resets')
            ->where('token',$request->token)
            ->update(
                [
                    'status' => 'Inactive',
                ]
            );


        //-------------------------------------------------------------------------

        if(true){
            return $this->sendResponse(false, 200, null, 'Password successfully changed.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request failed.');
        }

        //-------------------------------------------------------------------------

    }





    public function contactCreate(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'subject' => 'required',
            'email' => 'required',
            'number' => 'required',
            'message' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------


        $contact_id=DB::table('contacts')->insertGetId(
            [
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,

                'status' => 'Active',
            ]
            , 'id');

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Request has been sent successfully.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function contactDelete(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'id' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------

        $query=DB::table('contacts')->where('id', '=', $request->id)->delete();

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Record has been deleted.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }





    public function onboardCountryHeadCreate(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'title' => 'required',
            'valid_from' => 'required',
            'valid_till' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------


        $onboard_id=DB::table('onboards')->insertGetId(
            [
                'code' => mt_rand(100000000, 999999999),
                'title' => $request->title,
                'description' => $request->description,
                'valid_from' => $request->valid_from,
                'valid_till' => $request->valid_till,
                'type' => 'Country Head',

                'status' => 'Active',
            ]
            , 'id');

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Link has been created.');
        }else{
            return $this->sendResponse(true, 233, null, 'Link has been failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function onboardAdminCreate(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'title' => 'required',
            'valid_from' => 'required',
            'valid_till' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------


        $onboard_id=DB::table('onboards')->insertGetId(
            [
                'code' => mt_rand(100000000, 999999999),
                'title' => $request->title,
                'description' => $request->description,
                'valid_from' => $request->valid_from,
                'valid_till' => $request->valid_till,
                'type' => 'Admin',

                'status' => 'Active',
            ]
            , 'id');

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Link has been created.');
        }else{
            return $this->sendResponse(true, 233, null, 'Link has been failed.');
        }

        //-------------------------------------------------------------------------

    }


    public function onboardTopUpAgentCreate(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'title' => 'required',
            'valid_from' => 'required',
            'valid_till' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------


        $onboard_id=DB::table('onboards')->insertGetId(
            [
                'code' => mt_rand(100000000, 999999999),
                'title' => $request->title,
                'description' => $request->description,
                'valid_from' => $request->valid_from,
                'valid_till' => $request->valid_till,
                'type' => 'TopUp Agent',

                'status' => 'Active',
            ]
            , 'id');

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Link has been created.');
        }else{
            return $this->sendResponse(true, 233, null, 'Link has been failed.');
        }

        //-------------------------------------------------------------------------

    }


    public function onboardDelete(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'id' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------

        $query=DB::table('onboards')->where('id', '=', $request->id)->delete();

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Record has been deleted.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }








    public function faqCreate(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'question' => 'required',
            'answer' => 'required',
            'type' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------


        $faq_id=DB::table('faqs')->insertGetId(
            [
                'question' => $request->question,
                'answer' => $request->answer,
                'type' => $request->type,

                'status' => 'Active',
            ]
            , 'id');

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'FAQ has been saved successfully.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function faqDelete(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'id' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------

        $query=DB::table('faqs')->where('id', '=', $request->id)->delete();

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Record has been deleted.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }













    public function categoryParentCreate(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'title' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------


        $parent_category_id=DB::table('parent_categories')->insertGetId(
            [
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,

                'status' => 'Active',
            ]
            , 'id');

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Request has been sent successfully.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function categoryParentDelete(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'id' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------

        $query=DB::table('parent_categories')->where('id', '=', $request->id)->delete();

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Record has been deleted.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }




    public function categoryChildCreate(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'parent_category_id' => 'required',
            'title' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------


        $child_category_id=DB::table('child_categories')->insertGetId(
            [
                'parent_category_id' => $request->parent_category_id,
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,

                'status' => 'Active',
            ]
            , 'id');

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Request has been sent successfully.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function categoryChildDelete(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'id' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------

        $query=DB::table('child_categories')->where('id', '=', $request->id)->delete();

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Record has been deleted.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }



    public function categorySubChildCreate(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'child_category_id' => 'required',
            'title' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------


        $sub_child_category_id=DB::table('sub_child_categories')->insertGetId(
            [
                'child_category_id' => $request->child_category_id,
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,

                'status' => 'Active',
            ]
            , 'id');

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Request has been sent successfully.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }


    public function categorySubChildDelete(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'id' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------

        $query=DB::table('sub_child_categories')->where('id', '=', $request->id)->delete();

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Record has been deleted.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }






    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

    public function signUpUploadUserPicture(Request $request){




        $timezone = "Asia/Dhaka";
        date_default_timezone_set($timezone);

        $is_session=$this->GetSession();

        if($is_session){
            $session_user_id = $request->session()->get('project')->id;
            $User=$this->GetUsersSqlData($request, $session_user_id, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        }else{
            $User=null;
        }



        $CurrentDateTime = date('Y-m-d H:i:s');
        $BaseURL= URL::to('/');

        $DirectoryPath=$this->directoryForImages();
        $UploadedFile=null;
        $inc=0;


        if($request->hasFile('file')) {


//            if(Storage::makeDirectory('public/'.$DirectoryPath)){ //Old code for storage

            $inc++;
            $RealPath = $request->file('file')->getRealPath(); //Actual Path
//                $UploadedFile= $request->file('file')->store('public/'.$DirectoryPath); //Uploaded Path //Old code for storage
            $UploadedFile= $request->file('file')->store($DirectoryPath, ['disk' => 'public_uploads']); //Uploaded Path
            $UploadedFile= basename($UploadedFile); //Get File name from URL



//            }else{ //Old code for storage
//                $output=['response'=>['code'=>'78', 'status'=>'Failed', 'message'=>'Directory Not Created.']];
//                return response()->json($output);
//            } //Old code for storage


        }else{
            $output=['response'=>['code'=>'40', 'status'=>'Failed', 'message'=>'File Not Found.']];
            return response()->json($output);
        }


        if($inc==1){




            $output=['response'=>[
                'code'=>'200',
                'status'=>'Success',
                'message'=>'Successfully Uploaded.',
                'fileName'=>$UploadedFile
            ]];

            return response()->json($output);
        }else{

            $output=['response'=>[
                'code'=>'0',
                'status'=>'Failed',
                'message'=>'Operation Failed, Contact System administrator.'
            ]];

            return response()->json($output);

        }

    }


    public function signUpUploadUserResume(Request $request){




        $timezone = "Asia/Dhaka";
        date_default_timezone_set($timezone);

        $is_session=$this->GetSession();

        if($is_session){
            $session_user_id = $request->session()->get('project')->id;
            $User=$this->GetUsersSqlData($request, $session_user_id, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        }else{
            $User=null;
        }



        $CurrentDateTime = date('Y-m-d H:i:s');
        $BaseURL= URL::to('/');

        $DirectoryPath='user/resume';
        $UploadedFile=null;
        $inc=0;


        if($request->hasFile('file')) {


//            if(Storage::makeDirectory('public/'.$DirectoryPath)){ //Old code for storage

            $inc++;
            $RealPath = $request->file('file')->getRealPath(); //Actual Path
//                $UploadedFile= $request->file('file')->store('public/'.$DirectoryPath); //Uploaded Path //Old code for storage
            $UploadedFile= $request->file('file')->store($DirectoryPath, ['disk' => 'public_uploads']); //Uploaded Path
            $UploadedFile= basename($UploadedFile); //Get File name from URL



//            }else{ //Old code for storage
//                $output=['response'=>['code'=>'78', 'status'=>'Failed', 'message'=>'Directory Not Created.']];
//                return response()->json($output);
//            } //Old code for storage


        }else{
            $output=['response'=>['code'=>'40', 'status'=>'Failed', 'message'=>'File Not Found.']];
            return response()->json($output);
        }


        if($inc==1){




            $output=['response'=>[
                'code'=>'200',
                'status'=>'Success',
                'message'=>'Successfully Uploaded.',
                'fileName'=>$UploadedFile
            ]];

            return response()->json($output);
        }else{

            $output=['response'=>[
                'code'=>'0',
                'status'=>'Failed',
                'message'=>'Operation Failed, Contact System administrator.'
            ]];

            return response()->json($output);

        }

    }


    public function signUpUploadUserIDFront(Request $request){




        $timezone = "Asia/Dhaka";
        date_default_timezone_set($timezone);

        $is_session=$this->GetSession();

        if($is_session){
            $session_user_id = $request->session()->get('project')->id;
            $User=$this->GetUsersSqlData($request, $session_user_id, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        }else{
            $User=null;
        }



        $CurrentDateTime = date('Y-m-d H:i:s');
        $BaseURL= URL::to('/');

        $DirectoryPath='user/ids';
        $UploadedFile=null;
        $inc=0;


        if($request->hasFile('file')) {


//            if(Storage::makeDirectory('public/'.$DirectoryPath)){ //Old code for storage

            $inc++;
            $RealPath = $request->file('file')->getRealPath(); //Actual Path
//                $UploadedFile= $request->file('file')->store('public/'.$DirectoryPath); //Uploaded Path //Old code for storage
            $UploadedFile= $request->file('file')->store($DirectoryPath, ['disk' => 'public_uploads']); //Uploaded Path
            $UploadedFile= basename($UploadedFile); //Get File name from URL



//            }else{ //Old code for storage
//                $output=['response'=>['code'=>'78', 'status'=>'Failed', 'message'=>'Directory Not Created.']];
//                return response()->json($output);
//            } //Old code for storage


        }else{
            $output=['response'=>['code'=>'40', 'status'=>'Failed', 'message'=>'File Not Found.']];
            return response()->json($output);
        }


        if($inc==1){




            $output=['response'=>[
                'code'=>'200',
                'status'=>'Success',
                'message'=>'Successfully Uploaded.',
                'fileName'=>$UploadedFile
            ]];

            return response()->json($output);
        }else{

            $output=['response'=>[
                'code'=>'0',
                'status'=>'Failed',
                'message'=>'Operation Failed, Contact System administrator.'
            ]];

            return response()->json($output);

        }

    }


    public function signUpUploadUserIDBack(Request $request){




        $timezone = "Asia/Dhaka";
        date_default_timezone_set($timezone);

        $is_session=$this->GetSession();

        if($is_session){
            $session_user_id = $request->session()->get('project')->id;
            $User=$this->GetUsersSqlData($request, $session_user_id, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        }else{
            $User=null;
        }



        $CurrentDateTime = date('Y-m-d H:i:s');
        $BaseURL= URL::to('/');

        $DirectoryPath='user/ids';
        $UploadedFile=null;
        $inc=0;


        if($request->hasFile('file')) {


//            if(Storage::makeDirectory('public/'.$DirectoryPath)){ //Old code for storage

            $inc++;
            $RealPath = $request->file('file')->getRealPath(); //Actual Path
//                $UploadedFile= $request->file('file')->store('public/'.$DirectoryPath); //Uploaded Path //Old code for storage
            $UploadedFile= $request->file('file')->store($DirectoryPath, ['disk' => 'public_uploads']); //Uploaded Path
            $UploadedFile= basename($UploadedFile); //Get File name from URL



//            }else{ //Old code for storage
//                $output=['response'=>['code'=>'78', 'status'=>'Failed', 'message'=>'Directory Not Created.']];
//                return response()->json($output);
//            } //Old code for storage


        }else{
            $output=['response'=>['code'=>'40', 'status'=>'Failed', 'message'=>'File Not Found.']];
            return response()->json($output);
        }


        if($inc==1){




            $output=['response'=>[
                'code'=>'200',
                'status'=>'Success',
                'message'=>'Successfully Uploaded.',
                'fileName'=>$UploadedFile
            ]];

            return response()->json($output);
        }else{

            $output=['response'=>[
                'code'=>'0',
                'status'=>'Failed',
                'message'=>'Operation Failed, Contact System administrator.'
            ]];

            return response()->json($output);

        }

    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -




    // - - - - - - - - - - - - - - - - - - -Update Banner and Picture- - - - - - - - - - - - - - - - - - - - - - - - -

    public function uploadProfilePicture(Request $request){




        $timezone = "Asia/Dhaka";
        date_default_timezone_set($timezone);

        $is_session=$this->GetSession();

        if($is_session){
            $session_user_id = $request->session()->get('project')->id;
            $User=$this->GetUsersSqlData($request, $session_user_id, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        }else{
            $User=null;
        }



        $CurrentDateTime = date('Y-m-d H:i:s');
        $BaseURL= URL::to('/');

        $DirectoryPath=$this->directoryForImages();
        $UploadedFile=null;
        $inc=0;


        if($request->hasFile('file')) {


//            if(Storage::makeDirectory('public/'.$DirectoryPath)){ //Old code for storage

            $inc++;
            $RealPath = $request->file('file')->getRealPath(); //Actual Path
//                $UploadedFile= $request->file('file')->store('public/'.$DirectoryPath); //Uploaded Path //Old code for storage
            $UploadedFile= $request->file('file')->store($DirectoryPath, ['disk' => 'public_uploads']); //Uploaded Path
            $UploadedFile= basename($UploadedFile); //Get File name from URL



//            }else{ //Old code for storage
//                $output=['response'=>['code'=>'78', 'status'=>'Failed', 'message'=>'Directory Not Created.']];
//                return response()->json($output);
//            } //Old code for storage


        }else{
            $output=['response'=>['code'=>'40', 'status'=>'Failed', 'message'=>'File Not Found.']];
            return response()->json($output);
        }


        if($inc==1){




            $query=DB::table('users')
                ->where('id', $session_user_id)
                ->update(
                    [
                        'image' => $DirectoryPath.'/'.$UploadedFile,

                        'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
                        'updated_by_user_id' => $session_user_id,
                    ]
                );









            $output=['response'=>[
                'code'=>'200',
                'status'=>'Success',
                'message'=>'Successfully Uploaded.',
                'fileName'=>$UploadedFile
            ]];

            return response()->json($output);
        }else{

            $output=['response'=>[
                'code'=>'0',
                'status'=>'Failed',
                'message'=>'Operation Failed, Contact System administrator.'
            ]];

            return response()->json($output);

        }

    }



    public function uploadProfileBanner(Request $request){




        $timezone = "Asia/Dhaka";
        date_default_timezone_set($timezone);

        $is_session=$this->GetSession();

        if($is_session){
            $session_user_id = $request->session()->get('project')->id;
            $User=$this->GetUsersSqlData($request, $session_user_id, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        }else{
            $User=null;
        }



        $CurrentDateTime = date('Y-m-d H:i:s');
        $BaseURL= URL::to('/');

        $DirectoryPath=$this->directoryForImages();
        $UploadedFile=null;
        $inc=0;


        if($request->hasFile('file')) {


//            if(Storage::makeDirectory('public/'.$DirectoryPath)){ //Old code for storage

            $inc++;
            $RealPath = $request->file('file')->getRealPath(); //Actual Path
//                $UploadedFile= $request->file('file')->store('public/'.$DirectoryPath); //Uploaded Path //Old code for storage
            $UploadedFile= $request->file('file')->store($DirectoryPath, ['disk' => 'public_uploads']); //Uploaded Path
            $UploadedFile= basename($UploadedFile); //Get File name from URL



//            }else{ //Old code for storage
//                $output=['response'=>['code'=>'78', 'status'=>'Failed', 'message'=>'Directory Not Created.']];
//                return response()->json($output);
//            } //Old code for storage


        }else{
            $output=['response'=>['code'=>'40', 'status'=>'Failed', 'message'=>'File Not Found.']];
            return response()->json($output);
        }


        if($inc==1){




            $query=DB::table('users')
                ->where('id', $session_user_id)
                ->update(
                    [
                        'banner' => $DirectoryPath.'/'.$UploadedFile,

                        'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
                        'updated_by_user_id' => $session_user_id,
                    ]
                );









            $output=['response'=>[
                'code'=>'200',
                'status'=>'Success',
                'message'=>'Successfully Uploaded.',
                'fileName'=>$UploadedFile
            ]];

            return response()->json($output);
        }else{

            $output=['response'=>[
                'code'=>'0',
                'status'=>'Failed',
                'message'=>'Operation Failed, Contact System administrator.'
            ]];

            return response()->json($output);

        }

    }

    // - - - - - - - - - - - - - - - - - - -Update Banner and Picture- - - - - - - - - - - - - - - - - - - - - - - - -





    // - - - - - - - - - - - - - - - - - - - NewsFeed - - - - - - - - - - - - - - - - - - - - - - - - -


    public function NewsFeedCreate(Request $request)
    {



        $galleryImageCount = $request->galleryImageCount;
        $galleryImages = json_decode($request->galleryImages);



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'privacy' => 'required',
            'description' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------




        $timezone = "Asia/Dhaka";
        date_default_timezone_set($timezone);

        $is_session=$this->GetSession();

        if($is_session){
            $session_user_id = $request->session()->get('project')->id;
            $User=$this->GetUsersSqlData($request, $session_user_id, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        }else{
            $User=null;
        }



        //-------------------------------------Registration-----------------------------------------------


        $newsfeed_id=DB::table('newsfeeds')->insertGetId(
            [
                'privacy_id' => $request->privacy,
                'description' => $request->description,
                'type' => 'General',

                'status' => 'Active',
                'created_by_user_id' => $session_user_id,
            ]
            , 'id');

        //------------------------------------/Registration-----------------------------------------------




        // -------------- For Gallery Insert --------------
        if($galleryImageCount>0){

            $DirectoryTempPath=$this->directoryForTemp();
            $DirectoryImagesPath=$this->directoryForImages();

            foreach($galleryImages as $key=> $dataTemp){

                $serverResponseImage = $dataTemp->serverResponseFileName;


                if($key==0){

                    $query=DB::table('newsfeeds')
                        ->where('id', '=', $newsfeed_id)
                        ->update(
                            [
                                'thumbnail' => $serverResponseImage,
                            ]
                        );
                }


//                if($serverResponseImage!=null && $serverResponseImage!='' && $serverResponseImage!=' ' && File::exists(public_path('uploads/'.$DirectoryTempPath.'/'.$serverResponseImage))){
//
//
//                    if (!File::exists(public_path('uploads/'.$DirectoryImagesPath)))
//                    {
//
//                        File::makeDirectory('uploads/'.$DirectoryImagesPath, 0777, true, true);
//
//                    }
//
//                    File::move(public_path('uploads/'.$DirectoryTempPath.'/'.$serverResponseImage), public_path('uploads/'.$DirectoryImagesPath.'/'.$serverResponseImage));
//
//                    $source=$DirectoryImagesPath.'/'.$serverResponseImage;
//                }else{
//                    $source=null;
//                }
//
//                if($source!=null){
//                    $query=DB::table('galleries')->insert(
//                        [
//                            'reference_id' => $newsfeed_id,
//                            'reference_type' => 'Newsfeed',
//                            'title' => $request->description,
//                            'caption' => $request->description,
//                            'alt_text' => $request->description,
//                            'source' => $source,
//                            'thumbnail' => $source,
//                            'status' => 'Active',
//                        ]
//                    );
//                }



            }

        }
        // -------------- For Gallery Insert --------------




        //---------------------Increment---------------------

//        $postsData=DB::table('posts')
////            ->where('created_by_user_id',$session_user_id)
////            ->count();
////
////
////        $query=DB::table('users')
////            ->where('id', $session_user_id)
////            ->update(
////                [
////                    'count_posts' => $postsData,
////                ]
////            );


        //---------------------Increment---------------------






        if(true){
            return $this->sendResponse(false, 200, null, 'Post has been created successfully.');
        }else{
            return $this->sendResponse(true, 233, null, 'Post has been failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function NewsFeedDelete(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'id' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------

        $query=DB::table('newsfeeds')->where('id', '=', $request->id)->delete();

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Record has been deleted.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function NewsFeedReport(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'id' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------

        //$query=DB::table('newsfeeds')->where('id', '=', $request->id)->delete();

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Record has been Reported.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function newsfeedGalleryUpload(Request $request){

        $CurrentDateTime = date('Y-m-d H:i:s');
        $BaseURL= URL::to('/');

        $DirectoryPath='newsfeed';
        $UploadedFile=null;
        $inc=0;


        if($request->hasFile('file')) {


//            if(Storage::makeDirectory('public/'.$DirectoryPath)){ //Old code for storage

            $inc++;
            $RealPath = $request->file('file')->getRealPath(); //Actual Path
//                $UploadedFile= $request->file('file')->store('public/'.$DirectoryPath); //Uploaded Path //Old code for storage
            $UploadedFile= $request->file('file')->store($DirectoryPath, ['disk' => 'public_uploads']); //Uploaded Path
            $UploadedFile= basename($UploadedFile); //Get File name from URL



//            }else{ //Old code for storage
//                $output=['response'=>['code'=>'78', 'status'=>'Failed', 'message'=>'Directory Not Created.']];
//                return response()->json($output);
//            } //Old code for storage


        }else{
            $output=['response'=>['code'=>'40', 'status'=>'Failed', 'message'=>'File Not Found.']];
            return response()->json($output);
        }


        if($inc==1){
            $output=['response'=>[
                'code'=>'200',
                'status'=>'Success',
                'message'=>'Successfully Uploaded.',
                'fileName'=>$UploadedFile
            ]];

            return response()->json($output);
        }else{

            $output=['response'=>[
                'code'=>'0',
                'status'=>'Failed',
                'message'=>'Operation Failed, Contact System administrator.'
            ]];

            return response()->json($output);

        }

    }

    public function newsfeedGalleryDelete(Request $request){

        $CurrentDateTime = date('Y-m-d H:i:s');
        $BaseURL= URL::to('/');

        $DirectoryPath='newsfeed';
        $inc=0;


        $rename_name=$request['rename_name'];

        if($rename_name!='' && $rename_name!=null){
//            Storage::delete('public/'.$DirectoryPath.'/'.$rename_name); //Old code for storage

            if(File::exists(public_path('uploads/'.$DirectoryPath.'/'.$rename_name))){
                File::delete(public_path('uploads/'.$DirectoryPath.'/'.$rename_name));
                $inc++;
            }else{
                $output=['response'=>['code'=>'88', 'status'=>'Failed', 'message'=>'File does not exists.']];
                return response()->json($output);
            }


        }else{
            $output=['response'=>['code'=>'88', 'status'=>'Failed', 'message'=>'File ID Not be Null.']];
            return response()->json($output);
        }






        if($inc==1){

            $output=['response'=>[
                'code'=>'200',
                'status'=>'Success',
                'message'=>'Successfully Deleted.'
            ]];

            return response()->json($output);

        }else{

            $output=['response'=>[
                'code'=>'0',
                'status'=>'Failed',
                'message'=>'Operation Failed, Contact System administrator.'
            ]];

            return response()->json($output);

        }


    }

    // - - - - - - - - - - - - - - - - - - -/NewsFeed - - - - - - - - - - - - - - - - - - - - - - - - -








    // - - - - - - - - - - - - - - - - - - - Story - - - - - - - - - - - - - - - - - - - - - - - - -

    public function storyView(Request $request)
    {



        $galleryImageCount = $request->galleryImageCount;
        $galleryImages = json_decode($request->galleryImages);



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'id' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------




        $timezone = "Asia/Dhaka";
        date_default_timezone_set($timezone);

        $is_session=$this->GetSession();

        if($is_session){
            $session_user_id = $request->session()->get('project')->id;
            $User=$this->GetUsersSqlData($request, $session_user_id, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        }else{
            $User=null;
        }


        $Story=DB::table('stories')
            ->leftJoin('users', 'stories.created_by_user_id', '=', 'users.id')
            ->select(
                'stories.id as id',
                'stories.reference_id as reference_id',
                'stories.reference_type as reference_type',

                'stories.description as description',
                'stories.thumbnail as thumbnail',
                'stories.published_at as published_at',
                'stories.expires_at as expires_at',

                'stories.status as status',
                'stories.order_by as order_by',



                'stories.created_by_comp_id as created_by_comp_id',

                'stories.created_by_user_id as created_by_user_id',
                'users.full_name as user_full_name',
                'users.image as user_image',
                'users.slug as user_slug',

                'stories.updated_by_user_id as updated_by_user_id',
                'stories.deleted_by_user_id as deleted_by_user_id',
                'stories.created_at as created_at',
                'stories.updated_at as updated_at',
                'stories.deleted_at as deleted_at'

            )
            ->where('stories.id',$request->id)
            ->where('stories.status','Active')
            ->first();


        $html='<div class="modal-dialog modal-dialog-centered" style="max-width: 300px; margin: 5px auto;">
                    <div class="modal-content">

                        <div class="modal-body  d-flex align-items-center justify-content-center" style="min-height: 470px; padding: 0px;">

                            <div style="position: absolute; top: 5px; right: 5px">
                                <div style="background-color: red; border-radius: 50px; height: 23px; width: 23px; text-align: center" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-times" style="font-size: 12px; color: white"></i>
                                </div>
                            </div>

                            <img src="uploads/'.$Story->thumbnail.'" style="width: 100%">
                        </div>
                    </div>
                </div>';


        $data= [
            'id' => $Story->id,
            'thumbnail' => $Story->thumbnail,
            'html' => $html,
        ];


        if(true){
            return $this->sendResponse(false, 200, $data, 'Story successfully viewed.');
        }else{
            return $this->sendResponse(true, 233, null, 'Story viewed failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function storyCreate(Request $request)
    {



        $galleryImageCount = $request->galleryImageCount;
        $galleryImages = json_decode($request->galleryImages);



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'privacy' => 'required',
            'description' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------




        $timezone = "Asia/Dhaka";
        date_default_timezone_set($timezone);

        $is_session=$this->GetSession();

        if($is_session){
            $session_user_id = $request->session()->get('project')->id;
            $User=$this->GetUsersSqlData($request, $session_user_id, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        }else{
            $User=null;
        }



        //-------------------------------------Registration-----------------------------------------------


        $story_id=DB::table('stories')->insertGetId(
            [
                'privacy_id' => $request->privacy,
                'reference_id' => null,
                'reference_type' => null,
                'slug' => $request->description,
                'description' => $request->description,



                'status' => 'Active',
                'created_by_user_id' => $session_user_id,
            ]
            , 'id');

        //------------------------------------/Registration-----------------------------------------------




        // -------------- For Gallery Insert --------------
        if($galleryImageCount>0){

            $DirectoryTempPath=$this->directoryForTemp();
            $DirectoryImagesPath=$this->directoryForImages();

            foreach($galleryImages as $key=> $dataTemp){

                $serverResponseImage = $dataTemp->serverResponseFileName;


                if($key==0){

                    $query=DB::table('stories')
                        ->where('id', '=', $story_id)
                        ->update(
                            [
                                'thumbnail' => $serverResponseImage,
                            ]
                        );
                }


//                if($serverResponseImage!=null && $serverResponseImage!='' && $serverResponseImage!=' ' && File::exists(public_path('uploads/'.$DirectoryTempPath.'/'.$serverResponseImage))){
//
//
//                    if (!File::exists(public_path('uploads/'.$DirectoryImagesPath)))
//                    {
//
//                        File::makeDirectory('uploads/'.$DirectoryImagesPath, 0777, true, true);
//
//                    }
//
//                    File::move(public_path('uploads/'.$DirectoryTempPath.'/'.$serverResponseImage), public_path('uploads/'.$DirectoryImagesPath.'/'.$serverResponseImage));
//
//                    $source=$DirectoryImagesPath.'/'.$serverResponseImage;
//                }else{
//                    $source=null;
//                }
//
//                if($source!=null){
//                    $query=DB::table('galleries')->insert(
//                        [
//                            'reference_id' => $newsfeed_id,
//                            'reference_type' => 'Newsfeed',
//                            'title' => $request->description,
//                            'caption' => $request->description,
//                            'alt_text' => $request->description,
//                            'source' => $source,
//                            'thumbnail' => $source,
//                            'status' => 'Active',
//                        ]
//                    );
//                }



            }

        }
        // -------------- For Gallery Insert --------------




        //---------------------Increment---------------------

//        $postsData=DB::table('posts')
////            ->where('created_by_user_id',$session_user_id)
////            ->count();
////
////
////        $query=DB::table('users')
////            ->where('id', $session_user_id)
////            ->update(
////                [
////                    'count_posts' => $postsData,
////                ]
////            );


        //---------------------Increment---------------------






        if(true){
            return $this->sendResponse(false, 200, null, 'Story has been created successfully.');
        }else{
            return $this->sendResponse(true, 233, null, 'Story has been failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function storyDelete(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'id' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------

        $query=DB::table('stories')->where('id', '=', $request->id)->delete();

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Record has been deleted.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function storyReport(Request $request)
    {



        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'id' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------



        //-------------------------------------Registration-----------------------------------------------

        //$query=DB::table('newsfeeds')->where('id', '=', $request->id)->delete();

        //------------------------------------/Registration-----------------------------------------------



        if(true){
            return $this->sendResponse(false, 200, null, 'Record has been Reported.');
        }else{
            return $this->sendResponse(true, 233, null, 'Request has been failed.');
        }

        //-------------------------------------------------------------------------

    }

    public function storyGalleryUpload(Request $request){

        $CurrentDateTime = date('Y-m-d H:i:s');
        $BaseURL= URL::to('/');

        $DirectoryPath='story';
        $UploadedFile=null;
        $inc=0;


        if($request->hasFile('file')) {


//            if(Storage::makeDirectory('public/'.$DirectoryPath)){ //Old code for storage

            $inc++;
            $RealPath = $request->file('file')->getRealPath(); //Actual Path
//                $UploadedFile= $request->file('file')->store('public/'.$DirectoryPath); //Uploaded Path //Old code for storage
            $UploadedFile= $request->file('file')->store($DirectoryPath, ['disk' => 'public_uploads']); //Uploaded Path
            $UploadedFile= basename($UploadedFile); //Get File name from URL



//            }else{ //Old code for storage
//                $output=['response'=>['code'=>'78', 'status'=>'Failed', 'message'=>'Directory Not Created.']];
//                return response()->json($output);
//            } //Old code for storage


        }else{
            $output=['response'=>['code'=>'40', 'status'=>'Failed', 'message'=>'File Not Found.']];
            return response()->json($output);
        }


        if($inc==1){
            $output=['response'=>[
                'code'=>'200',
                'status'=>'Success',
                'message'=>'Successfully Uploaded.',
                'fileName'=>$UploadedFile
            ]];

            return response()->json($output);
        }else{

            $output=['response'=>[
                'code'=>'0',
                'status'=>'Failed',
                'message'=>'Operation Failed, Contact System administrator.'
            ]];

            return response()->json($output);

        }

    }

    public function storyGalleryDelete(Request $request){

        $CurrentDateTime = date('Y-m-d H:i:s');
        $BaseURL= URL::to('/');

        $DirectoryPath='story';
        $inc=0;


        $rename_name=$request['rename_name'];

        if($rename_name!='' && $rename_name!=null){
//            Storage::delete('public/'.$DirectoryPath.'/'.$rename_name); //Old code for storage

            if(File::exists(public_path('uploads/'.$DirectoryPath.'/'.$rename_name))){
                File::delete(public_path('uploads/'.$DirectoryPath.'/'.$rename_name));
                $inc++;
            }else{
                $output=['response'=>['code'=>'88', 'status'=>'Failed', 'message'=>'File does not exists.']];
                return response()->json($output);
            }


        }else{
            $output=['response'=>['code'=>'88', 'status'=>'Failed', 'message'=>'File ID Not be Null.']];
            return response()->json($output);
        }






        if($inc==1){

            $output=['response'=>[
                'code'=>'200',
                'status'=>'Success',
                'message'=>'Successfully Deleted.'
            ]];

            return response()->json($output);

        }else{

            $output=['response'=>[
                'code'=>'0',
                'status'=>'Failed',
                'message'=>'Operation Failed, Contact System administrator.'
            ]];

            return response()->json($output);

        }


    }

    // - - - - - - - - - - - - - - - - - - -/Story - - - - - - - - - - - - - - - - - - - - - - - - -



















    // - - - - - - - - - - - - - - - - - - - Live - - - - - - - - - - - - - - - - - - - - - - - - -

    public function liveCreate(Request $request)
    {

        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [

            'privacy' => 'required',

        ]);

        if($validator->fails()){
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------




        $timezone = "Asia/Dhaka";
        date_default_timezone_set($timezone);

        $is_session=$this->GetSession();

        if($is_session){
            $session_user_id = $request->session()->get('project')->id;
            $User=$this->GetUsersSqlData($request, $session_user_id, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        }else{
            $User=null;
        }



        //-------------------------------------Registration-----------------------------------------------


        $broadcast_id=DB::table('broadcasts')->insertGetId(
            [
                'privacy_id' => $request->privacy,

                'status' => 'Active',
                'created_by_user_id' => $session_user_id,
            ]
            , 'id');

        //------------------------------------/Registration-----------------------------------------------






        if(true){
            return $this->sendResponse(false, 200, null, 'Live has been created successfully.');
        }else{
            return $this->sendResponse(true, 233, null, 'Live has been failed.');
        }

        //-------------------------------------------------------------------------

    }

    // - - - - - - - - - - - - - - - - - - - /Live - - - - - - - - - - - - - - - - - - - - - - - - -



}
