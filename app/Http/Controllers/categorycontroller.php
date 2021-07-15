<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;

class categorycontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('category')->paginate(5);
        return view('category',['data' => $data]);
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
        $cats = DB::table('category')->lists('Category_name');
        $fornew = 1;
        foreach ($cats as $row)
        {
            if ($row == strtolower(Input::get('category_name')))
            {
                $fornew = 0;
               return redirect('category')->with('danger','Record is already exist...');
            }
        }
        if ($fornew == 1)
        {
            $total = Category::max('category_id');
            $cat = new Category(); 
            $cat->category_id = $total + 1;
            $cat->category_name = strtolower(Input::get('category_name'));
            $cat->save();
            return redirect('category')->with('success','Record added successfully.');
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
        DB::table('category')
        ->where('Category_id',Input::get('id'))
        ->update(['Category_name'=>strtolower(Input::get('name'))]);
        return redirect('category')->with('success','Record update successfully.');
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
        $data = DB::table('Category')
            ->where('Category_id',$id)
            ->get();
        return view('categoryupdate',['data' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::where('category_id',$id)->delete();
        for($i=$id+1; $i < Category::max('category_id')+1; $i++)
        {
            DB::table('category')->where('category_id',$i)
            ->update(['category_id' => $i-1]);
        }
        return redirect('category')->with('danger','Record deleted successfully.');
    }
}