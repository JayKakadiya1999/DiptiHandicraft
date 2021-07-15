<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\rawmaterial;


class rawmaterialcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('raw_material')->paginate(5);                
        return view('rawmaterial',['data' => $data]);
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
        $lst = DB::table('raw_material')->lists('Raw_material_name');
        $fornew = 1;
        foreach ($lst as $row)
        {
            if ($row == strtolower(Input::get('name')))
            {
                $fornew = 0;
            return redirect('rawmaterial')->with('danger','Record is already exist...');
            }
        }

        if ($fornew == 1)
        {

        //-----------For Image Raw_Material--------------
         
            $image = $request->file('image_raw');
            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['imagename']);

            $total = rawmaterial::max('Raw_material_id');
            $raw = new rawmaterial(); 
            $raw->Raw_material_id = $total + 1;
            $raw->Raw_material_name = strtolower(Input::get('name'));
            $raw->QOH= Input::get('qoh');
            $raw->Path = "images/".$input['imagename'];
            $raw->save();

            return redirect('rawmaterial')->with('success','Record added successfully.');
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
    public function edit(Request $request)
    {
        $image = $request->file('image_raw');
        if($image == null)
        {
            DB::table('raw_material')
                ->where('Raw_material_id',Input::get('id'))
                ->update(['raw_material_name'=>strtolower(Input::get('name')),'QOH'=>Input::get('qoh')]);
        }
        else
        {
            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['imagename']);

            DB::table('raw_material')
                    ->where('Raw_material_id',Input::get('id'))
                    ->update(['raw_material_name'=>strtolower(Input::get('name')),'QOH'=>Input::get('qoh'),'Path'=>"images/".$input['imagename']]);
        }
        return redirect('rawmaterial')->with('success','Record update successfully.');
        
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
        $id = Input::get('id');
        $data = DB::table('raw_material')
            ->where('Raw_material_id',$id)
            ->get();
        return view('updaterawmaterial',['data' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        rawmaterial::where('Raw_material_id',$id)->delete();
        for($i=$id+1; $i < rawmaterial::max('Raw_material_id')+1; $i++)
        {
            DB::table('raw_material')->where('Raw_material_id',$i)
            ->update(['Raw_material_id' => $i-1]);
        }
        return redirect('rawmaterial')->with('danger','Record deleted successfully.');
    }
}
