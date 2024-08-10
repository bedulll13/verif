<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class ScanController extends Controller
{
    public function index($cust){
        $customer= Customer::where('code',$cust)->first();
        return view('scan', compact('customer'));
    }
}
