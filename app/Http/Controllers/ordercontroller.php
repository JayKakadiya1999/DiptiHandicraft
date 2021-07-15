<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Salesorder;
use App\salesreturn;
use DateTime;
// use PDF;

class ordercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeuser = session()->get('activeuser');
        $cartproduct = DB::table('cart')
            ->join('product','cart.Product_id','=','product.Product_id')
            ->where('cart.User_id','=',$activeuser)
            ->get();
        $max = Salesorder::max('Sales_order_id');
        $max = $max + 1;
        $totalamt = 0;
        $discount = 0;
        foreach ($cartproduct as $row)
        {
            $discount = $discount + ($row->Discount * $row->qty);
            $totalamt = $totalamt + ($row->Price * $row->qty) - ($row->Discount * $row->qty);
        }
        $sgst = $totalamt * 2.5 / 100;
        $cgst = $totalamt * 2.5 / 100;
        $totalamt = $totalamt + $sgst + $cgst;
        date_default_timezone_set('asia/calcutta');
        $date = date("Y-m-d");
        DB::table('sales_order')->insert(['Sales_order_id' => $max, 'Order_date' => $date, 'Total_amount' => $totalamt, 'CGST' => $cgst, 'SGST' => $sgst, 'dis' => $discount, 'User_id' => $activeuser,'Order_status' => 'Pending']);
        foreach ($cartproduct as $row)
        {
            $qty_pr = ($row->Price * $row->qty - $row->Discount *  $row->qty);
            DB::table('sales_order_details')->insert(['Sales_order_id' => $max, 'Product_id' => $row->Product_id, 'Quantity' => $row->qty, 'Qty_price' => $qty_pr]);
        }
        $cartpro=DB::table('cart')
            ->where('User_id','=',$activeuser)
            ->get();
        foreach ($cartpro as $row)
        {
            DB::table('cart')
            ->where('User_id','=',$activeuser)
            ->delete();
        }
        return redirect('mypurchaseorder');
        
    }

    public function mypurchaseorder()
    {
        $activeuser = session()->get('activeuser');
        $data = DB::table('sales_order')
            ->where('User_id','=',$activeuser)
            ->whereIn('Order_status',['pending','processing'])
            ->orderBy('Sales_order_id','desc')
            ->get();
        
        $complateorder = DB::table('sales_order')
            ->where('User_id','=',$activeuser)
            ->whereIn('Order_status',['complete','cancelled'])
            ->orderBy('Sales_order_id','desc')
            ->get();

        return view('mypurchaseorder',['data' => $data],['complateorder' => $complateorder]);
    }

    public function cancelorder(Request $request)
    {
        $id = Input::get('id');
        DB::table('sales_order')
            ->where('Sales_order_id','=',$id)
            ->update(['Order_status' => 'Cancelled']);
        return redirect('mypurchaseorder');
    }   

    public function orderview(Request $request)
    {
        $id = Input::get('id');

        $activeuser = session()->get('activeuser');
        $data = DB::table('sales_order')
                ->join('sales_order_details','sales_order.Sales_order_id','=','sales_order_details.Sales_order_id')
                ->join('product','sales_order_details.Product_id','=','product.Product_id')
                ->join('image','product.Product_id','=','image.Product_id')
                ->where('sales_order.Sales_order_id','=',$id)
                ->get();
                
        foreach ($data as $row)
        {
                $fdate = new DateTime($row->Order_date);
                date_default_timezone_set('asia/calcutta');
                $date = date("y-m-d");
                $date = new DateTime($date);
                $int = $fdate->diff($date);
                $days = $int->format('%a');
        }
        
        return view('orderview',['data' => $data],['days' => $days]);   
    }

    public function invoice(Request $request)
    {
        $id = Input::get('id');

        $activeuser = session()->get('activeuser');
        $data = DB::table('sales_order')

                ->where('sales_order.Sales_order_id','=',$id)
                ->get();

        $product = DB::table('sales_order_details')
                ->join('product','sales_order_details.Product_id','=','product.Product_id')
                ->where('sales_order_details.Sales_order_id','=',$id)
                ->get();

        foreach ($data as $row)
        {
                $fdate = new DateTime($row->Order_date);
                date_default_timezone_set('asia/calcutta');
                $date = date("d-m-Y");
                $date = new DateTime($date);
                $int = $fdate->diff($date);
                $days = $int->format('%a');
        }
        return view('invoice',compact('data','days','product'));
        

    }   

    public function complateorderview(Request $request)
    {
        $id = Input::get('id');

        $activeuser = session()->get('activeuser');
        $data = DB::table('sales_order')
                ->where('sales_order.Sales_order_id','=',$id)
                ->get();
        foreach ($data as $row)
        {
                $fdate = new DateTime($row->Order_date);
                date_default_timezone_set('asia/calcutta');
                $date = date("y-m-d");
                $date = new DateTime($date);
                $int = $fdate->diff($date);
                $days = $int->format('%a');
        }
        
        return view('complateorderview',['data' => $data],['days' => $days]);
    }


    public function returnproducts(Request $request)
    {
        $id = Input::get("id");
        $activeuser = session()->get('activeuser');
        $data = DB::table('sales_order')
                        ->where('sales_order_id','=',Input::get('id'))
                        ->get();
        return view('returnproducts',['data' => $data]);
    }


    public function returnproductsform(Request $request)
    {
        $sales_order_id = Input::get('sales_order_id');
        $pro_dis = Input::get('pro_dis');
        $qty = Input::get('qty');
        $product_id = Input::get('product_id');
        $reason = Input::get('reason');
        date_default_timezone_set('asia/calcutta');
        $date = date("Y-m-d");
        $max = Salesreturn::max('sales_return_id');
        $max = $max + 1;
        $amt = 0;
        $pro_dis = 0;
        $tot_amt = 0;
        foreach ($qty as $row)
        {
            if ($row != 0)
            {
                DB::table('sales_return')->insert(['Sales_return_id'=>$max,'Return_date'=> $date,'Sales_order_id'=>$sales_order_id]);
                for ($i=0; $i < count($product_id); $i++)
                { 
                    if ($qty[$i] != 0)
                    {
                        $price = DB::table('product')
                                    ->where('Product_id','=',$product_id[$i])
                                    ->lists('Price');
                        foreach ($price as $row)
                        {
                            $price = $row;
                        }
                        $amt = $price * $qty[$i];
                        $tot_amt = $tot_amt + $amt;
                        DB::table('sales_return_details')->insert(['Sales_return_id' => $max,'Product_id' => $product_id[$i],'Reason' => $reason[$i],'Qty_return' => $qty[$i]]);
                    }
                }
                DB::table('sales_return')
                        ->where('Sales_return_id','=',$max)
                        ->update(['Amt' => $tot_amt],['Pro_dis' => $pro_dis]);
                return redirect('mypurchaseorder');
            }
        }
        return redirect('mypurchaseorder');
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
        //
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
