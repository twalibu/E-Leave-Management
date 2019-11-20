<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Sentinel;
use App\Leaveinfo;
use Reminder;
use Validator;
use URL;
use App\User;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Database\QueryException;
use Mail;


class LoginController extends Controller
{

    public function forgotPassword()
    {
        return view('forgot-password');
    }

    public function getLogin()
    {
        if (Sentinel::check())
            return redirect('/home');

        return view('login');
    }

    public function login(Request $request)
    {

        $remember_me = false;

        if (isset($request->remember_me)) {
            $remember_me = true;
        }
        try {

            if (Sentinel::authenticate($request->all(), $remember_me)) {

                $id = Sentinel::getUser()->id;
                $leave = Leaveinfo::where('user_id', '=', $id)->first();
                if ($leave == null) {
                    $info = new Leaveinfo();
                    $info->user_id = $id;
                    $info->save();
                }

                return redirect('/home');

            } else {
                // Ooops.. something went wrong
                return redirect()->back()->with(['error' => 'Wrong Email or Password.']);
            }
        } catch (NotActivatedException $e) {
            return redirect()->back()->with(['error' => 'your account is not activated.']);
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            return redirect()->back()->with(['error' => 'you have been denied access for another ' . $delay . ' second(s).']);
        }


    }

    public function getPassword(Request $request)
    {

        $user = User::whereEmail($request->email)->first();

        if (!$user) {
            return redirect()->back()->with([
                'error' => 'email does not exist'
            ]);
        }


        $sentinelUser = Sentinel::findById($user->id);


        $reminder = Reminder::exists($sentinelUser) ?: Reminder::create($sentinelUser);
        $this->sendMail($user, $reminder->code);

        return redirect()->back()->with([
            'success' => 'reset code was sent to your email.'
        ]);


    }

    private function sendMail($user, $code)
    {

        Mail::send('emails.forgot-password', [
            'user' => $user,
            'code' => $code
        ], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject("Hello $user->userName , reset your password.");
        });
    }

    public function resetPassword($email, $resetCode)
    {

        $user = User::whereEmail($email)->first();

        $sentinelUser = Sentinel::findById($user->id);

        if (!$user) {
            abort(404);
        }

        if ($reminder = Reminder::exists($sentinelUser)) {

            if ($resetCode = $reminder->code) {
                return view('reset');
            } else {

            }

        } else {

        }

        return view('reset');


    }

    public function postPassword(Request $request, $email, $resetCode)
    {

        $this->validate($request, [
            'password' => 'confirmed|required|min:6',
            'password_confirmation' => 'required|min:6'
        ]);
        $user = User::whereEmail($email)->first();

        $sentinelUser = Sentinel::findById($user->id);

        if (count($user) == 0) {
            abort(404);
        }

        if ($reminder = Reminder::exists($sentinelUser)) {

            if ($resetCode = $reminder->code) {
                Reminder::complete($sentinelUser, $resetCode, $request->password);

                return redirect('/')->with('success', 'please login with your new password');

            } else {

            }

        } else {

        }
    }
}
