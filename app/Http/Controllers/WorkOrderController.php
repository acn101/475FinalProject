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
    public function index(Request $request)
    {
        $order = $request->input('order');
        $sort = $request->input('sort');

        $sort == 'ASC' ? $sort ='DESC' : $sort = 'ASC';

        if (auth()->check() && auth()->user()->personal_info == 1) {
            $x = DB::table('worker_tickets')
            ->where('workerID', '=', auth()->user()->id);

            $wts = DB::table('work_orders')
            ->leftJoinSub($x, 'workOrderID', function($join) {
                $join->on('id', '=', 'workOrderID');
            })
            ->orderby($order, $sort)
            ->paginate(9);

            return view('workorder.index')
            ->with('wts', $wts)
            ->with('sort', $sort);
        } else {
            return view ('worker.index');
        }
    }

    public function job(WorkOrder $id) {
        if (auth()->check() && auth()->user()->personal_info == 1) {
            $x = DB::table('work_orders')
            ->join('job_sites', 'job_sites.id', '=', 'jobSiteID')
            ->where('work_orders.id', '=', $id->id)
            ->first();

            $y = DB::table('worker_tickets')
            ->where('workOrderID', '=', $id->id)
            ->where('workerID', '=', auth()->user()->id)
            ->get();

            return view ('workorder.job')
            ->with('id', $id)
            ->with('x', $x)
            ->with('y', $y);
        }  else {
            return redirect('/register');
        }
    }
}
