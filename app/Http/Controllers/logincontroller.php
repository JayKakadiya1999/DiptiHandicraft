<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Users;

class logincontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    public function logout(Request $request)
    {
        session()->forget('activeuser');
        return redirect('login');
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
        /*---------login for customer & admin--------*/
        $useremail = Input::get('email');
        $userpass = Input::get('password');
        $emails = DB::table('user')->lists('Email');
        $totaluser = Users::max('User_id');
        for($i=0; $i< $totaluser; $i++)
        {
            $email= $emails [$i];
            if($email == $useremail)
            {
                $pass = DB::table('user')->where('Email',$useremail)->value('password');
                if($userpass == $pass)
                {
                    $activeuser = DB::table('user')->where('Email',$useremail)->value('user_id');

                    session()->put('activeuser',$activeuser);      //put activeuser id in session
                    
                    $usertype = DB::table('user')->where('Email',$useremail)->value('user_type_id');
                    if($usertype == 1)
                    {
                        return redirect('home');
                    }
                    else
                    {
                        return redirect('dashboard');
                    }

                }
                else
                {
                    return redirect('login')->with('danger','Inavlid Email Or Password');
                }
            }
        }
        return redirect('login')->with('danger','Inavlid Email Or Password');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
