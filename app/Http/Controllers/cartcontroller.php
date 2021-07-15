<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cart;

class cartcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeuser = session()->get('activeuser');
        if($activeuser == null)
        {
            return view('login');
        }
        $data = DB::table('cart')
            ->join('product','cart.Product_id','=','product.Product_id')
            ->join('image','product.Product_id','=','image.Product_id')
            ->where('User_id','=',$activeuser)
            ->get();

        //--------For Sub Total And Total And GST In Cart--------
        $prototal = 0;
        $total = 0;
        foreach ($data as $row)
        {
            $prototal = $row->Price * $row->qty - $row->Discount * $row->qty;
            $total = $total + $prototal;
        }

        return view('cart',['data' => $data],['total' => $total]);
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

    public function cart(Request $request)
    {
        $id = Input::get('id');
        $activeuser = session()->get('activeuser');

        if($activeuser == null)
        {
            return redirect('login');
        }

        //-----For qty plus-----
        
        $addnew=0;
        $cartproducts = DB::table('cart')
                    ->where('User_id','=',$activeuser)
                    ->get();
        foreach ($cartproducts as $row)
        {
            if ($row->Product_id == $id)
            {
                $prototal = $row->qty;
                $prototal = $prototal+1;
                DB::table('cart')
                        ->where('Product_id',$id )
                        ->update(['qty' => $prototal]);
                $addnew=1;
                return redirect('showcart');
            }
        }
        if($addnew==0)
        {
            DB::table('cart')
                 ->insert( ['Product_id' => $id, 'Qty' => 1,'User_id' => $activeuser]);
            return redirect('showcart');
        }
    }

    public function increment(Request $request)
    {
        $product_id = Input::get('id');
        $activeuser = session()->get('activeuser');
        $cartproduct = DB::table('cart')
                        ->where('Product_id','=',$product_id)
                        ->where('User_id','=',$activeuser)
                        ->lists('qty');

        foreach($cartproduct as $row)
        {
            $row = $row + 1;
            DB::table('cart')
                ->where('Product_id','=',$product_id)
                ->where('User_id','=',$activeuser)
                ->update(['qty' => $row]);

        }
        return redirect('showcart');
    }


    public function decrement(Request $request)
    {
        $product_id = Input::get('id');
        $activeuser = session()->get('activeuser');
        $cartproduct = DB::table('cart')
                        ->where('Product_id','=',$product_id)
                        ->where('User_id','=',$activeuser)
                        ->lists('qty');

        foreach($cartproduct as $row)
        {
            $row = $row - 1;
            if ($row == 0)
             {
                DB::table('cart')
                ->where('Product_id',$product_id)
                ->where('User_id','=',$activeuser)
                ->delete();
            }
            DB::table('cart')
                ->where('Product_id','=',$product_id)
                ->where('User_id','=',$activeuser)
                ->update(['qty' => $row]);

        }
        return redirect('showcart');
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
