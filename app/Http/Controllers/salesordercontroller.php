<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Salesorder;


class salesordercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function pendsalesorder()
    {
        $data = DB::table('sales_order')
            ->join('user','sales_order.User_id','=','user.User_id')
            ->where('sales_order.Order_status','=','Pending')
            ->join('area','user.Area_id','=','area.Area_id')
            ->join('city','area.City_City_id','=','city.City_id')
            ->join('state','city.State_State_id','=','state.State_id')
            ->paginate(5);
        return view('pendsalesorder',['data'=>$data]);
    }


    public function pendingorderview(Request $request)
    {
        $data = DB::table('sales_order')
            ->join('user','sales_order.User_id','=','user.User_id')
            ->join('area','user.Area_id','=','area.Area_id')
            ->join('city','area.City_City_id','=','city.City_id')
            ->join('state','city.State_State_id','=','state.State_id')
            ->where('Sales_order_id','=',Input::get('id'))
            ->get();
        return view('pendingorderview',['data'=>$data]);
    }

    public function procesalesorder()
    {
        $data = DB::table('sales_order')
            ->join('user','sales_order.User_id','=','user.User_id')
            ->where('sales_order.Order_status','=','Processing')
            ->join('area','user.Area_id','=','area.Area_id')
            ->join('city','area.City_City_id','=','city.City_id')
            ->join('state','city.State_State_id','=','state.State_id')
            ->paginate(5);
        return view('processsalesorder',['data'=>$data]);
    }

    public function processsalesorder(Request $request)
    {
        $id = Input::get('id');
        DB::table('sales_order')
            ->where('Sales_order_id','=',$id)
            ->update(['Order_status' => 'Processing']);
        return redirect('pendsalesorder');
    }


    public function processorderview(Request $request)
    {
        $data = DB::table('sales_order')
            ->join('user','sales_order.User_id','=','user.User_id')
            ->join('area','user.Area_id','=','area.Area_id')
            ->join('city','area.City_City_id','=','city.City_id')
            ->join('state','city.State_State_id','=','state.State_id')
            ->where('Sales_order_id','=',Input::get('id'))
            ->get();
        return view('processorderview',['data'=>$data]);
    }

    public function comporder()
    {
        $data = DB::table('sales_order')
            ->join('user','sales_order.User_id','=','user.User_id')
            ->where('sales_order.Order_status','=','Complete')
            ->join('area','user.Area_id','=','area.Area_id')
            ->join('city','area.City_City_id','=','city.City_id')
            ->join('state','city.State_State_id','=','state.State_id')
            ->paginate(5);
        return view('comporder',['data'=>$data]);
    }

    public function complateorder(Request $request)
    {
        $id = Input::get('id');
        DB::table('sales_order')
            ->where('Sales_order_id','=',$id)
            ->update(['Order_status' => 'Complete']);
        return redirect('procesalesorder');
    }


     public function comporderview(Request $request)
    {
        $data = DB::table('sales_order')
            ->join('user','sales_order.User_id','=','user.User_id')
            ->join('area','user.Area_id','=','area.Area_id')
            ->join('city','area.City_City_id','=','city.City_id')
            ->join('state','city.State_State_id','=','state.State_id')
            ->where('Sales_order_id','=',Input::get('id'))
            ->get();
        return view('comporderview',['data'=>$data]);
    }
    

    public function cancelorder(Request $request)
    {
        $id = Input::get('id');
        DB::table('sales_order')
            ->where('Sales_order_id','=',$id)
            ->update(['Order_status' => 'Cancelled']);
        return redirect('mypurchaseorder');
    }

    
    public function salesreturn()
    {
        $data = DB::table('sales_return')
                    ->join('sales_order','sales_return.Sales_order_id','=','sales_order.Sales_order_id')
                    ->join('user','sales_order.User_id','=','user.User_id')
                    ->join('area','user.Area_id','=','area.Area_id')
                    ->join('city','area.City_City_id','=','city.City_id')
                    ->join('state','city.State_State_id','=','state.State_id')
                    ->get();
        return view('salesreturn',['data' => $data]);
    }

    public function salesreturnview()
    {
        $data = DB::table('sales_return')
                    ->join('sales_order','sales_return.Sales_order_id','=','sales_order.Sales_order_id')
                    ->join('user','sales_order.User_id','=','user.User_id')
                    ->join('area','user.Area_id','=','area.Area_id')
                    ->join('city','area.City_City_id','=','city.City_id')
                    ->join('state','city.State_State_id','=','state.State_id')
                    ->where('Sales_return_id','=',Input::get('id'))
                    ->get();
        return view('showsalesreturn',['data' => $data]);
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
    public function update(Request $request)
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
