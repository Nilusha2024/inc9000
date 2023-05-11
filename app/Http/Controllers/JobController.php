<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Department;
use App\Models\Job;
use App\Models\JobActivity;
use App\Models\JobDepartment;
use App\Models\JobDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Auth;

class JobController extends Controller
{
    // return job view
    public function index()
    {
        // set up has many
        $jobs = Job::get();

        // Test out the aggregration with the join
        // $jobsAlt = Job::with('styles')->leftJoin('job_detail', function ($join) {
        //     $join->on('job.id', '=', 'job_detail.job_id');
        // })
        //     ->select('job.id', 'job.client_id', 'job.job_title', 'job.job_status', 'job.order_date', 'job.deliver_date', DB::raw('sum(job_detail.qty) as qty'))
        //     ->groupBy('job.id')
        //     ->get();

        return view('job')->with(['jobs' => $jobs]);
    }

    // return job details view
    public function details()
    {

        $jobId = request('job');
        $job = Job::find($jobId);


        $styleDetailRecords = JobDetail::where('job_id', $jobId)->get();
        $departmentDetailRecords = JobDepartment::where('job_id', $jobId)->get();

        return view('job-details')->with(['job' => $job, 'styleDetailRecords' => $styleDetailRecords, 'departmentDetailRecords' => $departmentDetailRecords]);
    }

    // return create job view
    public function create()
    {
        $jobs = Job::get();
        $clients = Client::get();

        return view('job-create')->with(['jobs' => $jobs, 'clients' => $clients]);
    }

    // insert job
    public function store(Request $request)
    {

        try {
            $user = Auth::user();

            // Job insert :
            $job = Job::create([
                'job_no' => $request->input('job_no'),
                'job_title' => $request->input('job_title'),
                'client_id' => $request->input('job_client'),
                'client_reference_no' => $request->input('job_client_ref'),
                'material_option' => $request->input('job_material_option'),
                'order_date' => $request->input('job_order_date'),
                'deliver_date' => $request->input('job_deliver_date'),
                'comment' => $request->input('job_comment'),
                'packing' => $request->input('job_packing'),
                'job_status' => 0,
            ]);

          
            // Job design image insert : image 1

            if ($request->hasFile('job_design_image_1')) {

                $file = $request->file('job_design_image_1');
                $extention = $file->getClientOriginalExtension();
                $filename = time() . '-1' . '.' . $extention;
                $file->move('uploads/jobs/', $filename);
                $job->job_design_image_1 = $filename;

                $job->save();
            }


            // Job design image insert : image 2

            if ($request->hasFile('job_design_image_2')) {

                $file = $request->file('job_design_image_2');
                $extention = $file->getClientOriginalExtension();
                $filename = time() . '-2' . '.' . $extention;
                $file->move('uploads/jobs/', $filename);
                $job->job_design_image_2 = $filename;

                $job->save();
            }

            // Job detail insert : insert styles information related to the job
            $jobId = $job->id;

            $categories = explode(",", $request->input('style_categories'));
            $designs = explode(",", $request->input('style_designs'));
            $sleeves = explode(",", $request->input('style_sleeves'));
            $sizes = explode(",", $request->input('style_sizes'));
            $necks = explode(",", $request->input('style_necks'));
            $qtys = explode(",", $request->input('style_qtys'));

            JobActivity::create([
                'job_id' => $jobId, 
                'department_id' => 4,
                'employee_id' => $user->id
            ]);

            for ($i = 0; $i < count($designs); $i++) {
                JobDetail::create([
                    'job_id' => $jobId,
                    'category' => $categories[$i],
                    'design' => $designs[$i],
                    'sleeve' => $sleeves[$i],
                    'neck_type' => $necks[$i],
                    'size' => $sizes[$i],
                    'qty' => $qtys[$i],
                ]);
            }

            // Job department insert : insert in department information related to the job

            $markedDeparments = explode(",", $request->input('marked_departments'));
            $markedStarDates = explode(",", $request->input('marked_start_dates'));
            $markedEndDates = explode(",", $request->input('marked_end_dates'));

            for ($i = 0; $i < count($markedDeparments); $i++) {
                JobDepartment::create([
                    'job_id' => $jobId,
                    'department_id' => $markedDeparments[$i],
                    'department_status' => 0,
                    'start_date' => $markedStarDates[$i],
                    'end_date' => $markedEndDates[$i],
                ]);
            }

            return response()->json(['status' => 200, 'message' => 'Job ticket submitted successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => 'Job ticket submission failed !', 'error' => $e->getMessage()]);
        }
    }

    // return job list
    // public function list()
    // {

    //     // $jobs = Job::get();


    //     $jobs = Job::with(['client'])
    //         // ->join('job', 'job.id', '=', 'job_activity.job_id')
    //         // ->where('department_id', 0 )
    //         ->orderBy('job_status', 'DESC')
    //         ->get();

    //     $clients = Client::get();
    //     $department = Department::get();

    //     return view('job-list')->with(['jobs' => $jobs, 'clients' => $clients, 'department' => $department]);
    // }

    public function list_activity()
    {
        $user = Auth::user();
        $client = Client::get();
        $department = Department::get();

        $jobactivity = JobActivity::with(['job', 'user', 'department',])->get();
        $jobs = Job::with(['client'])
            ->orderBy(DB::raw('(CASE WHEN job_status = 2 THEN 0 WHEN job_status = 0 THEN 1 WHEN job_status IN (3, 4) THEN 2 WHEN job_status = 1 THEN 3 ELSE 4 END)'), 'asc')
            ->orderBy('job_status', 'asc')
            ->get();

        return view('job-list')->with(['jobactivity' => $jobactivity, 'jobs' => $jobs, 'client' => $client, 'department' => $department, 'user' => $user]);
    }

    public function search(Request $request)
    {

        if ($request->ajax()) {
            $output = "";
            $clients = Client::get();
            $jobs = Job::with(['client'])
                ->where('job_no', 'like', '%' . $request->search . '%')
                ->orderBy(DB::raw('(CASE WHEN job_status = 2 THEN 0 WHEN job_status = 0 THEN 1 WHEN job_status IN (3, 4) THEN 2 WHEN job_status = 1 THEN 3 ELSE 4 END)'), 'asc')
                ->orderBy('job_status', 'asc')
                ->get();

            if ($jobs) {
                foreach ($jobs as $job) {
                    if ($job->job_status ==  '2') {
                        $output .=
                            '<a href="jobview?job=' . $job->id . '">

                            <div class="" id="search-results">
                                <div class="card-body ps-4 pe-4 pb-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card border-dark mb-3 bg-gr-mint-light" style="width: 25rem; ">
                                            <div class="card-header">Job No: ' . $job->job_no . '</div>
                                            <div class="card-body text-dark">
                                                <h5 class="card-title">Customer:</h5>
                                                <p class="card-text">' . $job['client']['first_name'] . '</p>
                                                <h5 class="card-title">Delivery Date:</h5>
                                                <p class="card-text">' . $job['deliver_date'] . '</p>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">
                                                    ONGOING
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </a>
                    ';
                    } else {
                        $output .=
                            '<a href="jobview?job=' . $job->id . '">
                            <div class="" id="search-results">
                                <div class="card-body ps-4 pe-4 pb-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card border-dark mb-3 " style="width: 25rem;">
                                            <div class="card-header">Job No: ' . $job->job_no . '</div>
                                            <div class="card-body text-dark">
                                                <h5 class="card-title">Customer:</h5>
                                                <p class="card-text">' . $job['client']['first_name'] . '</p>
                                                <h5 class="card-title">Delivery Date:</h5>
                                                <p class="card-text">' . $job['deliver_date'] . '</p>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">

                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </a>
                    ';
                    }
                }
            }

            return Response($output);
        }
    }

    // return job
    public function jobview()
    {

        $jobId = request('job');
        $jobactivity = JobActivity::with(['job', 'user', 'department'])->where('job_id', $jobId)->first();

        $jobs = Job::get();
        $clients = Client::get();
        $department = Department::get();

        return view('jobview')->with(['jobs' => $jobs, 'clients' => $clients, 'jobactivity' => $jobactivity, 'department' => $department]);
    }

    public function startJob($id)
    {

        $user = Auth::user();

        $job = Job::findOrFail($id);
        $job->job_status = 2;
        $job->save();
        $department = JobDepartment::where('job_id', $id)->where('department_id', $user->department_id)->firstOrFail();
        $department->department_status = 2;
        $department->save();

        return redirect()->route('job-list');
    }

    public function completeJob($id)
    {
        $user = Auth::user();
        $job = Job::findOrFail($id);
        $job->job_status = 1;
        $job->save();
        $department = JobDepartment::where('job_id', $id)->where('department_id', $user->department_id)->firstOrFail();
        $department->department_status = 1;
        $department->save();

        return redirect()->route('job-list');
    }
}
