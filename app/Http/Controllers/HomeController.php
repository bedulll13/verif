<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Log;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('welcome', compact('users'));
    }

    public function login_get()
    {
        return view('login');
    }

    public function login_post(Request $request, $cust)
    {
        $customer = Customer::where('code', $cust)->first();

        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $check = Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ]);

        if (!$check) {
            return redirect()->back()->withInput()->with('error', 'Login gagal. Username atau password salah.');
        }

        $user = auth()->user();

        // Redirect berdasarkan jabatan
        switch ($user->jabatan) {
            case 'operator':
                return redirect("/$cust/dashboards/scan");
            case 'admin':
            case 'manager':
            case 'staff':
                return redirect("/$cust/dashboards");
            default:
                return redirect('/')->with('error', 'Jabatan tidak dikenali.');
        }
    }

    public function logout_post($cust)
    {
        Auth::logout();
        return redirect('/');
    }

    public function upload(Request $request, $customer)
    {
        $filename = 'test.xlsx';
        $relativePath = 'private/uploads/' . $filename;

        if (Storage::exists($relativePath)) {
            $file = $request->file('file');
            $file->storeAs('private/uploads', $filename);
        }

        return redirect("/$customer/dashboards");
    }

    public function dashboards($customer)
    {
        $filename = 'test.xlsx';
        $relativePath = 'private/uploads/' . $filename;

        if (!Storage::exists($relativePath)) {
            return view('dashboards')->with('message', 'Belum ada file yang di-upload.');
        }

        $reader = new Xlsx();
        $reader->setReadDataOnly(false);
        $spreadsheet = $reader->load(storage_path('app/' . $relativePath));
        $sheet = $spreadsheet->getActiveSheet();
        $highestRow = $sheet->getHighestDataRow();

        $totalItem = 0;
        $dnGroups = [];
        $lastDn = null;

        for ($row = 2; $row <= $highestRow; $row++) {
            $partId = trim($sheet->getCell("H$row")->getValue());
            $dnRaw = trim($sheet->getCell("L$row")->getValue());
            $qty_kbn = intval($sheet->getCell("O$row")->getValue());
            $del_cycle = intval($sheet->getCell("P$row")->getValue());

            $dn = !empty($dnRaw) ? $dnRaw : $lastDn;
            if (!$dn) continue;

            $lastDn = $dn;

            if (!isset($dnGroups[$dn])) {
                $dnGroups[$dn] = [
                    'cycle' => $del_cycle,
                    'parts' => [],
                    'qty_map' => [],
                    'item_count' => 0,
                ];
            }

            $dnGroups[$dn]['cycle'] = min($dnGroups[$dn]['cycle'], $del_cycle ?: PHP_INT_MAX);
            $dnGroups[$dn]['parts'][] = $partId;
            $dnGroups[$dn]['qty_map'][$partId] = ($dnGroups[$dn]['qty_map'][$partId] ?? 0) + $qty_kbn;
            $dnGroups[$dn]['item_count']++;
            $totalItem++;
        }

        // Sort DN by delivery cycle
        uksort($dnGroups, function ($a, $b) use ($dnGroups) {
            return $dnGroups[$a]['cycle'] <=> $dnGroups[$b]['cycle'];
        });

        // Ambil semua log verifikasi hari ini
        $logToday = Log::whereDate('created_at', Carbon::today())->get();

        $logPoOpen = [];
        $scanPoClose = 0;

        foreach ($dnGroups as $dn => $data) {
            $parts = $data['parts'];
            $qtyMap = $data['qty_map'];
            $itemCount = $data['item_count'];

            $scannedCount = 0;
            $details = [];

            foreach ($qtyMap as $partId => $qtyKbn) {
                $normalizedPrefix = str_replace('-', '', $dn . $partId); // DN + PartID

                // Hitung jumlah scan hari ini berdasarkan DN + PartID
                $matchedScanCount = $logToday->filter(function ($log) use ($normalizedPrefix) {
                    $normalizedLogPart = str_replace('-', '', $log->partid_customer);
                    return strpos($normalizedLogPart, $normalizedPrefix) !== false;
                })->count();

                $actualScanned = min($qtyKbn, $matchedScanCount);

                $details[] = [
                    'order_no' => $partId,
                    'qty_kbn' => $qtyKbn,
                    'belum_discanned' => $qtyKbn - $actualScanned,
                ];

                $scannedCount += $actualScanned;
            }

            $unscanned = 0;
            foreach ($details as $d) {
                $unscanned += $d['belum_discanned'];
            }

            $status = $unscanned === 0 ? 'CLOSE' : 'OPEN';

            if ($status === 'CLOSE') {
                $scanPoClose++;
            }

            $logPoOpen[] = [
                'dn' => $dn,
                'tanggal' => Carbon::today()->format('d-m-Y'),
                'total_item' => $itemCount,
                'item_belum_scan' => $unscanned,
                'cycle' => $data['cycle'] ?? 0,
                'status' => $status,
                'details' => $details,
            ];
        }

        $scanPoOpen = count($dnGroups) - $scanPoClose;
        $totalDN = count($dnGroups);

        return view('dashboards', compact(
            'totalItem',
            'scanPoOpen',
            'scanPoClose',
            'logPoOpen',
            'totalDN'
        ));
    }
    public function show_dn($dn)
    {
        $log = Log::where('order_no', $dn)->get();
        dd($log);
    }
}
