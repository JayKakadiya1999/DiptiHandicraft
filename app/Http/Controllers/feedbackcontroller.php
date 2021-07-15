<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Feedback;

class feedbackcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function feedback(Request $request)
    {
        $activeuser = session()->get('activeuser');
        $feedback = Input::get('feedback');
        $pro_id = Input::get('product_id');
        $max = Feedback::max('Feedback_id');
        $max = $max + 1;
        date_default_timezone_set('asia/calcutta');
        $date = date("Y-m-d");
        DB::table('feedback')->insert(
                    ['Feedback_id' => $max, 'Feedback_date' => $date, 'Description' => $feedback, 'User_id' => $activeuser, 'Product_id' => $pro_id]
                    );
        return redirect('mypurchaseorder');
    }



    public function giverating(Request $request)
    {
        $id = Input::get('id');
        $data = DB::table('product')
                    ->join('image','image.Product_id','=','product.Product_id')
                    ->where('product.Product_id','=',$id)
                    ->get();
        return view('giverating',['data' => $data]);
    }



    public function rating(Request $request)
    {
        $activeuser = session()->get('activeuser');
        $product_id = Input::get('id');
        $rate = Input::get('rates');
        $rating = DB::table('rating')->get();
        $new = 0;
        foreach ($rating as $row)
        {
            if ($row->User_id == $activeuser)
            {
                if ($row->Product_id == $product_id)
                {
                    DB::table('rating')
                        ->where('User_id','=', $row->User_id)
                        ->where('Product_id','=',$row->Product_id)
                        ->update(['Rating_value' => $rate]);
                    $new = 1;
                    return redirect('mypurchaseorder');
                }
            }
        }
        if ($new == 0)
        {
            DB::table('rating')->insert(
                    ['User_id' => $activeuser, 'Product_id' => $product_id, 'Rating_value' => $rate]
                    );
                    return redirect('mypurchaseorder');
        }
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
