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

    public function getLoadMore(Request $request)
    {
        if ($request->search != "") {
            $employee = employees::orderBy('id', 'ASC')
                ->where('id', 'like', '%' . $request->search . '%')
                ->orWhere('firstname', 'like', '%' . $request->search . '%')
                ->orWhere('lastname', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->get();
        } else {
            if ($request->last_record) {
                $last_record = $request->last_record;
            } else {
                $last_record = 10;
            }

            $employee = employees::orderBy('id', 'ASC')->take($last_record)->get();
        }
        return response()->json([
            'data' => $employee
        ]);
    }

    public function infiniteLoad()
    {
        $employee = employees::orderBy('id', 'ASC')->take(20)->get();
        return view('infiniteload', compact('employee'));
    }

    public function getInfiniteLoadData(Request $request)
    {

        if ($request->search != "") {
            $employee = employees::orderBy('id', 'ASC')
                ->where('id', 'like', '%' . $request->search . '%')
                ->orWhere('firstname', 'like', '%' . $request->search . '%')
                ->orWhere('lastname', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->get();
        } else {
            if ($request->page) {
                $limit = $request->page * 10;
            } else {
                $limit = 20;
            }

            $employee = employees::orderBy('id', 'ASC')->take($limit)->get();
        }
        return response()->json([
            'data' => $employee
        ]);
    }


}