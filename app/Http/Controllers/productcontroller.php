<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Product;
use App\Image;
use App\Category;

class productcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('image')
                ->join('product','image.Product_id','=','product.Product_id')
                ->join('category','product.Category_id','=','category.Category_id')->orderBy('Image_id')
                ->Paginate(5);
        $category = DB::table('category')->get();
        return view('product',['data' => $data],['category' => $category]);
    }

    public function cusproduct()
    {
        $id = Input::get('id');
        $data = DB::table('image')
            ->join('product','image.Product_id','=','product.Product_id')
            ->where('Category_id','=',$id)
            ->get();
        return view('cusproduct',['data' => $data]);
    }

    public function singleproduct(Request $request)
    {
        $id = Input::get('id');
        $data = DB::table('image')
            ->join('product','image.Product_id','=','product.Product_id')
            ->join('category','category.Category_id','=','product.Category_id')
            ->where('product.Product_id','=',$id)
            ->get();
        return view('singleproduct',['data' => $data]);
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
        $products = DB::table('product')->lists('Product_name');
        $fornew = 1;
        foreach ($products as $row)
        {
            if ($row == strtolower(Input::get('name')))
            {
                $fornew = 0;
               return redirect('product')->with('danger','Record is already exist...');
            }
        }
        if ($fornew == 1)
        {
            $total = Product::max('Product_id');
            $pro = new Product(); 
            $pro->Product_id = $total + 1;
            $pro->Product_name = strtolower(Input::get('name'));
            $pro->Qty= Input::get('qty');
            $pro->Price= Input::get('price');
            $pro->Discount= Input::get('discount');
            $pro->Discription= Input::get('discription');
            // $pro->Rating= "";
            $pro->Category_id= Input::get('category');
            $pro->save();

            // For Image
            $cnt=Image::max('Image_id');
            $img=new Image();
            $img->Image_id= $cnt + 1;

            $image = $request->file('image_raw');
            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['imagename']);

            

            $img->Path = "images/".$input['imagename'];
            $img->Product_id = $pro->Product_id;
            $img->save();


            return redirect('product')->with('success','Record added successfully.');
        }
        
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = Input::get('id');
        $data = DB::table('image')
                ->join('product','image.Product_id','=','product.Product_id')
                ->join('category','product.Category_id','=','category.Category_id')
                ->where('product.Product_id','=',$id)
                ->get();
        $category = DB::table('category')->get();
        return view('showproduct',['data' => $data],['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {   

        DB::table('product')
        ->where('Product_id',Input::get('id'))
        ->update(['Product_name'=>strtolower(Input::get('name')),'Qty'=>Input::get('qty'),'Price'=>strtolower(Input::get('price')),'Discount'=>Input::get('discount'),'Discription'=>Input::get('discription')]);

        //-----For Image-----

        $var = $request->file('image_raw');
        if($var == null)
        {
            DB::table('product')
            ->where('Product_id',Input::get('id'))
            ->update(['Product_name'=>strtolower(Input::get('name')),'Qty'=>Input::get('qty'),'Price'=>Input::get('price'),'Discount'=>Input::get('discount'),'Discription'=>Input::get('discription'),'Category_id'=> Input::get('category')]);   
        }
        else
        {
            $image = $request->file('image_raw');
            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['imagename']);

            DB::table('product')->where('Product_id',Input::get('id'))
                ->update(['Product_name'=>strtolower(Input::get('name')),'Qty'=>Input::get('qty'),'Price'=>Input::get('price'),'Discount'=>Input::get('discount'),'Discription'=>Input::get('discription'),'Category_id'=> Input::get('category')]);

            DB::table('image')->where('Image_id','=',Input::get('id'))
                ->update(['Path'=>"images/".$input['imagename']]);
        }

        


        return redirect('product')->with('success','Record update successfully.');
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

        $data = DB::table('image')
                ->join('product','image.Product_id','=','product.Product_id')
                ->join('category','product.Category_id','=','category.Category_id')
                ->where('product.Product_id','=',$id)
                ->get();
        $category = DB::table('category')->get();
        return view('productupdate',['data' => $data],['category' => $category]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('Product_id',$id)->delete();
        for($i=$id+1; $i < Product::max('Product_id')+1; $i++)
        {
            DB::table('product')->where('Product_id',$i)
            ->update(['Product_id' => $i-1]);
        }
        return redirect('product')->with('danger','Record deleted successfully.');
    }
}
