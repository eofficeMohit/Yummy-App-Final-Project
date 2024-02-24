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

class ApiMobileController extends Controllers\BaseController
{
    public function directoryForTemp()
    {
        return 'temp/user';
    }

    public function directoryForFiles()
    {
        return 'user/files';
    }

    public function directoryForImages()
    {
        return 'user/images';
    }

    public function directoryForVideos()
    {
        return 'user/videos';
    }

    public function directoryForAudios()
    {
        return 'user/audios';
    }

    public function moduleName()
    {
        return 'User';
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

    public function signIn(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            $success['base_url'] = URL::to('/uploads');

            $success['token'] = $user->createToken('MyApp')->accessToken;

            $User = $this->GetUsersSqlData($request, $user->id, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
            $success['User'] = $User;

            $request->session()->put('project', $user);

            return $this->sendResponse(false, 200, $success, 'User login successfully.');
        } else {
            return $this->sendResponse(true, 342, null, 'Email or password is incorrect.');
        }
    }

    public function signUp(Request $request)
    {
        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------

        //------------------------------Duplicate check for email----------------------------------------

        $usersData = DB::table('users')
            ->where('email', $request->email)
            ->count();

        if ($usersData == 1) {
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
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['full_name'] = $user->full_name;
        $user_id = $user->id;

        //-------------------------------------/User Registration---------------------------------------------

        if ($success == true) {
            return $this->sendResponse(false, 200, null, 'User register successfully.');
        } else {
            return $this->sendResponse(true, 233, null, 'User register failed.');
        }

        //-------------------------------------------------------------------------
    }

    public function forgotPassword(Request $request)
    {
        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------

        //------------------------------Duplicate check for email----------------------------------------

        $countData = DB::table('users')
            ->where('email', $request->email)
            ->count();

        if ($countData == 0) {
            return $this->sendResponse(true, 223, null, 'Could not find your account.');
        }

        //------------------------------Duplicate check for email----------------------------------------

        $userData = DB::table('users')
            ->where('email', $request->email)
            ->first();

        $six_digit_random_number = mt_rand(100000, 999999);

        $details = [
            'title' => 'Password reset code',
            'body' => 'Hi ' . $userData->full_name . ',<br><br> You recently requested to reset the password for your account. Please use this code to reset the password.<br><br>Your password reset code is <strong>' . $six_digit_random_number . '</strong>',
        ];

        \Mail::to($request->email)->send(new \App\Mail\ForgotPasswordMail($details));

        //------------------------------------Email Registration-----------------------------------------------

        $password_reset_id = DB::table('password_resets')->insertGetId(
            [
                'email' => $request->email,
                'code' => $six_digit_random_number,
                'token' => sha1(time()),
                'status' => 'Active',
            ],
            'id',
        );

        //-----------------------------------/Email Registration-----------------------------------------------

        //-------------------------------------------------------------------------

        if (true) {
            return $this->sendResponse(false, 200, null, 'Successfully sent.');
        } else {
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

        if ($validator->fails()) {
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------

        //------------------------------Duplicate check for email----------------------------------------

        $passwordResetCount = DB::table('password_resets')
            ->where('code', $request->code)
            ->where('status', 'Active')
            ->count();

        if ($passwordResetCount == 0) {
            return $this->sendResponse(true, 223, null, 'Code is invalid.');
        }

        //------------------------------Duplicate check for email----------------------------------------

        $passwordResetData = DB::table('password_resets')
            ->where('code', $request->code)
            ->where('status', 'Active')
            ->first();

        //-------------------------------------------------------------------------

        if (true) {
            return $this->sendResponse(false, 200, $passwordResetData->token, 'Code successfully verified.');
        } else {
            return $this->sendResponse(true, 233, null, 'User register failed.');
        }

        //-------------------------------------------------------------------------
    }

    public function resetPassword(Request $request)
    {
        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------

        $passwordResetCount = DB::table('password_resets')
            ->where('token', $request->token)
            ->where('status', 'Active')
            ->count();

        if ($passwordResetCount == 0) {
            return $this->sendResponse(true, 223, null, 'Token expired.');
        }

        $passwordResetData = DB::table('password_resets')
            ->where('token', $request->token)
            ->where('status', 'Active')
            ->first();

        $query = DB::table('users')
            ->where('email', $passwordResetData->email)
            ->update([
                'password' => bcrypt($request->password),
            ]);

        $query = DB::table('password_resets')
            ->where('token', $request->token)
            ->update([
                'status' => 'Inactive',
            ]);

        //-------------------------------------------------------------------------

        if (true) {
            return $this->sendResponse(false, 200, null, 'Password successfully changed.');
        } else {
            return $this->sendResponse(true, 233, null, 'Request failed.');
        }

        //-------------------------------------------------------------------------
    }

    public function emailCheck(Request $request)
    {
        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------

        //------------------------------Duplicate check for email----------------------------------------

        $countData = DB::table('users')
            ->where('email', $request->email)
            ->count();

        if ($countData == 0) {
            return $this->sendResponse(true, 223, null, 'Could not find your account.');
        }

        //------------------------------Duplicate check for email----------------------------------------

        //-------------------------------------------------------------------------

        if ($countData == 1) {
            return $this->sendResponse(false, 200, null, 'Email already exist.');
        } else {
            return $this->sendResponse(true, 233, null, 'Some issue was found.');
        }

        //-------------------------------------------------------------------------
    }

    public function userRecommendations(Request $request)
    {
        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [
            'session_user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------

        //------------------------------check for id----------------------------------------

        $countData = DB::table('users')
            ->where('id', $request->session_user_id)
            ->count();

        if ($countData == 0) {
            return $this->sendResponse(true, 223, null, 'Session user ID not found.');
        }

        //------------------------------check for id----------------------------------------

        $Hosts = $this->GetToBeFollowingSqlData($request, null, $request->session_user_id, null, 'UserToUser', null, null, null, null, null, null, null, null, null);

        $Agents = $this->GetToBeFollowingSqlData($request, null, $request->session_user_id, null, 'UserToUser', null, null, null, null, null, null, null, null, null);

        $Users = $this->GetToBeFollowingSqlData($request, null, $request->session_user_id, null, 'UserToUser', null, null, null, null, null, null, null, null, null);

        $data = [
            'base_url' => \url('/uploads'),
            'Hosts' => $Hosts,
            'Agents' => $Agents,
            'Users' => $Users,
        ];

        //-------------------------------------------------------------------------

        if (true) {
            return $this->sendResponse(false, 200, $data, 'Success.');
        } else {
            return $this->sendResponse(true, 233, null, 'Some issue was found.');
        }

        //-------------------------------------------------------------------------
    }

    // - - - - - - - - - - - - - - - - - - -Update Banner and Picture- - - - - - - - - - - - - - - - - - - - - - - - -

    public function uploadProfilePicture(Request $request)
    {
        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [
            'session_user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------

        $session_user_id = $request->session_user_id;

        $CurrentDateTime = date('Y-m-d H:i:s');
        $BaseURL = URL::to('/uploads');

        $DirectoryPath = 'user/images';
        $UploadedFile = null;
        $inc = 0;

        if ($request->hasFile('file')) {
            $inc++;
            $RealPath = $request->file('file')->getRealPath(); //Actual Path
            $UploadedFile = $request->file('file')->store($DirectoryPath, ['disk' => 'public_uploads']); //Uploaded Path
            $UploadedFile = basename($UploadedFile); //Get File name from URL
        } else {
            return $this->sendResponse(true, 233, null, 'File Not Found.');
        }

        if ($inc == 1) {
            $query = DB::table('users')
                ->where('id', $session_user_id)
                ->update([
                    'image' => $DirectoryPath . '/' . $UploadedFile,

                    'updated_at' => date('Y-m-d H:i:s', strtotime('now')),
                    'updated_by_user_id' => $session_user_id,
                ]);

            $User = $this->GetUsersSqlData($request, $session_user_id, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

            $data = [
                'base_url' => \url('/uploads'),
                'User' => $User,
            ];

            return $this->sendResponse(false, 200, $data, 'Successfully Uploaded.');
        } else {
            return $this->sendResponse(true, 233, null, 'Operation Failed, Contact System administrator.');
        }
    }

    public function uploadProfileBanner(Request $request)
    {
        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [
            'session_user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------

        $session_user_id = $request->session_user_id;

        $CurrentDateTime = date('Y-m-d H:i:s');
        $BaseURL = URL::to('/uploads');

        $DirectoryPath = 'user/images';
        $UploadedFile = null;
        $inc = 0;

        if ($request->hasFile('file')) {
            $inc++;
            $RealPath = $request->file('file')->getRealPath(); //Actual Path
            $UploadedFile = $request->file('file')->store($DirectoryPath, ['disk' => 'public_uploads']); //Uploaded Path
            $UploadedFile = basename($UploadedFile); //Get File name from URL
        } else {
            return $this->sendResponse(true, 233, null, 'File Not Found.');
        }

        if ($inc == 1) {
            $query = DB::table('users')
                ->where('id', $session_user_id)
                ->update([
                    'banner' => $DirectoryPath . '/' . $UploadedFile,

                    'updated_at' => date('Y-m-d H:i:s', strtotime('now')),
                    'updated_by_user_id' => $session_user_id,
                ]);

            $User = $this->GetUsersSqlData($request, $session_user_id, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

            $data = [
                'base_url' => \url('/uploads'),
                'User' => $User,
            ];

            return $this->sendResponse(false, 200, $data, 'Successfully Uploaded.');
        } else {
            return $this->sendResponse(true, 233, null, 'Operation Failed, Contact System administrator.');
        }
    }

    // - - - - - - - - - - - - - - - - - - -Update Banner and Picture- - - - - - - - - - - - - - - - - - - - - - - - -

    // - - - - - - - - - - - - - - - - - - -General- - - - - - - - - - - - - - - - - - - - - - - - -

    public function general(Request $request)
    {
        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [
            'session_user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------

        $session_user_id = $request->session_user_id;

        //------------------------------check for id----------------------------------------

        $countData = DB::table('users')
            ->where('id', $request->session_user_id)
            ->count();

        if ($countData == 0) {
            return $this->sendResponse(true, 223, null, 'Session user ID not found.');
        }

        //------------------------------check for id----------------------------------------

        $Settings = $this->GetSettingsSqlData($request, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        $UserTypes = $this->GetUserTypesSqlData($request, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        $Privacies = $this->GetPrivaciesSqlData($request, null, null, null, null, null, null, null, null, null, null, null, null, null);

        $Banners = $this->GetBannersSqlData($request, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        $CountryCodes = $this->GetCountryCodesSqlData($request, null, null, null, null, null, null, null, null, null, null, null, null);

        $Countries = $this->GetCountriesSqlData($request, null, null, null, null, null, null, null, null, null, null, null);
        $Provinces = $this->GetProvincesSqlData($request, null, null, null, null, null, null, null, null, null, null, null, null);
        $Cities = $this->GetCitiesSqlData($request, null, null, null, null, null, null, null, null, null, null, null, null, null);
        $Areas = $this->GetAreasSqlData($request, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        $Locations = $this->GetLocationsSqlData($request, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

        $Newsfeeds = $this->GeneralNewsfeed($request, null, null, null, null);

        $Stories = $this->GeneralStories($request, $session_user_id, null, null, null);

        $Messages = $this->GeneralMessages($request, $session_user_id, null, null, null);

        $Broadcasts = $this->GetBroadcastsSqlData($request, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

        $Games = null;
        $NewsCategories = null;
        $BlogCategories = null;
        $EventsCategories = null;
        $NotificationCategories = null;

        $AudioStreams = null;
        $VideoStreams = null;

        $Events = null;
        $Notifications = null;

        $Store = null;
        $Freshers = null;
        $Populars = null;
        $PKs = null;

        $MyFollowers = null;
        $MyFollowing = null;
        $MyNewsfeeds = null;
        $MyBag = null;
        $MyLevel = null;
        $MyBadges = null;
        $MyInvites = null;
        $MyEarnings = null;

        $CountryHeads = null;
        $Admins = null;
        $Agencies = null;
        $Hosts = null;
        $Agents = null;
        $Users = null;

        $data = [
            'base_url' => \url('/uploads'),

            'Banners' => $Banners,
            'Stories' => $Stories,
            'Messages' => $Messages,

            'Settings' => $Settings,
            'UserTypes' => $UserTypes,

            'Privacies' => $Privacies,

            'CountryCodes' => $CountryCodes,

            'Countries' => $Countries,
            'Provinces' => $Provinces,
            'Cities' => $Cities,
            'Areas' => $Areas,
            'Locations' => $Locations,

            'Newsfeeds' => $Newsfeeds,

            'Broadcasts' => $Broadcasts,
            'NewsCategories' => $NewsCategories,
            'BlogCategories' => $BlogCategories,
            'EventsCategories' => $EventsCategories,
            'NotificationCategories' => $NotificationCategories,

            'Games' => $Games,

            'AudioStreams' => $AudioStreams,
            'VideoStreams' => $VideoStreams,

            'Events' => $Events,
            'Messages' => $Messages,
            'Notifications' => $Notifications,

            'Store' => $Store,
            'Freshers' => $Freshers,
            'Populars' => $Populars,
            'PKs' => $PKs,

            'MyFollowers' => $MyFollowers,
            'MyFollowing' => $MyFollowing,
            'MyNewsfeeds' => $MyNewsfeeds,

            'MyBag' => $MyBag,
            'MyLevel' => $MyLevel,
            'MyBadges' => $MyBadges,
            'MyInvites' => $MyInvites,
            'MyEarnings' => $MyEarnings,

            'CountryHeads' => $CountryHeads,
            'Admins' => $Admins,
            'Agencies' => $Agencies,
            'Hosts' => $Hosts,
            'Agents' => $Agents,
            'Users' => $Users,
        ];

        //-------------------------------------------------------------------------

        if (true) {
            return $this->sendResponse(false, 200, $data, 'Success.');
        } else {
            return $this->sendResponse(true, 233, null, 'Some issue was found.');
        }

        //-------------------------------------------------------------------------
    }

    // - - - - - - - - - - - - - - - - - - -General- - - - - - - - - - - - - - - - - - - - - - - - -

    public function updateProfile(Request $request)
    {
        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [
            'session_user_id' => 'required',
            'country_code_id' => 'required',

            'full_name' => 'required',
            'nickname' => 'required',
            'gender' => 'required',

            'number' => 'required',
            'email' => 'required',
            'date_of_birth' => 'required',
            'about' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------

        //------------------------------check for id----------------------------------------

        $countData = DB::table('users')
            ->where('id', $request->session_user_id)
            ->count();

        if ($countData == 0) {
            return $this->sendResponse(true, 223, null, 'Session user ID not found.');
        }

        //------------------------------check for id----------------------------------------

        //------------------------------Duplicate check for email----------------------------------------

        // later will do
        // $usersData=DB::table('users')
        //     ->where('email', $request->email)
        //     ->where('id', $request->session_user_id)
        //     ->count();

        // if($usersData==0){
        //     return $this->sendResponse(true, 223, null, 'Email already exist.');
        // }

        //------------------------------Duplicate check for email----------------------------------------

        //-------------------------------------Registration-----------------------------------------------

        $query = DB::table('users')
            ->where('id', $request->session_user_id)
            ->update([
                'country_code_id' => $request->country_code_id,

                'full_name' => $request->full_name,
                'nickname' => $request->nickname,

                'gender' => $request->gender,
                // 'email' => $request->email,
                'number' => $request->number,
                'date_of_birth' => $request->date_of_birth,
                'about' => $request->about,

                'status' => 'Active',
                'updated_at' => date('Y-m-d H:i:s', strtotime('now')),
                'updated_by_user_id' => $request->session_user_id,
            ]);

        //------------------------------------/Registration-----------------------------------------------

        $User = $this->GetUsersSqlData($request, $request->session_user_id, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

        $data = [
            'base_url' => \url('/uploads'),
            'User' => $User,
        ];

        if ($query) {
            return $this->sendResponse(false, 200, $data, 'Profile has been updated successfully.');
        } else {
            return $this->sendResponse(true, 233, null, 'Profile updation failed.');
        }

        //-------------------------------------------------------------------------
    }

    public function uploadNewsfeedPicture(Request $request)
    {
        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [
            'session_user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------

        $session_user_id = $request->session_user_id;

        $CurrentDateTime = date('Y-m-d H:i:s');
        $BaseURL = URL::to('/uploads');

        $DirectoryPath = 'newsfeed/images';
        $UploadedFile = null;
        $inc = 0;

        if ($request->hasFile('file')) {
            $inc++;
            $RealPath = $request->file('file')->getRealPath(); //Actual Path
            $UploadedFile = $request->file('file')->store($DirectoryPath, ['disk' => 'public_uploads']); //Uploaded Path
            $UploadedFile = basename($UploadedFile); //Get File name from URL
        } else {
            return $this->sendResponse(true, 233, null, 'File Not Found.');
        }

        if ($inc == 1) {
            $data = [
                'base_url' => \url('/uploads'),
                'directory' => $DirectoryPath,
                'uploaded_file' => $UploadedFile,
            ];

            return $this->sendResponse(false, 200, $data, 'Successfully Uploaded.');
        } else {
            return $this->sendResponse(true, 233, null, 'Operation Failed, Contact System administrator.');
        }
    }

    public function CreateNewsfeedGeneral(Request $request)
    {
        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [
            'session_user_id' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------

        $session_user_id = $request->session_user_id;

        //-------------------------------------Registration-----------------------------------------------

        $newsfeed_id = DB::table('newsfeeds')->insertGetId(
            [
                'privacy_id' => 1,
                'description' => $request->description,
                'thumbnail' => $request->image,
                'type' => 'General',

                'no_of_likes' => 0,
                'no_of_comments' => 0,
                'no_of_shares' => 0,
                'no_of_repost' => 0,

                'status' => 'Active',
                'created_by_user_id' => $session_user_id,
            ],
            'id',
        );

        //------------------------------------/Registration-----------------------------------------------

        //---------------------Increment---------------------

        $newsfeedsData = DB::table('newsfeeds')->where('created_by_user_id', $session_user_id)->count();

        $query = DB::table('users')
            ->where('id', $session_user_id)
            ->update([
                'count_posts' => $newsfeedsData,
            ]);

        //---------------------Increment---------------------

        $Newsfeeds = $this->GeneralNewsfeed($request, $session_user_id, null, null, null);

        $data = [
            'base_url' => \url('/uploads'),
            'Newsfeeds' => $Newsfeeds,
        ];

        if (true) {
            return $this->sendResponse(false, 200, $data, 'Newsfeed has been created successfully.');
        } else {
            return $this->sendResponse(true, 233, null, 'Newsfeed has been failed.');
        }

        //-------------------------------------------------------------------------
    }

    public function uploadStoryPicture(Request $request)
    {
        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [
            'session_user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------

        $session_user_id = $request->session_user_id;

        $CurrentDateTime = date('Y-m-d H:i:s');
        $BaseURL = URL::to('/uploads');

        $DirectoryPath = 'story/images';
        $UploadedFile = null;
        $inc = 0;

        if ($request->hasFile('file')) {
            $inc++;
            $RealPath = $request->file('file')->getRealPath(); //Actual Path
            $UploadedFile = $request->file('file')->store($DirectoryPath, ['disk' => 'public_uploads']); //Uploaded Path
            $UploadedFile = basename($UploadedFile); //Get File name from URL
        } else {
            return $this->sendResponse(true, 233, null, 'File Not Found.');
        }

        if ($inc == 1) {
            $data = [
                'base_url' => \url('/uploads'),
                'directory' => $DirectoryPath,
                'uploaded_file' => $UploadedFile,
            ];

            return $this->sendResponse(false, 200, $data, 'Successfully Uploaded.');
        } else {
            return $this->sendResponse(true, 233, null, 'Operation Failed, Contact System administrator.');
        }
    }

    public function CreateStory(Request $request)
    {
        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [
            'session_user_id' => 'required',
            'description' => 'required',
            'url' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------

        $session_user_id = $request->session_user_id;
        $description = $request->description;
        $url = $request->url;

        $published_at = \Carbon\Carbon::now()->toDateTimeString();
        $expires_at = \Carbon\Carbon::now()->addDays(1)->toDateTimeString();

        // -------------------------Get Story Data----------------------------------

        $storyData = DB::table('stories')->where('created_by_user_id', $session_user_id)->first();

        // ------------------------/Get Story Data----------------------------------

        // ------------------------Insert if not found else update----------------------------------
        if (count((array) $storyData) == 0) {
            $story_id = DB::table('stories')->insertGetId(
                [
                    'description' => $description,
                    'thumbnail' => $url,

                    'published_at' => $published_at,
                    'expires_at' => $expires_at,

                    'status' => 'Active',
                    'created_by_user_id' => $session_user_id,
                ],
                'id',
            );
        } else {
            $story_id = $storyData->id;

            if ($story_id != null) {
                $query = DB::table('stories')
                    ->where('id', $story_id)
                    ->update([
                        'description' => $description,
                        'thumbnail' => $url,

                        'published_at' => $published_at,
                        'expires_at' => $expires_at,

                        'created_at' => date('Y-m-d H:i:s', strtotime('now')),
                        'updated_by_user_id' => $session_user_id,
                    ]);
            } else {
                return $this->sendResponse(true, 233, null, 'Story ID not found, Contact system administrator');
            }
        }

        //Always instert in every scenario

        $story_item_id = DB::table('story_items')->insertGetId(
            [
                'story_id' => $story_id,

                'description' => $description,
                'url' => $url,

                'published_at' => $published_at,
                'expires_at' => $expires_at,

                'no_of_visitors' => 0,
                'no_of_likes' => 0,
                'no_of_comments' => 0,
                'no_of_share' => 0,

                'status' => 'Active',
                'created_by_user_id' => $session_user_id,
            ],
            'id',
        );

        $Stories = $this->GeneralStories($request, $session_user_id, null, null, null);

        $data = [
            'base_url' => \url('/uploads'),
            'Stories' => $Stories,
        ];

        if (true) {
            return $this->sendResponse(false, 200, $data, 'Story has been created successfully.');
        } else {
            return $this->sendResponse(true, 233, null, 'Story has been failed.');
        }

        //-------------------------------------------------------------------------
    }

    public function SendMessage(Request $request)
    {
        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [
            'session_user_id' => 'required',
            'receiver_user_id' => 'required',
            'text' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------

        $session_user_id = $request->session_user_id;
        $receiver_user_id = $request->receiver_user_id;
        $text = $request->text;
        $type = 'OneToOne';

        if ($session_user_id == $receiver_user_id) {
            return $this->sendResponse(true, 433, null, 'You can not send to yourself');
        }

        //-------------------------------------Message-----------------------------------------------

        //--------------------------For Single Message----------------------------------
        if ($type == 'OneToOne') {
            //-----------------Check and Sent message before or not-------------------------

            $messagesUsersData = DB::table('message_users')
                ->orWhere(function ($query) use ($session_user_id, $receiver_user_id) {
                    $query->where('user_id', $receiver_user_id)->where('created_by_user_id', $session_user_id)->where('type', 'OneToOne');
                })
                ->orWhere(function ($query) use ($session_user_id, $receiver_user_id) {
                    $query->where('user_id', $session_user_id)->where('created_by_user_id', $receiver_user_id)->where('type', 'OneToOne');
                })
                ->first();
            //-----------------Check and Sent message before or not-------------------------

            //---------------------Get Message ID or Create if not created before----------------------------
            if (isset($messagesUsersData) == true) {
                $message_id = $messagesUsersData->message_id;
            } else {
                //---------------------For First Time message---------------------

                $message_id = DB::table('messages')->insertGetId(
                    [
                        'read_status' => 'Unread',
                        //                        'last_conversation_date' => $CurrentDateTime,
                        'type' => 'OneToOne',

                        'status' => 'Active',
                        'order_by' => null,
                        //                        'created_by_comp_id' => $session_comp_id,
                        'created_by_user_id' => $session_user_id,
                        //                        'created_at' => $CurrentDateTime
                    ],
                    'id',
                );

                //Enter Own-self
                $query = DB::table('message_users')->insert([
                    'message_id' => $message_id,
                    'user_id' => $session_user_id,
                    'type' => 'OneToOne',
                    'status' => 'Active',
                    //                        'created_by_comp_id' => $session_comp_id,
                    'created_by_user_id' => $session_user_id,
                    //                        'created_at' => $CurrentDateTime,
                ]);

                //Enter receiver user
                $query = DB::table('message_users')->insert([
                    'message_id' => $message_id,
                    'user_id' => $receiver_user_id,
                    'type' => 'OneToOne',
                    'status' => 'Active',
                    //                        'created_by_comp_id' => $session_comp_id,
                    'created_by_user_id' => $session_user_id,
                    //                        'created_at' => $CurrentDateTime,
                ]);

                //--------------------/For First Time message---------------------
            }
            //--------------------/Get Message ID or Create if not created before----------------------------
        }
        //-------------------------/For Single Message----------------------------------

        //--------------------------For Group Message----------------------------------
        if ($type == 'Group') {
            // Do Nothing because message ID is passing
        }
        //-------------------------/For Group Message----------------------------------

        //----------------------------------------------------------------------------------------
        $message_conversation_id = DB::table('message_conversations')->insertGetId(
            [
                //                'reply_to_id' => $reply_to_id,
                'message_id' => $message_id,
                //                'reference_id' => $reference_id,
                //                'reference_type' => $reference_type,

                'text' => $text,
                //                'latitude_longitude' => $latitude_longitude,
                //                'thumbnail' => $thumbnail,
                //                'url' => $url,
                //                'number' => $number,
                'type' => 'Text',
                'read_status' => 'Unread',

                'status' => 'Active',
                'order_by' => null,
                //                'created_by_comp_id' => $session_comp_id,
                'created_by_user_id' => $session_user_id,
                //                'created_at' => $CurrentDateTime
            ],
            'id',
        );
        //----------------------------------------------------------------------------------------

        $mergeData = [];
        $MessageConversationsSqlData = [];
        $MessageUsersSqlData = [];

        $MessagesSqlData = $this->GetMessagesSqlData($request, null, null, null, null, null, null, null, null, null, null, null, null, null, $session_user_id, null, null, null);

        foreach ($MessagesSqlData as $key => $MessagesSqlDataTemp) {
            $ConversationsData = null;

            $MessageConversationsSqlData = $this->GetMessageConversationsSqlData($request, null, $MessagesSqlDataTemp->id, null, null, null, null, null, null, null, null, null, null, null, null, null, 1);

            $MessageUsersSqlData = $this->GetMessageUsersSqlData($request, null, $MessagesSqlDataTemp->id, null, null, null, null, null, null, null, null, null, null, null, null, null, 1);

            $messagesData = [
                'conversations' => $MessageConversationsSqlData,
                'users' => $MessageUsersSqlData,
            ];

            $mergeData[$key] = (object) array_merge((array) $MessagesSqlDataTemp, $messagesData);
        }

        $Messages = [
            'current_page' => $MessagesSqlData->currentPage(),
            'data' => $mergeData,
            'from' => $MessagesSqlData->firstItem(),
            'last_page' => $MessagesSqlData->lastPage(),
            'next_page_url' => $MessagesSqlData->nextPageUrl(),
            'path' => $MessagesSqlData->nextPageUrl(),
            'per_page' => $MessagesSqlData->perPage(),
            'prev_page_url' => $MessagesSqlData->previousPageUrl(),
            'to' => $MessagesSqlData->lastItem(),
            'total' => $MessagesSqlData->total(),
        ];

        $Messages = $this->GeneralMessages($request, $session_user_id, null, null, null);

        $data = [
            'base_url' => \url('/uploads'),
            'Messages' => $Messages,
            'Conversations' => $MessageConversationsSqlData,
            'Users' => $MessageUsersSqlData,
        ];

        //------------------------------------/Message-----------------------------------------------

        if (true) {
            return $this->sendResponse(false, 200, $data, 'Message has been sent successfully.');
        } else {
            return $this->sendResponse(true, 233, null, 'Message sending failed.');
        }

        //-------------------------------------------------------------------------
    }

    public function GeneralStories($request, $session_user_id, $no_of_records, $page_no, $record_type)
    {
        //---------------Stories--------------

        $StoriesTempArray = [];
        $StoriesSqlData = $this->GetStoriesSqlData($request, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, $session_user_id, null, null, null, null, 15);

        foreach ($StoriesSqlData as $ikey => $StoriesTemp) {
            $StoryItemsSqlData = $this->GetStoryItemsSqlData($request, null, $StoriesTemp->id, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

            $DataTemp = [
                'Items' => $StoryItemsSqlData,
            ];

            $StoriesTempArray[$ikey] = (object) array_merge((array) $StoriesTemp, $DataTemp);
        }

        $OwnStoryItemsSqlData = $this->GetStoryItemsSqlData($request, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, $session_user_id, null);

        $Stories = [
            'current_page' => $StoriesSqlData->currentPage(),
            'own_stories' => $OwnStoryItemsSqlData,
            'data' => $StoriesTempArray,
            'from' => $StoriesSqlData->firstItem(),
            'last_page' => $StoriesSqlData->lastPage(),
            'next_page_url' => $StoriesSqlData->nextPageUrl(),
            'path' => $StoriesSqlData->nextPageUrl(),
            'per_page' => $StoriesSqlData->perPage(),
            'prev_page_url' => $StoriesSqlData->previousPageUrl(),
            'to' => $StoriesSqlData->lastItem(),
            'total' => $StoriesSqlData->total(),
        ];

        //--------------/Stories--------------

        return $Stories;
    }

    public function GeneralNewsfeed($request, $session_user_id, $no_of_records, $page_no, $record_type)
    {
        $is_like = false;
        $is_comment = false;
        $is_save = false;
        $is_share = false;
        $is_repost = false;

        $NewsFeedsSqlData = $this->GetNewsFeedsSqlData($request, null, null, null, null, null, null, null, null, null, null, null, null, null);

        $NewsFeeds = [];
        $NewsFeedsTemp = [];

        foreach ($NewsFeedsSqlData as $key => $NewsFeedsSqlDataTemp) {
            $Likes = $this->GetLikesSqlData($request, null, $NewsFeedsSqlDataTemp->id, 'newsfeed', null, null, null, null, null, null, null, null, null, null, null, 15, 1);
            $Comments = $this->GetCommentsSqlData($request, null, $NewsFeedsSqlDataTemp->id, 'newsfeed', null, null, null, null, null, null, null, null, null, null, null, null, 15, 1);
            $Saves = $this->GetSavesSqlData($request, null, $NewsFeedsSqlDataTemp->id, 'newsfeed', null, null, null, null, null, null, null, null, null, null, 15, 1);

            if ($session_user_id != null) {
                $LikeProcessData = $this->GetLikesSqlData($request, null, $NewsFeedsSqlDataTemp->id, 'newsfeed', null, null, null, null, null, null, null, null, null, null, $session_user_id, 15, 1);

                if (count($LikeProcessData) > 0) {
                    $is_like = true;
                } else {
                    $is_like = false;
                }

                $CommentProcessData = $this->GetCommentsSqlData($request, null, $NewsFeedsSqlDataTemp->id, 'newsfeed', null, null, null, null, null, null, null, null, null, null, null, $session_user_id, 15, 1);

                if (count($CommentProcessData) > 0) {
                    $is_comment = true;
                } else {
                    $is_comment = false;
                }

                $SaveProcessData = $this->GetSavesSqlData($request, null, $NewsFeedsSqlDataTemp->id, 'newsfeed', null, null, null, null, null, null, null, null, null, $session_user_id, 15, 1);

                if (count($SaveProcessData) > 0) {
                    $is_save = true;
                } else {
                    $is_save = false;
                }
            } else {
                $is_like = false;
                $is_comment = false;
                $is_save = false;
                $is_share = false;
                $is_repost = false;
            }

            $NewsFeeds = [
                'is_like' => $is_like,
                'is_comment' => $is_comment,
                'is_save' => $is_save,
                'is_share' => $is_share,
                'is_repost' => $is_repost,

                'Likes' => $Likes,
                'Comments' => $Comments,
                'Saves' => $Saves,
            ];

            $NewsFeedsTemp[$key] = (object) array_merge((array) $NewsFeedsSqlDataTemp, $NewsFeeds);
        }

        $Newsfeeds = [
            'current_page' => $NewsFeedsSqlData->currentPage(),
            'data' => $NewsFeedsTemp,
            'from' => $NewsFeedsSqlData->firstItem(),
            'last_page' => $NewsFeedsSqlData->lastPage(),
            'next_page_url' => $NewsFeedsSqlData->nextPageUrl(),
            'path' => $NewsFeedsSqlData->nextPageUrl(),
            'per_page' => $NewsFeedsSqlData->perPage(),
            'prev_page_url' => $NewsFeedsSqlData->previousPageUrl(),
            'to' => $NewsFeedsSqlData->lastItem(),
            'total' => $NewsFeedsSqlData->total(),
        ];

        return $Newsfeeds;

        // $id=null;
        // if(count($Newsfeeds)==1 && $id!=null){
        // }else{
        // }
    }

    public function GeneralMessages($request, $session_user_id, $no_of_records, $page_no, $record_type)
    {
        $mergeData = [];
        $ConversationsData = [];
        $MessageUsersSqlData = [];

        $MessagesSqlData = $this->GetMessagesSqlData($request, null, null, null, null, null, null, null, null, null, null, null, null, null, $session_user_id, null, null, null);

        foreach ($MessagesSqlData as $key => $MessagesSqlDataTemp) {
            $ConversationsData = null;

            $MessageConversationsSqlData = $this->GetMessageConversationsSqlData($request, null, $MessagesSqlDataTemp->id, null, null, null, null, null, null, null, null, null, null, null, null, null, 1);

            $MessageUsersSqlData = $this->GetMessageUsersSqlData($request, null, $MessagesSqlDataTemp->id, null, null, null, null, null, null, null, null, null, null, null, null, null, 1);

            $messagesData = [
                'conversations' => $MessageConversationsSqlData,
                'users' => $MessageUsersSqlData,
            ];

            $mergeData[$key] = (object) array_merge((array) $MessagesSqlDataTemp, $messagesData);
        }

        $Messages = [
            'current_page' => $MessagesSqlData->currentPage(),
            'data' => $mergeData,
            'from' => $MessagesSqlData->firstItem(),
            'last_page' => $MessagesSqlData->lastPage(),
            'next_page_url' => $MessagesSqlData->nextPageUrl(),
            'path' => $MessagesSqlData->nextPageUrl(),
            'per_page' => $MessagesSqlData->perPage(),
            'prev_page_url' => $MessagesSqlData->previousPageUrl(),
            'to' => $MessagesSqlData->lastItem(),
            'total' => $MessagesSqlData->total(),
        ];

        return $Messages;
    }

    public function newfollow(Request $request)
    {
        //---------------------------Validation-------------------------------------
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendResponse(true, 312, null, 'Validation error, recheck all fields.');
        }
        //---------------------------Validation-------------------------------------

        $timezone = 'Asia/Dhaka';
        date_default_timezone_set($timezone);

        $is_session = $this->GetSession();

        if ($is_session) {
            $session_user_id = $request->session()->get('project')->id;
            $User = $this->GetUsersSqlData($request, $session_user_id, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        } else {
            $User = null;
        }

        $inc = 0;
        $id = $request['id'];

        // ----------Check already followed or Not-----------------

        if ($session_user_id == $id) {
            $data[] = [
                'error' => 'true',
                'code' => '4545',
                'message' => 'You can not follow yourself',
            ];
            $jsonData = json_encode($data, JSON_UNESCAPED_SLASHES); // Remove backward slashes from URL and encode
            return $jsonData;
        }

        // ----------Check already followed or Not-----------------

        // ----------Check already followed or Not-----------------
        $followingData = DB::table('followers')->where('followed_to_id', $id)->where('created_by_user_id', $session_user_id)->first();

        if (!is_null($followingData)) {
            $data[] = [
                'error' => 'true',
                'code' => '4545',
                'message' => 'Already Followed.',
            ];
            $jsonData = json_encode($data, JSON_UNESCAPED_SLASHES); // Remove backward slashes from URL and encode
            return $jsonData;
        }
        // ----------Check already followed or Not-----------------

        if ($inc == 0) {
            $follower_id = DB::table('followers')->insertGetId(
                [
                    'followed_to_id' => $id,
                    'followed_type' => 'UserToUser',
                    'action_status' => null,

                    'status' => 'Active',
                    'order_by' => null,
                    'created_by_user_id' => $session_user_id,
                ],
                'id',
            );

            //-----------------Update and Decrement for Own----------------------

            $OwnUser = DB::table('users')->select('users.id as id', 'users.no_of_followings as no_of_followings')->where('users.id', $session_user_id)->first();

            $IncUser = DB::table('users')
                ->where('id', $session_user_id)
                ->update([
                    'no_of_followings' => $OwnUser->no_of_followings + 1,
                ]);

            //-----------------Update and Decrement for Own----------------------

            //-----------------Update and Decrement for Friend----------------------

            $FriendUser = DB::table('users')->select('users.id as id', 'users.no_of_followers as no_of_followers')->where('users.id', $id)->first();

            $IncUser = DB::table('users')
                ->where('id', $id)
                ->update([
                    'no_of_followers' => $FriendUser->no_of_followers + 1,
                ]);

            //-----------------Update and Increment for Friend----------------------

            if ($IncUser) {
                $data[] = [
                    'error' => 'false',
                    'code' => '200',
                    'message' => 'Successfully Followed',
                ];
                $jsonData = json_encode($data, JSON_UNESCAPED_SLASHES); // Remove backward slashes from URL and encode
                return $jsonData;
            } else {
                $data[] = [
                    'error' => 'true',
                    'code' => '0',
                    'message' => 'Query Failed, Contact System administrator.',
                ];

                $jsonData = json_encode($data, JSON_UNESCAPED_SLASHES); // Remove backward slashes from URL and encode
                return $jsonData;
            }
        } else {
            $data[] = [
                'error' => 'true',
                'code' => '0',
                'message' => 'Operation Failed, Contact System administrator.',
            ];

            $jsonData = json_encode($data, JSON_UNESCAPED_SLASHES); // Remove backward slashes from URL and encode
            return $jsonData;
        }
    }

    //    ------------------------------------------/User follow--------------------------------------------------------
}

?>
