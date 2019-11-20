<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Redirect;
use App\Profile;
use Activation;
use DB;
use App\Pending;
use App\Accepted;
use App\Rejected;
use App\Leaveinfo;
use App\Designation;
use App\User;


class AdminController extends Controller
{
    public function dashboard()
    {

        $id=Sentinel::getUser()->id;
        $user=Leaveinfo::where('user_id',$id)->first();
        return view('admin.index',compact('user'));
    }

    public function getLogout()
    {
        Sentinel::logout();
        // Redirect to the users page
        return Redirect::to('/')->with('success', 'You have successfully logged out!');
    }

    public function userProfile()
    {
        $users = Profile::select('id', 'userName', 'class', 'image', 'created_at')->get();
        return view('pages.user_profile', compact('users'));
    }

    public function createUser()
    {
        $info=Designation::all();
        return view('pages.create_user',compact('info'));
    }

    public function showArchive($id)
    {
        $id = str_replace("user_", "", $id);
        $r = Rejected::where('user_id', '=', $id)->get();
        $a = Accepted::where('user_id', '=', $id)->get();
        $n = Pending::where('user_id', '=', $id)->get();
        //dd($r);
        $i = 0;
        $j = 0;
        $multi_data = array();
        foreach ($r as $val) {
            $multi_data[$i] = $val;
            $i++;
        }
        foreach ($a as $val) {
            $multi_data[$i] = $val;
            $i++;
        }
        foreach ($n as $val) {
            $multi_data[$i] = $val;
            $i++;
        }

        $time = array();
        foreach ($multi_data as $key => $value) {
            $time[$key] = $value['created_at'];
        }

        array_multisort($time, SORT_DESC, $multi_data);

        $user = Profile::where('id', '=', $id)->first();

        return view('pages.leave_archive', compact('multi_data', 'user'));

    }

    public function delete(Request $request){
        $user=Sentinel::findById($request->id);
        $user->delete();
        return response()->json('done');
    }

    public function addDesignation(Request $request){
        $des=new Designation();
        $des->designation=$request->des;
        $des->save();
        return response()->json('done');
    }

}
