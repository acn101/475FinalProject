<?php

namespace App\Http\Controllers;

use App\WorkOrder;
use Illuminate\Http\Request;

use DB;

class WorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->check() && auth()->user()->personal_info == 1) {
            $x = DB::table('worker_tickets')
            ->where('workerID', '=', auth()->user()->id);

            $wts = DB::table('work_orders')
            ->leftJoinSub($x, 'workOrderID', function($join) {
                $join->on('id', '=', 'workOrderID');
            })
            ->orderby('id')
            ->get();

            return view('workorder.index')
            ->with('wts', $wts);
        } else {
            return view ('worker.index');
        }
    }
}
