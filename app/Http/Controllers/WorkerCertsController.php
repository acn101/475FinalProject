<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class WorkerCertsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Worker $id)
    {
        $cs = \App\Certification::all();

        $x = DB::table('worker_certs')
        ->where('workerID', '=', $id->id);

        $wcs = DB::table('certifications')
        ->leftJoinSub($x, 'certificationID', function($join) {
            $join->on('id', '=', 'certificationID');
        })
        ->orderBy('description')
        ->get();

        return view('workercerts.edit')
        ->with('cs', $cs)
        ->with('wcs', $wcs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $x = DB::table('worker_certs')
        ->where('workerID', '=', $id);

        $wcs = DB::table('certifications')
        ->leftJoinSub($x, 'certificationID', function($join) {
            $join->on('id', '=', 'certificationID');
        })
        ->orderBy('description')
        ->get();

        if (!is_null($wcs->where('certificationID', $request->cert)->first())) {
            $wc = DB::table('worker_certs')
            ->where('workerID', '=', $id)
            ->where('certificationID', '=', $request->cert);
            $wc->delete();
        } else {
            $wc = new \App\WorkerCerts;
            $wc->certificationID = $request->cert;
            $wc->workerID = $id;
            $wc->timestamps = false;
            $wc->save();
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
