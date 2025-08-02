<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index($cust, Request $request)
    {
        $customer = Customer::where('code', $cust)->first();
        $perPage = $request->get('itemsPerPage', 10);
        $items = Item::where('customer_id', $customer->id)->paginate($perPage);
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

        Item::create([
            'part_id' => $request->part_no,
            'part_name' => $request->part_name,
            'qty' => $request->part_qty,
            'file_name' => "images/$request->part_no/images.png",
            'customer_id' => $customer->id,
            'job_no' => $code == 'adm' ? $request->job_no : null,
        ]);

        return redirect("/$code/dashboards/item");
    }

    public function edit($cust, $partno)
    {
        $item = Item::where('part_id', $partno)->first();
        $customer = Customer::where('code', $cust)->first();
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
        preg_match('/([A-Z]{2,})-?(\d{4})/', $partno, $matches);
        $gtCode = $matches[1] ?? null;
        $productCode = $matches[2] ?? null;

        if (!$gtCode || !$productCode) {
            return response()->json([
                'message' => 'GT atau kode produk tidak ditemukan dalam format yang valid.'
            ], 422);
        }

        $item = Item::where('part_id', 'LIKE', "%{$gtCode}%")
            ->where('part_id', 'LIKE', "%{$productCode}%")
            ->first();

        if (!$item) {
            return response()->json([
                'message' => 'Part dengan GT dan kode produk tidak ditemukan.'
            ], 404);
        }

        $existsInLogToday = Log::where('partid_customer', $item->part_id)
            ->whereDate('created_at', Carbon::today())
            ->exists();

        if ($existsInLogToday) {
            return response()->json(-1);
        }

        return response()->json([
            'id' => $item->id,
            'part_id' => $item->part_id,
            'part_name' => $item->part_name,
            'file_name' => asset($item->file_name),
            'qty' => $item->qty,
        ]);
    }

    public function check_yimm($partid, $itemid, $fullpartid)
    {
        $part_cust = Item::where('part_id', 'LIKE', "%{$partid}%")->first();
        $part_metindo = Item::where('part_id', 'LIKE', "%{$itemid}%")->first();

        $this->logItemComparison($part_cust, $part_metindo, $partid, $itemid, $fullpartid, "");
    }

    public function check($cust, $partid, $itemid, $fullpartid, $fullitemid)
    {
        $customer = Customer::firstWhere('code', $cust);

        preg_match('/([A-Z]{2,})-?(\d{4})/', $partid, $matches);
        $prefix = $matches[1] ?? null;
        $code = $matches[2] ?? null;

        if (!$prefix || !$code) {
            return response()->json([
                'status' => 'invalid_format',
                'message' => 'Prefix huruf dan 4 digit angka tidak ditemukan.'
            ], 422);
        }

        $search = "{$prefix}-{$code}";
        $partItem = Item::where('part_id', 'LIKE', "%$search%")->first();

        if (!$partItem) {
            return response()->json([
                'status' => 'not_found',
                'message' => "Part dengan substring $search tidak ditemukan."
            ], 404);
        }

        // ✅ Ganti pengecekan ke fullitemid, bukan hanya $partid
        $alreadyScanned = Log::where('partid_customer', $fullitemid)
            ->whereDate('created_at', Carbon::today())
            ->exists();

        if ($alreadyScanned) {
            return response()->json([
                'status' => 'already_scanned',
                'message' => 'Part ini sudah dicek hari ini.'
            ], 488);
        }

        $this->logItemComparison($partItem, $partItem, $partid, $itemid, $fullpartid, $fullitemid);

        return response()->json([
            'status' => 'ok',
            'message' => 'Part diverifikasi dan dicatat.'
        ]);
    }

    private function logItemComparison($part_cust, $part_metindo, $partid, $itemid, $fullpartid, $fullitemid)
    {
        $status = "NG";
        $item_metindo_name = $part_metindo->part_name ?? "";
        $item_customer_name = $part_cust->part_name ?? "";
        $qty_metindo = $part_metindo->qty ?? "";
        $qty_customer = $part_cust->qty ?? "";
        $customer_id = Customer::firstWhere('code', request()->segment(2))->id ?? null;

        if ($fullpartid) {
            $yimm_user = substr($fullpartid, 32, 4) ?? null;
            $yimm_order_no = substr($fullpartid, 38, 4) ?? null;
        }

        if ($part_cust && $part_metindo) {
            $normalized_partid = preg_replace('/-(\d{3})$/', '$1', $partid);
            $normalized_itemid = preg_replace('/-(\d{3})$/', '$1', $itemid);

            if ($normalized_partid === $normalized_itemid) {
                $status = "OK";
            }
        }

        $log = new Log();
        $log["item_metindo"] = $item_metindo_name;
        $log["item_customer"] = $item_customer_name;
        $log["partid_metindo"] = $fullpartid;
        $log["partid_customer"] = $fullitemid;
        $log["qty_metindo"] = $qty_metindo;
        $log["qty_customer"] = $qty_customer;
        $log["status_metindo"] = $status;
        $log["status_customer"] = $status;
        $log["hasil"] = $status;
        $log["my_date"] = now();
        $log["customer_id"] = $customer_id;
        $log["jobno_metindo"] = null;
        $log["jobno_customer"] = null;
        $log["order_no"] = $yimm_order_no ?? null;
        $log["user"] = $yimm_user ?? null;
        $log->save();
    }
}
