<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class LogController extends Controller
{
    public function index($cust){
        $customer = Customer::where('code', $cust)->first();
        $logs = Log::where('customer_id', $customer->id)->paginate(10);
        return view('log', compact('logs', 'customer'));
    }

    public function store($cust) {
        $customer = Customer::where('code', $cust)->first();

        return Log::create([
            "item_metindo" => "",
            "item_customer" => "",
            "partid_metindo" => "",
            "partid_customer" =>"",
            "qty_metindo" => "",
            "qty_customer" => "s",
            "status_metindo" => "NG",
            "status_customer" => "NG",
            "hasil" => "NG",
            "my_date" => Date::now(),
            "customer_id" => 1,
            "jobno_metindo" => null,
            "jobno_customer" => null,

        ]);
    }
}
