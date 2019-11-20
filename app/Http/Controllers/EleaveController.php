<?php
namespace App\Http\Controllers;

use Activation;
use App\Notification;
use Sentinel;
use Illuminate\Http\Request;
use DB;
use App\Profile;
use App\Pending;
use App\Accepted;
use App\Rejected;
use App\Designation;
use App\Leaveinfo;
use App\User;
use Illuminate\Database\QueryException;
use Validator;
use Redirect;
use Image;
use Mail;

class EleaveController extends Controller
{
    public function applyLeave()
    {

        $id = Sentinel::getUser()->id;
        $info = Leaveinfo::where('user_id', '=', $id)->first();

        $name = DB::table('roles')
            ->join('role_users', 'roles.id', '=', 'role_users.role_id')
            ->join('users', 'users.id', '=', 'role_users.user_id')
            ->select('users.fullName')
            ->where('roles.name', '=', 'Authority')
            ->get();

        return view('pages.apply_leave', compact('name', 'info'));
    }

    public function profile(Request $request)
    {

        $user = Sentinel::findById($request->prf);

        $leave = Leaveinfo::where('user_id', '=', $request->prf)->first();
        $designation=Designation::all();

            return view('pages.profile', compact('user', 'leave','designation'));
    }

    public function senddata(Request $request)
    {

        $s = ($request->start);
        $e = ($request->end);
        $ap = ($request->app_date);
        $t = ($request->t_day);

        $pending = new Pending();
        $notification = new Notification();

        $notification->user_id = Sentinel::getUser()->id;
        $notification->name = Sentinel::getUser()->fullName;
        $notification->image = Sentinel::getUser()->image;
        $notification->status = 'pending';

        $pending->user_id = Sentinel::getUser()->id;
        $pending->name = Sentinel::getUser()->fullName;
        $pending->send_to = $request->authority;
        $pending->start_date = $request->start;
        $pending->type=$request->app_type;
        $pending->end_date = $request->end;
        $pending->app_date = $request->app_date;
        $pending->total_day = $request->diff;
        $pending->reason = $request->reason;

        $pending->save();
        $notification->save();


        $info = Leaveinfo::where('user_id', '=', Sentinel::getUser()->id)->first();

        $no_app = ($info->no_app) + 1;
        $pend = ($info->pending_leave) + 1;


        $aaa = Leaveinfo::where('user_id', '=', Sentinel::getUser()->id)->update(
            array(
                "no_app" => $no_app,
                "pending_leave" => $pend,
            )
        );

        return response()->json('done');

    }

    public function requestLeave($name)
    {

        $id = Sentinel::getUser()->id;

        if ($name == 'pending-application') {
            $data = Pending::where('user_id', '=', $id)->get();
            $flag = 0;
        } else if ($name == 'accepted-application') {
            $data = Accepted::where('user_id', '=', $id)->get();
            $flag = 1;
        } else {
            $flag = 2;
            $data = Rejected::where('user_id', '=', $id)->get();
        }


        return view('pages.leave_request', compact('data', 'flag'));
    }

    public function userApplication()
    {
        $data = Pending::all();
        return view('pages.user_application', compact('data'));
    }

    public function notifyData(Request $request)
    {

        $info = DB::table('users')
            ->join('leaveinfo', 'leaveinfo.user_id', '=', 'users.id')
            ->join('pending', 'pending.user_id', '=', 'leaveinfo.user_id')
            ->where('pending.id', '=', $request->id)
            ->first();
        return response()->json($info);
    }

    public function acceptApp(Request $request)
    {

        $data = Pending::where('id', '=', $request->id)->first();

        $userid = $data->user_id;

        $accept = new Accepted();
        $accept->user_id = $data->user_id;
        $accept->name = $data->name;
        $accept->type = $data->type;
        $accept->approved_by = $data->send_to;
        $accept->start_date = $data->start_date;
        $accept->end_date = $data->end_date;
        $accept->app_date = $data->app_date;
        $accept->total_day = $data->total_day;
        $accept->reason = $data->reason;

        $accept->save();

        $total = ($data->total_day);
        $day = $total;


        $data = Pending::where('id', '=', $request->id)->delete();
        DB::table('notification')->where('id', '=', $request->id)->update(['status' => 'accepted']);

        $info = Leaveinfo::where('user_id', '=', $userid)->first();
        $pend = ($info->pending_leave) - 1;
        $acpt = ($info->accepted_leave) + 1;

        $remain = $info->remaining_leave;
        $calculation_day = $remain - $day;
        if ($calculation_day < 0) {
            $pos = abs($calculation_day);
            $emer = ($info->emergency_leave) + $pos;

            $data = Leaveinfo::where('user_id', '=', $userid)->update(array(

                "pending_leave" => $pend,
                "emergency_leave" => $emer,
                "accepted_leave" => $acpt,
                "remaining_leave" => 0,
            ));

        } else {
            $remain = ($info->remaining_leave) - $day;

            $data = Leaveinfo::where('user_id', '=', $userid)->update(array(
                "pending_leave" => $pend,
                "remaining_leave" => $remain,
                "accepted_leave" => $acpt,
            ));
        }


        return response()->json('done');


    }

    public function rejectApp(Request $request)
    {
        $data = Pending::where('id', '=', $request->id)->first();
        $userid = $data->user_id;

        $reject = new Rejected();
        $reject->user_id = $data->user_id;
        $reject->name = $data->name;
        $reject->type = $data->type;
        $reject->rejected_by = $data->send_to;
        $reject->start_date = $data->start_date;
        $reject->end_date = $data->end_date;
        $reject->app_date = $data->app_date;
        $reject->total_day = $data->total_day;
        $reject->reason = $data->reason;

        $reject->save();

        $data = Pending::where('id', '=', $request->id)->delete();
        DB::table('notification')->where('id', '=', $request->id)->update(['status' => 'rejected']);


        $info = Leaveinfo::where('user_id', '=', $userid)->first();
        $pend = ($info->pending_leave) - 1;
        $rect = ($info->rejected_leave) + 1;

        $data = Leaveinfo::where('user_id', '=', $userid)->update(array(
            "pending_leave" => $pend,
            "rejected_leave" => $rect,
        ));


        return response()->json($data);

    }

    public function fetchData(Request $request)
    {

        $id = $request->id;
        $tab = $request->tab;




        if ($tab == 'Pending') {
            $info = DB::table('users')
                ->join('pending', 'pending.user_id', '=', 'users.id')
                ->where('pending.id', '=', $id)
                ->first();
        } else if ($tab == 'Rejected') {
            $info = DB::table('users')
                ->join('rejected', 'rejected.user_id', '=', 'users.id')
                ->where('rejected.id', '=', $id)
                ->first();
        } else if ($tab == 'Accepted') {
            $info = DB::table('users')
                ->join('accepted', 'accepted.user_id', '=', 'users.id')
                ->where('accepted.id', '=', $id)
                ->first();
        }

        return response()->json($info);
    }

    public function registration(Request $request)
    {

        try {
            $user = Sentinel::register($request->all());
            $activation = Activation::create($user);
            $data=Array($user,$activation);

            if ($request->user == 'Authority') {
                $role = Sentinel::findRoleBySlug('authority');
            } else if ($request->user == 'Admin') {
                $role = Sentinel::findRoleBySlug('admin');
            } else
                $role = Sentinel::findRoleBySlug('user');

            $role->users()->attach($user);

            $info = User::where('email', '=', $request->email)->first();
            $id = $info->id;


            $data = new Leaveinfo();
            $data->allow_leave = $request->leave;
            $data->user_id = $id;
            $data->remaining_leave = $request->leave;
            $data->save();

            return response()->json($user);
        } catch (QueryException $e) {
            return response()->json('fail');
        }catch(\Exception $e){
            $del=Sentinel::findById($id);
            $del->delete();
            return response()->json('not send');
        }

    }

    public function clearNotification(Request $request)
    {

        if ($request->txt == 'pending') {
            return response()->json('pending');
        } else if ($request->txt == 'accepted') {
            $acpt = Notification::find($request->id)->delete();
            return response()->json('accepted');
        } else {
            $rjct = Notification::find($request->id)->delete();
            return response()->json('rejected');
        }


    }

    public function updateInfo(Request $request)
    {


        try {
            $id = $request->id;

            $user = Sentinel::findById($id);


            $credentials = [
                'fullName'=>$request->fullName,
                'class'=>$request->designation,
                'date_of_birth'=>$request->dob,
                'gender'=>$request->gender,
                'address'=>$request->address,
                'email' => $request->email,
                'userName' => $request->username,
                'phoneNo' => $request->phone,
            ];

            $member = Sentinel::findById($id)->roles()->get();
            foreach ($member as $use) {
                $role1 = $use->name;
            }
            $user1 = Sentinel::findById($id);

            $user = Sentinel::update($user, $credentials);




            $role = Sentinel::findRoleByName($role1);
            $role->users()->detach($user1);

            $role2 = Sentinel::findRoleByName($request->role);
            $role2->users()->attach($user1);



            return response()->json('done');

        } catch (QueryException $e) {
            $user = Sentinel::findById($id);
            $array=array();
            $array[0]=$user1;
            $array[1]=$role1;
            $array1=json_encode($array);
            return response()->json($array1);
        }


    }

    public function updatePassword(Request $request)
    {
        $current_pass = $request->current_password;
        $new_password = $request->new_password;

        $id = Sentinel::getUser()->id;
        $user = Sentinel::findById($id);

        $credentials = [
            'email' => $user->email,
            'password' => $current_pass,
        ];

        $result = Sentinel::validateCredentials($user, $credentials);

        if ($result) {
            $credentials = [
                'email' => $user->email,
                'password' => $new_password,
            ];
            $user = Sentinel::update($user, $credentials);
            return response()->json('success');

        } else
            return response()->json('fail');

    }

    public function profilePic(Request $request)
    {
        if ($request->hasFile('avatar')) {

            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $path = 'images/' . $filename;
            Image::make($avatar)->resize(128, 128)->save($path);

            $user = new Profile();
            $user->avatar = $filename;
            $id = Sentinel::getUser()->id;
            $del = Sentinel::findById($id);

            if ($del->image != 'avatar.jpg') {
                unlink('images/' . $del->image);
            }

            $credentials = [
                'image' => $filename,
            ];

            $user = Sentinel::update($del, $credentials);

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function getActivate($email, $activationCode)
    {

        $user = User::whereEmail($email)->first();
        $sentinelUser = Sentinel::findById($user->id);

        if (Activation::complete($sentinelUser, $activationCode)) {
            return redirect('/');
        } else {
            return redirect('/')->with(['error' => 'Something goes wrong.']);
        }
    }

    public function setting()
    {
        $des=Designation::all();
        return view('pages.setting',compact('des'));
    }

    public function smtpShow(){
        $env = file_get_contents(base_path() . '/.env');

        // Split string on every " " and write into array
        $env = preg_split('/\s+/', $env);
        $data[0]=substr($env[18],12);
        $data[1]=substr($env[19],10);
        $data[2]=substr($env[20],10);
        $data[3]=substr($env[21],14);
        $data[4]=substr($env[22],14);
        $data[5]=substr($env[23],16);

        return response()->json($data);

    }

    protected function changeEnv($data = array()){
        if(count($data) > 0){

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/\s+/', $env);;

            // Loop through given data
            foreach((array)$data as $key => $value){

                // Loop through .env-data
                foreach($env as $env_key => $env_value){

                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if($entry[0] == $key){
                        // If yes, overwrite it with the new one
                        $env[$env_key] = $key . "=" . $value;
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $env = implode("\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);

            return true;
        } else {
            return false;
        }
    }

    public function smtpUpdate(Request $request){

        $env_update = $this->changeEnv([
            'MAIL_DRIVER'=>$request->driver,
            'MAIL_HOST'=>$request->host,
            'MAIL_PORT'=>$request->port,
            'MAIL_USERNAME'=>$request->username,
            'MAIL_PASSWORD'=>$request->password,
            'MAIL_ENCRYPTION'=>$request->enc,
        ]);

        if($env_update){
            return response()->json('done');
        } else {
            return response()->json('fail');
        }

    }

    public function smtpReset(){

        $env_update = $this->changeEnv([
            'MAIL_DRIVER'=>'smtp',
            'MAIL_HOST'=>'mailtrap.io',
            'MAIL_PORT'=>'2525',
            'MAIL_USERNAME'=>'null',
            'MAIL_PASSWORD'=>'null',
        ]);

        if($env_update){
            return response()->json('done');
        } else {
            return response()->json('fail');
        }

    }

    public function settingEdit(Request $request){
        if($request->checkbox=='true'){
            DB::table('accepted')->delete();
            DB::table('rejected')->delete();
        }
        DB::table('notification')->delete();
        DB::table('pending')->delete();
        DB::table('leaveinfo')->update(array('allow_leave' => $request->day,'no_app'=>0,'remaining_leave'=>$request->day,'accepted_leave'=>0,'rejected_leave'=>0,'pending_leave'=>0,'emergency_leave'=>0));
        return response()->json('done');
    }

    public function leaveReport(Request $request){
        $start=$request->start;
        $end=$request->end;



    }
    public function deleteDes(Request $request){
        $data = Designation::where('id', '=', $request->id)->delete();
        return response()->json('done');
    }

    public function editDes(Request $request){
        $data = Designation::where('id', '=', $request->id)->update(array(
            "designation" => $request->des,
        ));

        return response()->json('done');
    }
}
