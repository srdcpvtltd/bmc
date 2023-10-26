<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Helpers\PaymentGateway;
use App\Http\Controllers\Controller;
use App\Models\Establishment;
use App\Models\EstablishmentShop;
use App\Models\Payment;
use App\Models\Shop;
use App\Models\Ward;
use Exception;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('super_admin.shop.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super_admin.shop.create');
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
                'owner_name' => 'required',
            ]);
            $shop = Shop::create($request->all());
            if($request->establishment_shop_id)
            {
                $establishment_shop = EstablishmentShop::find($request->establishment_shop_id);
                if($establishment_shop)
                {
                    $establishment_shop->update([
                        'status' => true
                    ]);
                }
            }
            toastr()->success('Shop Added Successfully');
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
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shop = Shop::find($id);
        return view('super_admin.shop.show',compact('shop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shop = Shop::find($id);
        return view('super_admin.shop.edit',compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $shop = Shop::find($id);
        if($request->establishment_shop_id != $shop->establishment_shop_id)
        {
            $establishment_shop = EstablishmentShop::find($shop->establishment_shop_id);
            if($establishment_shop)
            {
                $establishment_shop->update([
                    'status' => false
                ]);
            }
        }
        $new_establishment_shop = EstablishmentShop::find($request->establishment_shop_id);
        if($new_establishment_shop)
        {
            $new_establishment_shop->update([
                'status' => true
            ]);
        }
        $shop->update($request->all());
        toastr()->success('Shop Updated successfully');
        return redirect()->back(); 
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Shop::find($id);
        $establishment_shop = EstablishmentShop::find($shop->establishment_shop_id);
        if($establishment_shop)
        {
            $establishment_shop->update([
                'status' => false
            ]);
        }
        $shop->delete();
        toastr()->success('Shop Deleted successfully');
        return redirect()->back();
    }
    public function createShopProfile($id)
    {
        try{
            $shop = Shop::find($id);
            PaymentGateway::createCustomer($shop);
            toastr()->success('Shop Create on RazorPay Successfully');
            return redirect()->back();
        }catch (Exception $e)
        {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
    public function getWards(Request $request)
    {
        $wards = Ward::where('zone_id',$request->id)->get();
        return response()->json([
            'wards' => $wards
        ]);
    }
    public function getEstablishments(Request $request)
    {
        $establishments = Establishment::where('establishment_category_id',$request->id)->get();
        return response()->json([
            'establishments' => $establishments
        ]);
    }
    public function getEstablishmentShops(Request $request)
    {
        $establishment_shops = EstablishmentShop::where('establishment_id',$request->id)->where('status',0)->get();
        return response()->json([
            'establishment_shops' => $establishment_shops
        ]);
    }
    public function getEstablishmentShop(Request $request)
    {
        $establishment_shop = EstablishmentShop::find($request->id);
        return response()->json([
            'establishment_shop' => $establishment_shop
        ]);
    }
    public function getShopDetail($id)
    {
        $shop = Shop::find($id);
        $payments = Payment::where('shop_id',$shop->id)->where('type','monthly')->get();
        return view('super_admin.shop.detail',compact('shop','payments'));
    }
}
