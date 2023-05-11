<?php

namespace App\Http\Controllers;

use App\Models\Tv;
use Illuminate\Support\Facades\DB;
use App\Models\Job;
use App\Models\Client;
use App\Models\JobDepartment;
use App\Models\JobDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // cutting department TV screen
        $jobdetails = JobDetail::get();
        $clients = Client::get();

        // get the ongoing record for the cutting deparment (change the department id for different departments)
        $activeForCuttingDepartment = JobDepartment::where('department_id', 4)->where('department_status', 2)->orderBy('id','Desc')->first();

        // gets job based on the job status
        // $activejob = Job::with(['client', 'jobdetails'])->where('job.job_status', 2)->get();

        // gets job based on the active record of the cutting department
        $activejob = Job::with(['client', 'jobdetails'])->where('job.id', $activeForCuttingDepartment->job_id)->get();


        $tvdetals = Job::with(['client', 'jobdetails'])->leftJoin('job_detail', function ($join) {
            $join->on('job.id', '=', 'job_detail.job_id');
        })
            ->select('job.id', 'job.job_no', 'job.client_id', 'job.client_reference_no', 'job.job_title', 'job.material_option', 'job.job_status', 'job.order_date', 'job.deliver_date', DB::raw('sum(job_detail.qty) as qty'))
            ->groupBy('job.id')
            ->get();
        //$tvdetals = Job::with(['client','jobdetails']) ->get();
        return view('designing')->with(['tvdetals' => $tvdetals, 'clients' => $clients, 'jobdetails' => $jobdetails, 'activejob' => $activejob]);
    }

    /**
     *
     * |11112
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
     * @param  \App\Models\Tv  $tv
     * @return \Illuminate\Http\Response
     */
    public function show(Tv $tv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tv  $tv
     * @return \Illuminate\Http\Response
     */
    public function edit(Tv $tv)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tv  $tv
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tv $tv)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tv  $tv
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tv $tv)
    {
        //
    }
}
