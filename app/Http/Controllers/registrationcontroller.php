<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\City;
use App\Area;
use App\Users;

class registrationcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('state')
            ->get();
        $state = DB::table('state')->get();
        return view('registration',['data' => $data],['state' => $state]);
    }

    public function city()
    {
        $state_id=Input::get('state_id');
        $city= City::where('State_State_id','=',$state_id)->get();
        return response()->json($city);       
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
        /*-------Check Email exit or  not in User Table------ */
        $useremail = Input::get('email');
        $emails = DB::table('user')->lists('email');
        $totaluser = Users::max('User_id');
        $newregister = 0;

        for($i = 0; $i < $totaluser; $i++)
        {

            $email = $emails[$i];
            if($email == $useremail)
            {
                $newregister = 1;
                return redirect('registration')->with('danger','Email Id Already Exits');
            }
        }

        if($newregister == 0)
        {
            $usermax=Users::max('user_id');
            $usermax = $usermax + 1;
            $user = new Users();
            $user->user_id = $usermax;

            $user->Name = Input::get('name');
            $user->password = Input::get('password');
            $user->Address = Input::get('address');
            $user->Contact = Input::get('contact');
            $user->Email = Input::get('email');
            $user->user_type_id = 1;
            $user->seq_que = Input::get('seq_que');
            $user->seq_ans = Input::get('seq_ans');

            /*---For Area---*/
            $totalarea = Area::max('Area_id');
            $userarea = strtolower(Input::get('area'));
            $usercity = Input::get('city');
            $areas = DB::table('area')->lists('Area_name');
            $fornewarea = 1;
            if($totalarea != 0)
            {
                for($i=0;$i < $totalarea; $i++)
                {
                    $area = $areas[$i];
                    if($area == $userarea)   
                    {
                        $city_id = DB::table('area')->where('Area_name',$userarea)->value('City_City_id');
                        if($city_id == /*$usercity*/ 1)
                        {
                            $user->area_id = $i + 1;
                            $fornewarea = 0;
                        }
                    }
                }
            }
            if($fornewarea == 1)
            {
                $newareaid = $totalarea + 1;
                $area = new Area;
                $area->Area_id = $newareaid;
                $area->Area_name = $userarea;
                $area->City_City_id = 1;
                $area->save();
                $user->Area_id = $newareaid;
            }

            $user->save();
            return redirect('login');
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
