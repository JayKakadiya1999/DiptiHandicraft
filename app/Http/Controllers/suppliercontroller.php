<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Supplier;
use App\Rawmaterial;
use App\State;
use App\City;
use App\Area;

class suppliercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('supplier');
        $data = DB::table('raw_material')
                ->join('supplier','raw_material.Raw_material_id','=','supplier.Raw_material_id')
                ->join('area','supplier.Area_id','=','area.Area_id')
                ->join('city','area.City_City_id','=','city.City_id')
                ->join('state','city.State_State_id','=','state.State_id')
                ->paginate(10);
        $state = DB::table('state')->get();
        return view('supplier',['data'=>$data],['state' => $state]);
        //dd($data);

    }



    public function city()
    {
        $state_id=Input::get('state_id');
        $city= City::where('State_State_id','=',$state_id)->get();
        return response()->json($city);       
    }

    public function material()
    {
        $material= Rawmaterial::all();
        return response()->json($material);       
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
        $suppliers = DB::table('supplier')->lists('Email');
        foreach($suppliers as $row)
        {
            if($row == Input::get('email'))
            {
                return redirect('supplier')->with('danger','record already exist.');
            }
        }
        $supplier_id = Supplier::max('Supplier_id');
        $supplier_id = $supplier_id + 1;
        $supplier = new Supplier;
        $supplier->Supplier_id = $supplier_id;
        $supplier->name = ucwords(Input::get('name'));
        $supplier->Email = Input::get('email');
        $supplier->Contact = Input::get('contact');
        $supplier->Address = Input::get('address');
        $supplier->Raw_material_id = Input::get('raw_material');

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
                        $supplier->Area_id = $i+1;
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
            $supplier->Area_id = $newareaid;
        }
        $supplier->save();
        return redirect('supplier')->with('success','Record added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = DB::table('raw_material')
                ->join('supplier','raw_material.Raw_material_id','=','supplier.Raw_material_id')
                ->join('area','supplier.Area_id','=','area.Area_id')
                ->join('city','area.City_City_id','=','city.City_id')
                ->join('state','city.State_State_id','=','state.State_id')
                ->where('Supplier_id','=',Input::get('id'))
                ->get();
        return view('showsupplier',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $raw_material = Input::get('material');
        if ($raw_material != null) {
            DB::table('supplier')
                ->where('Supplier_id', Input::get('id'))
                ->update(['Raw_material_id' => Input::get('material')]);
        }   
        $oldarea =Input::get('oldarea');
        $oldcity = Input::get('oldcity');
        $userarea = strtolower(Input::get('area'));
        $usercity = Input::get('city');
        if($oldarea == $userarea && $oldcity == $usercity)
        {
            DB::table('supplier')
                ->where('Supplier_id', Input::get('id'))
                ->update(['Name' => Input::get('name'),'Email'=>Input::get('email'),'Contact'=>Input::get('contact'),'Address'=>Input::get('address')]);
            return redirect('supplier')->with('success','Record updated successfully');
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
                                DB::table('supplier')
                                    ->where('Supplier_id', Input::get('id'))
                                    ->update(['Name' => Input::get('name'),'Email'=>Input::get('email'),'Contact'=>Input::get('contact'),'Address'=>Input::get('address'),'Area_id'=> $i+1]);
                                return redirect('supplier')->with('success','Record updated successfully');
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
                    DB::table('supplier')
                       ->where('Supplier_id',Input::get('id'))
                       ->update(['Name' => Input::get('name'),'Email' => Input::get('email'),'Contact' => Input::get('Contact'),'Address' => Input::get('address'),'Area_id' => $newareaid]);
                    return redirect('supplier')->with('success','Record updated successfully');
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
                                DB::table('supplier')
                                    ->where('Supplier_id', Input::get('id'))
                                    ->update(['Name' => Input::get('name'),'Email'=>Input::get('email'),'Contact'=>Input::get('contact'),'Address'=>Input::get('address'),'Area_id'=> $i+1]);
                                return redirect('supplier')->with('success','Record updated successfully');
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
                    DB::table('supplier')
                       ->where('Supplier_id',Input::get('id'))
                       ->update(['Name' => Input::get('name'),'Email' => Input::get('email'),'Contact' => Input::get('contact'),'Address' => Input::get('address'),'Area_id' => $newareaid]);
                    return redirect('supplier')->with('success','Record updated successfully');
                }
            }
        }
    }



    public function update(Request $request)
    {
        $data = DB::table('raw_material')
                ->join('supplier','raw_material.Raw_material_id','=','supplier.Raw_material_id')
                ->join('area','supplier.Area_id','=','area.Area_id')
                ->join('city','area.City_City_id','=','city.City_id')
                ->join('state','city.State_State_id','=','state.State_id')
                ->where('Supplier_id','=',Input::get('id'))
                ->get();    
        $state = DB::table('state')->get();
        return view('updatesupplier',['data' => $data],['state' => $state]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    
    
    public function destroy($id)
    {
        /*Supplier::where('supplier_id',$id)->delete();
        for($i=$id+1; $i < Supplier::max('supplier_id')+1; $i++)
        {
            DB::table('supplier')->where('supplier_id',$i)
            ->update(['supplier_id' => $i-1]);
        }
        return redirect('supplier')->with('danger','Record deleted successfully');*/
    }    
}
