<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PersonalInfo;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->personal_info == 1) {
            $pi = PersonalInfo::find(\App\Worker::find(auth()->user()->id)->personalInfoID);

            return view ('worker.index')
            ->with('pi', $pi);
        } else {
            return view ('worker.index');
        }
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
        $pi = new PersonalInfo;
        $pi->firstName = $request->firstName;
        $pi->middleName = $request->middleName;
        $pi->lastName = $request->lastName;
        $pi->primaryNumber = $request->primaryNumber;
        $pi->secondaryNumber = $request->secondaryNumber;
        $pi->address = $request->address;
        $pi->email = $request->email;
        $pi->save();

        $w = new \App\Worker;
        $w->ID = auth()->user()->id;
        $w->personalInfoID = $pi->id;
        $w->statusID = 1;
        $w->save();

        $user = auth()->user();
        $user->personal_info = 1;
        $user->save();

        return redirect('/worker');
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
    public function edit($id)
    {
        $pi = PersonalInfo::find(\App\Worker::find(auth()->user()->id)->personalInfoID);
        return view('worker.edit')
        ->with('pi', $pi);
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
        $pi = PersonalInfo::find(\App\Worker::find(auth()->user()->id)->personalInfoID);
        $pi->firstName = $request->firstName;
        $pi->middleName = $request->middleName;
        $pi->lastName = $request->lastName;
        $pi->primaryNumber = $request->primaryNumber;
        $pi->secondaryNumber = $request->secondaryNumber;
        $pi->address = $request->address;
        $pi->email = $request->email;
        $pi->save();
        
        return redirect('/worker');
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
