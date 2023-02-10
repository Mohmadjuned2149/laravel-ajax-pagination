<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employees;

class EmployeeController extends Controller
{
    public function getData()
    {
        $employee = employees::orderBy('id', 'ASC')->take(10)->get();
        return view('employees', compact('employee'));
    }

    public function getAjaxData(Request $request)
    {
        $ofsset = ($request->page_no - 1) * $request->records_per_page;
        $employee = employees::orderBy('id', 'ASC')->skip($ofsset)->take($request->records_per_page)->get();
        return response()->json([
            'data' => $employee
        ]);
    }

    public function getTotalData(Request $request)
    {
        $employee = employees::all();
        $total_records = count($employee);
        return response()->json([
            'total' => $total_records
        ]);
    }
    public function loadMore()
    {
        $employee = employees::orderBy('id', 'ASC')->take(10)->get();
        return view('loadmore', compact('employee'));
    }
    public function infiniteLoad()
    {
        $employee = employees::orderBy('id', 'ASC')->take(10)->get();
        return view('infiniteload', compact('employee'));
    }

    public function getLoadMore(Request $request)
    {
        $employee = employees::orderBy('id', 'ASC')->take($request->last_record)->get();
        return response()->json([
            'data' => $employee
        ]);
    }


}