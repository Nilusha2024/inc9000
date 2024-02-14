<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Job;
use App\Models\JobDepartment;
use App\Models\JobDetail;
use App\Models\Tv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cutting()
    {
        // cutting department TV screen
        $jobdetails = JobDetail::get();
        $clients = Client::get();

        // details for slide 1
        $tvdetals = Job::with(['client', 'jobdetails'])
            ->join('job_department', 'job.id', '=', 'job_department.job_id')
            ->leftJoin('job_detail', function ($join) {
                $join->on('job.id', '=', 'job_detail.job_id');
            })
            ->select('job_department.token', 'job.id', 'job.job_no', 'job.client_id', 'job.client_reference_no', 'job.job_title', 'job.material_option', 'job.job_status', 'job.order_date', 'job.deliver_date', 'job_department.start_date', 'job_department.department_status', DB::raw('sum(job_detail.qty) as qty'))
            ->where('job.record_status', '<>', 0)
            ->where('job_department.department_status', '<>', 1)
            ->where('job_department.department_id', 4) // Filter jobs for department_id = 1
            // ->where('job.job_status', '<>', 1)
            ->groupBy('job.id')
            ->orderByRaw("FIELD(job_department.department_status , '2', '0', '3', '1') ASC")
            ->orderBy('job_department.start_date')
            ->orderBy('job_department.token')
            ->get();

        // get the ongoing record for the cutting deparment
        $activeForCuttingDepartment = JobDepartment::where('department_id', 4)->where('department_status', 2)->orderBy('token', 'asc')->first();

        // get the next pending job record based on what's on the tvdetals query
        $nextPendingForCuttingDepartment = $tvdetals->first(function ($job) {
            return $job->department_status === 0;
        });

        // store active job (displaying in the tv screen) details
        $activejob = [];


        if ($activeForCuttingDepartment != null) {

            // loads the ongoing job
            $activejob = Job::with(['client', 'jobdetails'])
                ->where('job.id', $activeForCuttingDepartment->job_id)
                ->get();
        } else {
            if($nextPendingForCuttingDepartment != null){
            // if there's no ongoing jobs, load the next up pending job
            $activejob = Job::with(['client', 'jobdetails'])
                ->where('job.id', $nextPendingForCuttingDepartment->id)
                ->get();
            }
                else{
                    $activejob = ['error' => 'No pending jobs for cutting department'];
                   }
        }


        //$tvdetals = Job::with(['client','jobdetails']) ->get();
        return view('cutting')->with(['tvdetals' => $tvdetals, 'clients' => $clients, 'jobdetails' => $jobdetails, 'activejob' => $activejob, 'activeForCuttingDepartment' => $activeForCuttingDepartment, 'nextPendingForCuttingDepartment' => $nextPendingForCuttingDepartment]);
    }


    public function cutting_details()
    {

        // get job number
        $jobNo = request('job_no');

        // cutting department TV screen
        $jobdetails = JobDetail::get();
        $clients = Client::get();
        $job_department = JobDepartment::get();



        // get the job from job no from for the cutting deparment

        $activejob = Job::with(['client', 'jobdetails',])
            ->where('job.job_no', $jobNo)
            ->get();

        $activeJobDepartmentRecord = JobDepartment::where('department_id', 4)->where('job_id', $activejob[0]->id)->first();
        //dd($activeJobDepartmentRecord);



        // $activejob = Job::select('job.*', 'job_department.*', 'client.*', 'job_detail.*')
        // ->join('job_detail', 'job_detail.job_id', '=', 'job.id')
        //     ->join('job_department', 'job_department.job_id', '=', 'job.id')
        //     ->join('client', 'client.id', '=', 'job.client_id')
        //     ->where('job.job_no', $jobNo)
        //     ->get();







        //$tvdetals = Job::with(['client','jobdetails']) ->get();
        return view('cutting_details')->with(['clients' => $clients, 'jobdetails' => $jobdetails, 'activejob' => $activejob, 'activeJobDepartmentRecord' => $activeJobDepartmentRecord]);
    }



    public function designing()
    {
        // designing department TV screen
        $jobdetails = JobDetail::get();
        $clients = Client::get();

        // details for slide 1
        $tvdetals = Job::with(['client', 'jobdetails'])
            ->join('job_department', 'job.id', '=', 'job_department.job_id')
            ->leftJoin('job_detail', function ($join) {
                $join->on('job.id', '=', 'job_detail.job_id');
            })
            ->select('job_department.token', 'job.id', 'job.job_no', 'job.client_id', 'job.client_reference_no', 'job.job_title', 'job.material_option', 'job.job_status', 'job.order_date', 'job.deliver_date', 'job_department.start_date', 'job_department.department_status', DB::raw('sum(job_detail.qty) as qty'))
            ->where('job.record_status', '<>', 0)
            ->where('job_department.department_status', '<>', 1)
            ->where('job_department.department_id', 1) // Filter jobs for department_id = 1
            // ->where('job.job_status', '<>', 1)
            ->groupBy('job.id')
            ->orderByRaw("FIELD(job_department.department_status , '2', '0', '3', '1') ASC")
            ->orderBy('job_department.start_date')
            ->orderBy('job_department.token')

            ->get();

        // Get the active record for the designing department
        $activeForDesigningDepartment = JobDepartment::where('department_id', 1)
            ->where('department_status', 2)
            ->orderBy('token', 'asc')
            ->first();

        // get the next pending job record based on what's on the tvdetals query
        $nextPendingForDesigningDepartment = $tvdetals->first(function ($job) {
            return $job->department_status === 0;
        });

        // store active job (displaying in the tv screen) details
        $activejob = [];

        if ($activeForDesigningDepartment != null) {
       // load the ongoing job
            $activejob = Job::with(['client', 'jobdetails'])
                ->where('job.id', $activeForDesigningDepartment->job_id)
                ->get();
        } else {

     if($nextPendingForDesigningDepartment != null){
         // if there's no ongoing jobs, load the next up pending job
         $activejob = Job::with(['client', 'jobdetails'])
         ->where('job.id', $nextPendingForDesigningDepartment->id)
         ->get();
     }
           else{
            $activejob = ['error' => 'No pending jobs for designing department'];
           }
                
        }

        return view('designing')->with([
            'tvdetals' => $tvdetals,
            'clients' => $clients,
            'jobdetails' => $jobdetails,
            'activejob' => $activejob,
            'activeForDesigningDepartment' => $activeForDesigningDepartment,
            'nextPendingForDesigningDepartment' => $nextPendingForDesigningDepartment
        ]);
    }

    public function designing_details()
    {

        $jobNo = request('job_no');

        // cutting department TV screen
        $jobdetails = JobDetail::get();
        $clients = Client::get();
        $job_department = JobDepartment::get();



        // get the job from job no from for the cutting deparment

        $activejob = Job::with(['client', 'jobdetails',])
            ->where('job.job_no', $jobNo)
            ->get();
            //dd($activejob);


        $activeJobDepartmentRecord = JobDepartment::where('department_id', 4)->where('job_id', $activejob[0]->id)->first();
        //dd($activeJobDepartmentRecord);
        //$tvdetals = Job::with(['client','jobdetails']) ->get();
        return view('designing_details')->with(['clients' => $clients, 'jobdetails' => $jobdetails, 'activejob' => $activejob,  'activeJobDepartmentRecord' => $activeJobDepartmentRecord ]);
    }



    public function printing()
    {
        // printing department TV screen
        $jobdetails = JobDetail::get();
        $clients = Client::get();

        // details for slide 1
        $tvdetals = Job::with(['client', 'jobdetails'])
            ->join('job_department', 'job.id', '=', 'job_department.job_id')
            ->leftJoin('job_detail', function ($join) {
                $join->on('job.id', '=', 'job_detail.job_id');
            })
            ->select('job_department.token', 'job.id', 'job.job_no', 'job.client_id', 'job.client_reference_no', 'job.job_title', 'job.material_option', 'job.job_status', 'job.order_date', 'job.deliver_date', 'job_department.start_date', 'job_department.department_status', DB::raw('sum(job_detail.qty) as qty'))
            ->where('job.record_status', '<>', 0)
            ->where('job_department.department_status', '<>', 1)
            ->where('job_department.department_id', 2) // Filter jobs for department_id = 1
            // ->where('job.job_status', '<>', 1)
            ->groupBy('job.id')
            ->orderByRaw("FIELD(job_department.department_status , '2', '0', '3', '1') ASC")
            ->orderBy('job_department.start_date')
            ->orderBy('job_department.token')
            ->get();

        // get the ongoing record for the printing department
        $activeForPrintingDepartment = JobDepartment::where('department_id', 2)->where('department_status', 2)->orderBy('token', 'asc')->first();

        // get the next pending job record based on what's on the tvdetals query
        $nextPendingForPrintingDepartment = $tvdetals->first(function ($job) {
            return $job->department_status === 0;
        });

        // store active job (displaying in the tv screen) details
        $activejob = [];

        if ($activeForPrintingDepartment != null) {

            // load the ongoing job
            $activejob = Job::with(['client', 'jobdetails'])
                ->where('job.id', $activeForPrintingDepartment->job_id)
                ->get();
        } else {

            if($nextPendingForPrintingDepartment != null){
            // if there's no ongoing jobs, load the next up pending job
            $activejob = Job::with(['client', 'jobdetails'])
                ->where('job.id', $nextPendingForPrintingDepartment->id)
                ->get();
            }else{
                $activejob = ['error' => 'No pending jobs for printing department'];
               }
        }


        //$tvdetals = Job::with(['client','jobdetails']) ->get();
        return view('printing')->with(['tvdetals' => $tvdetals, 'clients' => $clients, 'jobdetails' => $jobdetails, 'activejob' => $activejob, 'activeForPrintingDepartment' => $activeForPrintingDepartment, 'nextPendingForPrintingDepartment' => $nextPendingForPrintingDepartment]);
    }

    public function printing_details()
    {

        $jobNo = request('job_no');

        // cutting department TV screen
        $jobdetails = JobDetail::get();
        $clients = Client::get();
        $job_department = JobDepartment::get();



        // get the job from job no from for the cutting deparment

        $activejob = Job::with(['client', 'jobdetails',])
            ->where('job.job_no', $jobNo)
            ->get();

        $activeJobDepartmentRecord = JobDepartment::where('department_id', 4)->where('job_id', $activejob[0]->id)->first();
        //dd($activeJobDepartmentRecord);
        //$tvdetals = Job::with(['client','jobdetails']) ->get();
        return view('printing_details')->with(['clients' => $clients, 'jobdetails' => $jobdetails, 'activejob' => $activejob,  'activeJobDepartmentRecord' => $activeJobDepartmentRecord ]);
    }



    public function sewing()
    {
        // cutting department TV screen
        $jobdetails = JobDetail::get();
        $clients = Client::get();

        // details for slide 1
        $tvdetals = Job::with(['client', 'jobdetails'])
            ->join('job_department', 'job.id', '=', 'job_department.job_id')
            ->leftJoin('job_detail', function ($join) {
                $join->on('job.id', '=', 'job_detail.job_id');
            })
            ->select('job_department.token', 'job.id', 'job.job_no', 'job.client_id', 'job.client_reference_no', 'job.job_title', 'job.material_option', 'job.job_status', 'job.order_date', 'job.deliver_date', 'job_department.start_date', 'job_department.department_status', DB::raw('sum(job_detail.qty) as qty'))
            ->where('job.record_status', '<>', 0)
            ->where('job_department.department_status', '<>', 1)
            ->where('job_department.department_id', 5) // Filter jobs for department_id = 1
            // ->where('job.job_status', '<>', 1)
            ->groupBy('job.id')
            ->orderByRaw("FIELD(job_department.department_status , '2', '0', '3', '1') ASC")
            ->orderBy('job_department.start_date')
            ->orderBy('job_department.token')
            ->get();

        // get the ongoing record for the sewing deparment
        $activeForSewingDepartment = JobDepartment::where('department_id', 5)->where('department_status', 2)->orderBy('token', 'asc')->first();

        // get the next pending job record based on what's on the tvdetals query
        $nextPendingForSewingDepartment = $tvdetals->first(function ($job) {
            return $job->department_status === 0;
        });


        // store active job (displaying in the tv screen) details
        $activejob = [];

        if ($activeForSewingDepartment != null) {

            // load the ongoing job
            $activejob = Job::with(['client', 'jobdetails'])
                ->where('job.id', $activeForSewingDepartment->job_id)
                ->get();
        } else {
            if($nextPendingForSewingDepartment != null){
            // if there's no ongoing jobs, load the next up pending job
            $activejob = Job::with(['client', 'jobdetails'])
                ->where('job.id', $nextPendingForSewingDepartment->id)
                ->get();
            }else{
                $activejob = ['error' => 'No pending jobs for sewing department'];
               }
        }

        //$tvdetals = Job::with(['client','jobdetails']) ->get();
        return view('sewing')->with(['tvdetals' => $tvdetals, 'clients' => $clients, 'jobdetails' => $jobdetails, 'activejob' => $activejob, 'activeForSewingDepartment' => $activeForSewingDepartment, 'nextPendingForSewingDepartment' => $nextPendingForSewingDepartment]);
    }

    public function sewing_details()
    {
        $jobNo = request('job_no');

        // cutting department TV screen
        $jobdetails = JobDetail::get();
        $clients = Client::get();
        $job_department = JobDepartment::get();



        // get the job from job no from for the cutting deparment

        $activejob = Job::with(['client', 'jobdetails',])
            ->where('job.job_no', $jobNo)
            ->get();
            

        $activeJobDepartmentRecord = JobDepartment::where('department_id', 4)->where('job_id', $activejob[0]->id)->first();
        //dd($activeJobDepartmentRecord);
        //$tvdetals = Job::with(['client','jobdetails']) ->get();
        return view('sewing_details')->with(['clients' => $clients, 'jobdetails' => $jobdetails, 'activejob' => $activejob,  'activeJobDepartmentRecord' => $activeJobDepartmentRecord ]);
       
    }



    public function pressing()
    {
        // cutting department TV screen
        $jobdetails = JobDetail::get();
        $clients = Client::get();

        // details for slide 1
        $tvdetals = Job::with(['client', 'jobdetails'])
            ->join('job_department', 'job.id', '=', 'job_department.job_id')
            ->leftJoin('job_detail', function ($join) {
                $join->on('job.id', '=', 'job_detail.job_id');
            })
            ->select('job_department.token', 'job.id', 'job.job_no', 'job.client_id', 'job.client_reference_no', 'job.job_title', 'job.material_option', 'job.job_status', 'job.order_date', 'job.deliver_date', 'job_department.start_date', 'job_department.department_status', DB::raw('sum(job_detail.qty) as qty'))
            ->where('job.record_status', '<>', 0)
            ->where('job_department.department_status', '<>', 1)
            ->where('job_department.department_id', 3) // Filter jobs for department_id = 1
            // ->where('job.job_status', '<>', 1)
            ->groupBy('job.id')
            ->orderByRaw("FIELD(job_department.department_status , '2', '0', '3', '1') ASC")
            ->orderBy('job_department.start_date')
            ->orderBy('job_department.token')
            ->get();

        // get the ongoing record for the pressing deparment
        $activeForPressingDepartment = JobDepartment::where('department_id', 3)->where('department_status', 2)->orderBy('token', 'asc')->first();

        // get the next pending job record based on what's on the tvdetals query
        $nextPendingForPressingDepartment = $tvdetals->first(function ($job) {
            return $job->department_status === 0;
        });


        // store active job (displaying in the tv screen) details
        $activejob = [];


        if ($activeForPressingDepartment != null) {

            // load the ongoing job
            $activejob = Job::with(['client', 'jobdetails'])
                ->where('job.id', $activeForPressingDepartment->job_id)
                ->get();
        } else {
            if($nextPendingForPressingDepartment != null){   
            // if there's no ongoing jobs, load the next up pending job
            $activejob = Job::with(['client', 'jobdetails'])
                ->where('job.id', $nextPendingForPressingDepartment->id)
                ->get();
            }else{
                $activejob = ['error' => 'No pending jobs for pressing department'];
               }
        }


        //$tvdetals = Job::with(['client','jobdetails']) ->get();
        return view('pressing')->with(['tvdetals' => $tvdetals, 'clients' => $clients, 'jobdetails' => $jobdetails, 'activejob' => $activejob, 'activeForPressingDepartment' => $activeForPressingDepartment, 'nextPendingForPressingDepartment' => $nextPendingForPressingDepartment]);
    }

    public function pressing_details()
    {

        $jobNo = request('job_no');

        // cutting department TV screen
        $jobdetails = JobDetail::get();
        $clients = Client::get();
        $job_department = JobDepartment::get();



        // get the job from job no from for the cutting deparment

        $activejob = Job::with(['client', 'jobdetails',])
            ->where('job.job_no', $jobNo)
            ->get();

        $activeJobDepartmentRecord = JobDepartment::where('department_id', 4)->where('job_id', $activejob[0]->id)->first();
        //dd($activeJobDepartmentRecord);
        //$tvdetals = Job::with(['client','jobdetails']) ->get();
        return view('pressing_details')->with(['clients' => $clients, 'jobdetails' => $jobdetails, 'activejob' => $activejob,  'activeJobDepartmentRecord' => $activeJobDepartmentRecord ]);
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