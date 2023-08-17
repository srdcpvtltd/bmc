<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Establishment;
use App\Models\EstablishmentShop;
use Exception;
use Illuminate\Http\Request;

class EstablishmentShopController extends Controller
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
                'shop_number' => 'required',
                'establishment_id' => 'required',
                'shop_type' => 'required',
                'shop_size' => 'required',
                'shop_rent' => 'required',
            ]);
            $establishment = Establishment::find($request->establishment_id);
            EstablishmentShop::create($request->all());
            $establishment->update([
                'total_shops' => $establishment->total_shops + 1
            ]);
            toastr()->success('Establishment Shop Added Successfully');
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
     * @param  \App\Models\EstablishmentShop  $establishmentShop
     * @return \Illuminate\Http\Response
     */
    public function show(EstablishmentShop $establishmentShop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EstablishmentShop  $establishmentShop
     * @return \Illuminate\Http\Response
     */
    public function edit(EstablishmentShop $establishmentShop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EstablishmentShop  $establishmentShop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $establishmentShop = EstablishmentShop::find($id);
        $establishmentShop->update($request->all());
        toastr()->success('Establishment Shop Updated successfully');
        return redirect()->back(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EstablishmentShop  $establishmentShop
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $establishmentShop = EstablishmentShop::find($id);
        $establishment = Establishment::find($establishmentShop->establishment_id);
        $establishment->update([
            'total_shops' => $establishment->total_shops - 1
        ]);
        $establishmentShop->delete();
        toastr()->success('Establishment Deleted successfully');
        return redirect()->back();
    }
}
