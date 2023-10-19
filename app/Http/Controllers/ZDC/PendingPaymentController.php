<?php

namespace App\Http\Controllers\ZDC;

use App\Http\Controllers\Controller;
use App\Models\PendingPayment;
use Exception;
use Illuminate\Http\Request;

class PendingPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('zdc.pending_payment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('zdc.pending_payment.create');
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
                'shop_id' => 'required',
            ]);
            PendingPayment::create($request->all());

            toastr()->success('Pending Payment Added Successfully');
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
     * @param  \App\Models\PendingPayment  $pendingPayment
     * @return \Illuminate\Http\Response
     */
    public function show(PendingPayment $pendingPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PendingPayment  $pendingPayment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pending_payment = PendingPayment::find($id);
        return view('zdc.pending_payment.edit',compact('pending_payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PendingPayment  $pendingPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $pendingPayment = PendingPayment::find($id);
        $pendingPayment->update($request->all());
        toastr()->success('Pending Payment Updated successfully');
        return redirect()->back(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PendingPayment  $pendingPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pendingPayment = PendingPayment::find($id);
        $pendingPayment->delete();
        toastr()->success('Pending Payment Deleted successfully');
        return redirect()->back();
    }
}
