<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;

class homecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function aboutus()
    {
        return view('aboutus');
    }

    public function contact()
    {
        $activeuser = session()->get('activeuser');
        if($activeuser == null)
        {
            return view('login');
        }
        return view('contact');
    }

    public function profile()
    {
        $activeuser = session()->get('activeuser');
        $data = DB::table('user')
                    ->join('area','user.Area_id','=','area.Area_id')
                    ->join('city','area.City_City_id','=','city.City_id')
                    ->join('state','city.State_State_id','=','state.State_id')
                    ->where('user.User_id','=',$activeuser)
                    ->get();
        return view('profile',['data' => $data]);
    }

    public function profileadmin()
    {
        $activeuser = session()->get('activeuser');
        $data = DB::table('user')
                    ->join('area','user.Area_id','=','area.Area_id')
                    ->join('city','area.City_City_id','=','city.City_id')
                    ->join('state','city.State_State_id','=','state.State_id')
                    ->where('user.User_id','=',$activeuser)
                    ->get();
        return view('profileadmin',['data' => $data]);
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
    public function contactform(Request $request)
    {
        
        // $connected = @fsockopen("www.some_domain.com", 80); 
        //website, port  (try 80 or 443)

    //    if ($connected)
    //    {
            session()->put('name',Input::get('name'));
            session()->put('email',Input::get('email'));
            session()->put('subject',Input::get('subject'));
            session()->put('message',Input::get('message'));
            Mail::send(['text'=>'contactemail'],['name','jay'],function($message)
            {
                $message->to('jaykakadiya9898@gmail.com','to jay kakadiya')->subject('User Contact Mail');
                $message->from('jaykakadiya9898@gmail.com','jay kakadiya');
            });  

            
            return redirect('contact')->with('success','Thanks for contacting us!');
    //    }
    //    else
    //    {
            // return redirect('contact'); //action in connection failure
    //    }


        
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
