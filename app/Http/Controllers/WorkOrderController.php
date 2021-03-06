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
        // sorting start
        if ($request->input('order') == '') {
            $order = 'work_orders.id';
        } else {
            $order = $request->input('order');
        }

        $sort = $request->input('sort');

        if ($sort == '') {
            $sort = 'DESC';
        }

        if ($request->input('c') == '1') {
            $sort == 'ASC' ? $sort = 'DESC' : $sort = 'ASC';
        }

        if (auth()->check() && auth()->user()->personal_info == 1) {

            $i = DB::table('worker_certs')
            ->select('certificationID as cid', 'workerid as wid')
            ->where('worker_certs.workerID','=',auth()->user()->id);

            $j = DB::table('required_certs')
            ->select('cid', 'wid', 'certificationID as cid2', 'workOrderID as woid')
            ->joinSub($i,'cid',function($join) {
                $join->on('required_certs.certificationID','=','cid');
            })
            ->where('wid','=',auth()->user()->id);

            $x = DB::table('worker_tickets')
            ->where('workerID', '=', auth()->user()->id);

            $wts = DB::table('work_orders')
            ->joinSub($j, 'woid', function($join) {
                $join->on('work_orders.id','=','woid');
            })
            ->leftJoinSub($x, 'workOrderID', function($join) {
                $join->on('id', '=', 'workOrderID');
            })
            ->groupBy('work_orders.id')
            ->orderBy($order, $sort)
            ->paginate(9);

            return view('workorder.index')
            ->with('wts', $wts)
            ->with('sort', $sort)
            ->with('order', $order);
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
