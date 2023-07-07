<?php

namespace App\Http\Controllers;

use App\Helpers\PaymentGateway;
use Exception;
use Illuminate\Http\Request;

class CronjobController extends Controller
{
    public function getPayments()
    {        
        try{
            PaymentGateway::storePayments();
            toastr()->success('Payment Add  Successfully');
            return redirect()->back();
        }catch (Exception $e)
        {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }
}
