<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Purchase;
use App\Rawmaterial;
use App\Purchase_return;

class purchasecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('purchase_order')
                ->join('supplier','purchase_order.Supplier_id','=','supplier.Supplier_id')
                ->join('area','supplier.Area_id','=','area.Area_id')
                ->join('city','area.City_City_id','=','city.City_id')
                ->join('state','city.State_State_id','=','state.State_id')
                ->join('raw_material','supplier.Raw_material_id','=','raw_material.Raw_material_id')
                ->get();
        return view('purchase',['data' => $data]);
    }


    public function addpurchase()
    {
        //$category = DB::table('product_category')->get();
        $supplier = DB::table('supplier')
                        ->join('raw_material','supplier.Raw_material_id','=','raw_material.Raw_material_id')
                        ->get();
        $category = DB::table('raw_material')->get();
        return view('addpurchase',['category' => $category],['supplier' => $supplier]);
    }

    public function addpurchaseorder(Request $request)
    {
        $date = Input::get('orderdate');
        $supplier = Input::get('supplier');
        $rawid =  Input::get('material');
        $qty = Input::get('qty');
        $price = Input::get('price');
        $max = Purchase::max('Purchase_order_id');
        $max = $max + 1;
        $total_amt = 0;
        $total = 0;

        for ($i=0; $i < count($rawid); $i++)
        { 
            $qtys = DB::table('raw_material')->where('Raw_material_id','=',$rawid[$i])->lists('QOH');
            foreach ($qtys as $row)
            {
                $tot = $row + $qty[$i];
            }
            DB::table('raw_material')
                    ->where('Raw_material_id','=',$rawid[$i])
                    ->update(['QOH' => $tot]);
        }

        for ($i=0; $i < count($qty); $i++)
        { 
            $total_amt = $price[$i] * $qty[$i];
            $total = $total + $total_amt;
        }
        $raw_material_id = DB::table('supplier')
                        ->where('Supplier_id','=',$supplier)
                        ->lists('Raw_material_id');  
        DB::table('purchase_order')->insert(['Purchase_order_id' => $max,'Order_date' => $date, 'Total_amt' => $total, 'Supplier_id' => $supplier]);
        for ($i=0; $i < count($qty); $i++)
        { 
            DB::table('purchase_order_details')->insert(['Purchase_order_id' => $max,'Raw_material_id' => $rawid[$i], 'QTY' => $qty[$i],'Price' => $price[$i]]); 
        }

        return redirect('purchase');
        
    }

    public function purchseview(Request $request)
    {
        $data = DB::table('purchase_order')
                ->join('supplier','purchase_order.Supplier_id','=','supplier.Supplier_id')
                ->join('area','supplier.Area_id','=','area.Area_id')
                ->join('city','area.City_City_id','=','city.City_id')
                ->join('state','city.State_State_id','=','state.State_id')
                ->join('raw_material','supplier.Raw_material_id','=','raw_material.Raw_material_id')
                ->where('Purchase_order_id','=',Input::get('id'))
                ->get();
        return view('showpurchaseorder',['data' => $data]);
    }

    public function returnpurchase(Request $request)
    {
        $data = DB::table('purchase_order')
                ->join('supplier','purchase_order.Supplier_id','=','supplier.Supplier_id')
                ->join('area','supplier.Area_id','=','area.Area_id')
                ->join('city','area.City_City_id','=','city.City_id')
                ->join('state','city.State_State_id','=','state.State_id')
                ->join('raw_material','supplier.Raw_material_id','=','raw_material.Raw_material_id')
                ->where('Purchase_order_id','=',Input::get('id')) 
                ->get();
        return view('returnpurchase',['data' => $data]);
    }

    public function returnpurchaseform(Request $request)
    {
        $purchase_order_id = Input::get('purchase_order_id');
        $raw_material_id = Input::get('id');
        $reason = Input::get('reason');
        $qty = Input::get('qty');
        date_default_timezone_set('asia/calcutta');
        $date = date("Y-m-d");
        $max = Purchase_return::max('Purchase_return_id');
        $max = $max + 1;
        $fornew = 1;
        foreach ($qty as $row)
        {
            if ($row != 0)
            {
                if ($fornew == 1)
                {
                    DB::table('purchase_return')->insert(['Purchase_return_id' => $max,'Return_date' => $date,'Purchase_order_id' => $purchase_order_id]);
                    $fornew = 0;
                }
                for ($i=0; $i < count($raw_material_id); $i++)
                { 
                    if ($qty[$i] != 0)
                    {
                        DB::table('purchase_return_details')->insert(['Purchase_return_id' => $max,'Raw_material_id' => $raw_material_id[$i],'Reason' => $reason[$i],'qty' => $qty[$i]]);
                    }
                }
                return redirect('purchasereturn');
            }
        }
    }

    public function purchasereturn(Request $request)
    {
        $data = DB::table('purchase_return')
                    ->join('purchase_order','purchase_return.Purchase_order_id','=','purchase_order.Purchase_order_id')
                    ->join('supplier','purchase_order.Supplier_id','=','supplier.Supplier_id')
                    ->join('raw_material','supplier.Raw_material_id','=','raw_material.Raw_material_id')
                    ->join('area','supplier.Area_id','=','area.Area_id')
                    ->join('city','area.City_City_id','=','city.City_id')
                    ->join('state','city.State_State_id','=','state.State_id')
                    ->get();
        return view('purchasereturn',['data' => $data]);
    }

    public function purchsereturnview(Request $request)
    {
        $data = DB::table('purchase_return')
                ->join('purchase_order','purchase_return.Purchase_order_id','=','purchase_order.Purchase_order_id')
                ->join('supplier','purchase_order.Supplier_id','=','supplier.Supplier_id')
                ->join('raw_material','supplier.Raw_material_id','=','raw_material.Raw_material_id')
                ->join('area','supplier.Area_id','=','area.Area_id')
                ->join('city','area.City_City_id','=','city.City_id')
                ->join('state','city.State_State_id','=','state.State_id')
                ->where('Purchase_return_id','=',Input::get('id'))
                ->get();
        return view('showpurchasereturn',['data' => $data]);
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
