<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QrCodePayment;
use Illuminate\Http\Request;

class QrCodePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = QrCodePayment::all();
        return view('admin.qr_code_payment.index',compact('payments'));
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
     * @param  \App\Models\QrCodePayment  $qrCodePayment
     * @return \Illuminate\Http\Response
     */
    public function show(QrCodePayment $qrCodePayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QrCodePayment  $qrCodePayment
     * @return \Illuminate\Http\Response
     */
    public function edit(QrCodePayment $qrCodePayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QrCodePayment  $qrCodePayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QrCodePayment $qrCodePayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QrCodePayment  $qrCodePayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(QrCodePayment $qrCodePayment)
    {
        //
    }
}
