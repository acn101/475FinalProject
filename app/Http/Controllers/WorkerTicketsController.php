<?php

namespace App\Http\Controllers;

use App\WorkerTickets;
use Illuminate\Http\Request;

use DB;

class WorkerTicketsController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkerTickets  $workerTickets
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $x = DB::table('worker_tickets')
        ->where('workerID', '=', $id);

        $wts = DB::table('work_orders')
        ->leftJoinSub($x, 'workOrderID', function($join) {
            $join->on('id', '=', 'workOrderID');
        })
        ->get();

        if (!is_null($wts->where('workOrderID', $request->ticket)->first())) {
            $wt = DB::table('worker_tickets')
            ->where('workerID', '=', $id)
            ->where('workOrderID', '=', $request->ticket);
            $wt->delete();

            $wod = \App\WorkOrder::find($request->ticket);
            $wod->demandFilled--;
            $wod->save();
        } else {
            $wt = new WorkerTickets;
            $wt->workOrderID = $request->ticket;
            $wt->workerID = $id;
            $wt->timestamps = false;
            $wt->save();

            $wod = \App\WorkOrder::find($request->ticket);
            $wod->demandFilled++;
            $wod->save();
        }

        return back();
    }
}
