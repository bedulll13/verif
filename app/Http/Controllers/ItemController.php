<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class ItemController extends Controller
{
    public function index($cust)
    {
        $customer = Customer::where('code', $cust)->first();
        $items = Item::where('customer_id', $customer->id)->get();
        return view('item', compact('items', 'customer'));
    }
    public function create($cust)
    {
        $customer = Customer::where('code', $cust)->first();
        return view('item.create', compact('customer'));
    }
    public function store(Request $request, $cust)
    {
        $customer = Customer::where('code', $cust)->first();
        $code = explode("/", $request->path())[0];
        $image = $request->file('file_name');
        $image->move(public_path() . "/images/$request->part_no", "images.png");

        if ($code == 'adm') {
            Item::create([
                'part_id' => $request->part_no,
                'part_name' => $request->part_name,
                'qty' => $request->part_qty,
                'file_name' => "images/$request->part_no/images.png",
                'customer_id' => $customer->id,
                'job_no' => $request->job_no,
            ]);
        } else {
            Item::create([
                'part_id' => $request->part_no,
                'part_name' => $request->part_name,
                'qty' => $request->part_qty,
                'file_name' => "images/$request->part_no/images.png",
                'customer_id' => $customer->id,
            ]);
        }
        return redirect("/$code/dashboards/item");
    }
    public function edit($cust, $partno)
    {
        $item = Item::where('part_id', $partno)->first();
        $customer = Customer::where('code', $cust)->firstZ();

        return view('item.edit', compact('item', 'customer'));
    }
    public function destroy(Request $request, $cust, $partno)
    {
        $item = Item::where('part_id', $partno)->first();
        $item->delete();
        $code = explode("/", $request->path())[0];

        return redirect("/$code/dashboards/item");
    }

    public function update(Request $request, $cust, $partno)
    {
        $item = Item::where('part_id', $partno)->first();
        $item->update($request->all());

        $code = explode("/", $request->path())[0];
        return redirect("/$code/dashboards/item");
    }


    public function show_part($partno)
    {
        $item = Item::where('part_id', $partno)->first();

        if(!$item) {
            return response()->json([
                'message' => 'not found'
            ], 404);
        }

        return response()->json([
            'id' => $item->id,
            'part_id' => $item->part_id,
            'part_name' => $item->part_name,
            'file_name' => asset($item->file_name),
            'qty' => $item->qty,
        ]);
    }

    public function check($partid, $itemid)
    {
        $part_cust = Item::where('part_id', $partid)->first();
        $part_metindo = Item::where('part_id', $itemid)->first();

        if (!$part_cust || !$part_metindo) {
            Log::create([
                "item_metindo" => "",
                "item_customer" => $part_metindo->part_name,
                "partid_metindo" => $partid,
                "partid_customer" => $itemid,
                "qty_metindo" => "",
                "qty_customer" => $part_metindo->qty,
                "status_metindo" => "NG",
                "status_customer" => "NG",
                "hasil" => "NG",
                "my_date" => Date::now(),
                "customer_id" => $part_cust->customer_id,
                "jobno_metindo" => null,
                "jobno_customer" => null,
        ]);
        } elseif (!$part_metindo) {
            Log::create([
                "item_metindo" => "",
                "item_customer" => $part_metindo->part_name,
                "partid_metindo" => $partid,
                "partid_customer" => $itemid,
                "qty_metindo" => "",
                "qty_customer" => $part_metindo->qty,
                "status_metindo" => "NG",
                "status_customer" => "NG",
                "hasil" => "NG",
                "my_date" => Date::now(),
                "customer_id" => $part_cust->customer_id,
                "jobno_metindo" => null,
                "jobno_customer" => null,
            ]);
        } else {
            if ($partid != $itemid) {
                $hasil = "NG";
                Log::create([
                    "item_metindo" => $part_cust->part_name ?? "",
                    "item_customer" => $part_metindo->part_name  ?? "",
                    "partid_metindo" => $partid,
                    "partid_customer" => $itemid,
                    "qty_metindo" => $part_cust->qty,
                    "qty_customer" => $part_metindo->qty,
                    "status_metindo" => "NG",
                    "status_customer" => "NG",
                    "hasil" => "NG",
                    "my_date" => Date::now(),
                    "customer_id" => $part_cust->customer_id,
                    "jobno_metindo" => null,
                    "jobno_customer" => null,
                ]);
            } else {
                $hasil = "OK";
                Log::create([
                    "item_metindo" => $part_cust->part_name,
                    "item_customer" => $part_metindo->part_name,
                    "partid_metindo" => $partid,
                    "partid_customer" => $itemid,
                    "qty_metindo" => $part_cust->qty,
                    "qty_customer" => $part_metindo->qty,
                    "status_metindo" => $hasil,
                    "status_customer" => $hasil,
                    "hasil" => $hasil,
                    "my_date" => Date::now(),
                    "customer_id" => $part_cust->customer_id,
                    "jobno_metindo" => null,
                    "jobno_customer" => null,
                ]);
            }
        }

        return response()->json([
            "message" => "Check complete",

        ]);
    }
}
