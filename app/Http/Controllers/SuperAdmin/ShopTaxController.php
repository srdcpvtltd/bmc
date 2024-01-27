<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Establishment;
use App\Models\ShopTax;
use Exception;
use Illuminate\Http\Request;

class ShopTaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxes = ShopTax::all();
        $establishments = Establishment::all();
        return view('super_admin.shop_tax.index',compact('establishments','taxes'));
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
        try{
            $this->validate($request,[
                'amount' => 'required',
                'establishment_id' => 'required',
                'limit'=>'required',
            ]);
            $isAlready = ShopTax::where('establishment_id',$request->establishment_id)->first();
            if($isAlready)
            {
                toastr()->warning("Alread Exists.");
                return redirect()->back();
            }else{
                ShopTax::create($request->all());
            }
            toastr()->success('Shop Tax Added Successfully');
            return redirect()->back();
        }catch (Exception $e)
        {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShopTax  $shopTax
     * @return \Illuminate\Http\Response
     */
    public function show(ShopTax $shopTax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShopTax  $shopTax
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tax = ShopTax::find($id);
        $establishments = Establishment::all();
        return view('super_admin.shop_tax.edit',compact('establishments','tax'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShopTax  $shopTax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $tax = ShopTax::find($id);
        $tax->update($request->all());
        toastr()->success('Shop Tax Updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShopTax  $shopTax
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shopTax = ShopTax::find($id);
        $shopTax->delete();
        toastr()->success('Shop Tax Deleted successfully');
        return redirect()->back();
    }
}
