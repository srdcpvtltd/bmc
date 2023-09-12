<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Establishment;
use App\Models\EstablishmentShop;
use Exception;
use Illuminate\Http\Request;

class EstablishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.establishment.index');
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
                'name' => 'required',
                'establishment_category_id' => 'required',
                'establishment_zone_id'=>'required',
            ]);
            $establishment = Establishment::create($request->all());
            foreach($request->shop_number as $key => $shop_number)
            {
                EstablishmentShop::create([
                    'shop_number' => $shop_number,
                    'shop_type' => $request->shop_type[$key],
                    'shop_size' => $request->shop_size[$key],
                    'shop_rent' => $request->shop_rent[$key],
                    'establishment_id' => $establishment->id,
                ]);
            }
            toastr()->success('Establishment Added Successfully');
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
     * @param  \App\Models\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function show(Establishment $establishment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $establishment = Establishment::find($id);
        $establishment_shops = EstablishmentShop::where('establishment_id',$establishment->id)->get();
        return view('admin.establishment.edit',compact('establishment','establishment_shops'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $establishment = Establishment::find($id);
        $establishment->update($request->all());
        toastr()->success('Establishment Updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $establishment = Establishment::find($id);
        $establishment->delete();
        toastr()->success('Establishment Deleted successfully');
        return redirect()->back();
    }
}
