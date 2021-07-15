<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Employee;
use App\Product;
use App\State;
use App\City;
use App\Area;

class employeecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('product')
                ->join('employee','product.Product_id','=','employee.Product_id')
                ->join('area','employee.Area_id','=','area.Area_id')
                ->join('city','area.City_City_id','=','city.City_id')
                ->join('state','city.State_State_id','=','state.State_id')
                ->paginate(10);    
        $state = DB::table('state')->get();
        
        return view('employee',['data'=>$data],['state' => $state]);
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

    public function product()
    {
        $product= Product::all();
        return response()->json($product);       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employees = DB::table('employee')->lists('Email');
        foreach($employees as $row)
        {
            if($row == Input::get('email'))
            {
                return redirect('employee')->with('danger','record already exist.');
            }
        }
        $employee_id = Employee::max('Employee_id');
        $employee_id = $employee_id + 1;
        $employee = new Employee;
        $employee->Employee_id = $employee_id;
        $employee->Name = ucwords(Input::get('name'));
        $employee->DOJ = Input::get('date');
        $employee->Email = Input::get('email');
        $employee->Contact = Input::get('contact');
        $employee->Address = Input::get('address');
        $employee->Product_id = Input::get('product');

        /*for area*/
        $totalarea= Area::max('Area_id');
        $userarea = strtolower(Input::get('area'));
        $usercity = Input::get('city');
        $areas = DB::table('area')->lists('Area_name');
        $fornnewarea = 1;
        if ($totalarea != 0) {
            for ($i=0; $i < $totalarea; $i++)
            {
                $area = $areas[$i];
                if($area == $userarea)
                {
                    $city_id = DB::table('area')->where('Area_name', $userarea)->value('City_City_id');
                    if($city_id == $usercity)
                    {
                        $employee->Area_id = $i+1;
                        $fornnewarea = 0;
                    }
                }
            }   
        }
        if($fornnewarea == 1)
        {
            $newareaid = $totalarea + 1;
            $Area = new Area;
            $Area->Area_id = $newareaid;
            $Area->Area_name = $userarea;
            $Area->City_City_id = $usercity;
            $Area->save();
            $employee->Area_id = $newareaid;
        }
        $employee->save();
        return redirect('employee')->with('success','Record added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = DB::table('product')
                ->join('employee','product.Product_id','=','employee.Product_id')
                ->join('area','employee.Area_id','=','area.Area_id')
                ->join('city','area.City_City_id','=','city.City_id')
                ->join('state','city.State_State_id','=','state.State_id')
                ->where('Employee_id','=',Input::get('id'))
                ->get();
        return view('showemployee',['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $product = Input::get('product');
        if ($product != null) {
            DB::table('employee')
                ->where('Employee_id', Input::get('id'))
                ->update(['Product_id' => Input::get('product')]);
        }   
        $oldarea =Input::get('oldarea');
        $oldcity = Input::get('oldcity');
        $userarea = strtolower(Input::get('area'));
        $usercity = Input::get('city');
        if($oldarea == $userarea && $oldcity == $usercity)
        {
            DB::table('employee')
                ->where('Employee_id', Input::get('id'))
                ->update(['Name' => Input::get('name'),'DOJ'=>Input::get('date'),'Email'=>Input::get('email'),'Contact'=>Input::get('contact'),'Address'=>Input::get('address')]);
            return redirect('employee')->with('success','Record updated successfully');
        }
        else
        {
            if($usercity == null)
            {
                $usercity = $oldcity;
                $totalarea= Area::max('Area_id');
                $areas = DB::table('area')->lists('Area_name');
                $fornnewarea = 1;
                if ($totalarea != 0) {
                    for ($i=0; $i < $totalarea; $i++)
                    {
                        $area = $areas[$i];
                        if($area == $userarea)
                        {
                            $city_id = DB::table('area')->where('Area_name', $userarea)->value('City_City_id');
                            if($city_id == $usercity)
                            {
                                $fornnewarea = 0;
                                DB::table('employee')
                                    ->where('Employee_id', Input::get('id'))
                                    ->update(['Name' => Input::get('name'),'DOJ'=>Input::get('date'),'Email'=>Input::get('email'),'Contact'=>Input::get('contact'),'Address'=>Input::get('address'),'Area_id'=> $i+1]);
                                return redirect('employee')->with('success','Record updated successfully');
                            }
                        }
                    }   
                }
                if($fornnewarea == 1)
                {
                    $newareaid = $totalarea + 1;
                    $Area = new Area;
                    $Area->Area_id = $newareaid;
                    $Area->Area_name = $userarea;
                    $Area->City_City_id = Input::get('oldcityid');
                    $Area->save();
                    DB::table('employee')
                       ->where('Employee_id',Input::get('id'))
                       ->update(['Name' => Input::get('name'),'DOJ'=>Input::get('date'),'Email' => Input::get('email'),'Contact' => Input::get('Contact'),'Address' => Input::get('address'),'Area_id' => $newareaid]);
                    return redirect('employee')->with('success','Record updated successfully');
                }
            }
            if($usercity != null)
            {
                $totalarea= Area::max('Area_id');
                $areas = DB::table('area')->lists('Area_name');
                $fornnewarea = 1;
                if ($totalarea != 0) {
                    for ($i=0; $i < $totalarea; $i++)
                    {
                        $area = $areas[$i];
                        if($area == $userarea)
                        {
                            $city_id = DB::table('area')->where('Area_name', $userarea)->value('City_City_id');
                            if($city_id == $usercity)
                            {
                                $fornnewarea = 0;
                                DB::table('employee')
                                    ->where('Employee_id', Input::get('id'))
                                    ->update(['Name' => Input::get('name'),'DOJ'=>Input::get('date'),'Email'=>Input::get('email'),'Contact'=>Input::get('contact'),'Address'=>Input::get('address'),'Area_id'=> $i+1]);
                                return redirect('employee')->with('success','Record updated successfully');
                            }
                        }
                    }   
                }
                if($fornnewarea == 1)
                {
                    $newareaid = $totalarea + 1;
                    $Area = new Area;
                    $Area->Area_id = $newareaid;
                    $Area->Area_name = $userarea;
                    $Area->City_City_id = $usercity;
                    $Area->save();
                    DB::table('employee')
                       ->where('Employee_id',Input::get('id'))
                       ->update(['Name' => Input::get('name'),'DOJ'=>Input::get('date'),'Email' => Input::get('email'),'Contact' => Input::get('contact'),'Address' => Input::get('address'),'Area_id' => $newareaid]);
                    return redirect('employee')->with('success','Record updated successfully');
                }
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = DB::table('product')
                ->join('employee','product.Product_id','=','employee.Product_id')
                ->join('area','employee.Area_id','=','area.Area_id')
                ->join('city','area.City_City_id','=','city.City_id')
                ->join('state','city.State_State_id','=','state.State_id')
                ->where('Employee_id','=',Input::get('id'))
                ->get();
        $state = DB::table('state')->get();
        return view('updateemployee',['data' => $data],['state' => $state]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::where('Employee_id',$id)->delete();
        for($i=$id+1; $i < Employee::max('Employee_id')+1; $i++)
        {
            DB::table('employee')->where('Employee_id',$i)
            ->update(['Employee_id' => $i-1]);
        }
        return redirect('employee')->with('danger','Record deleted successfully.');
    }
}
