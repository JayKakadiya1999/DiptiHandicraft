<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Users;

class changepwdcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    public function changepwd(Request $request)
    {

        $activeuser = session()->get('activeuser');
        $data = DB::table('user')
            ->where('User_id','=',$activeuser)
            ->get();
        return view('changepwd',['data' => $data]);
    }


    public function changepwdform(Request $request)
    {
        $answer = Input::get('answer');
        $pwd = Input::get('pwd');
        $newpwd = Input::get('newpwd');
        $confirmpwd = Input::get('confirmpwd');
        $activeuser = session()->get('activeuser');
        $pass = DB::table('user')->where('password',$pwd)->value('password');
        $ans = DB::table('user')->where('User_id','=',$activeuser)->value('Seq_ans');
        if($answer == $ans)
        {
            if ($pass == $pwd) 
            {
                DB::table('user')
                        ->where('User_id','=',$activeuser)
                        ->update(['Password'=>Input::get('newpwd')]);
            }
            else
            {
                return redirect('changepwd')->with('danger','Your Old Password Is Incorrect');
            }
        }
        else
        {
            return redirect('changepwd')->with('danger','Your Answer Is Not Match');
        }
        return redirect('login')->with('success','Password Changed Successfully.');
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
                    session()->put('activeuser',$activeuser);
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
