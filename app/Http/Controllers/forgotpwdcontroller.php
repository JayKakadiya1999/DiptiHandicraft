<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Users;
use Mail;

class forgotpwdcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('forgotpwd');
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
        
    }

    public function forgotpwdform(Request $request)
    {
        //website, port  (try 80 or 443)

            $useremail = DB::table('user')->lists('Email');
            foreach($useremail as $row)
            {
                if($row == Input::get('email'))
                {
                    session()->put('forgotpwdemail',Input::get('email'));
                    Mail::send(['text'=>'mail'],['name','jay'],function($message)
                    {
                        $message->to(Input::get('email'),'to jay kakadiya')->subject('Forgot Password');
                        $message->from('jaykakadiya9898@gmail.com','jay kakadiya');
                    });
                    return redirect('login')->with('success','New Password Send Successfully..');
                }
            }
            return redirect('forgotpwd')->with('danger','Your Email Id Is Incorrect');
        
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
    public function edit(Request $request)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
    }
}
