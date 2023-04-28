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

class JobController extends Controller
{
    // return job view
    public function index()
    {
        $jobs = Job::get();

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
        $client = Client::get();
        $department = Department::get();

        $jobactivity = JobActivity::with(['job', 'user', 'department',])->get();
        $jobs = Job::with(['client'])
            ->orderBy('job_status', 'DESC')
            ->get();

        return view('job-list')->with(['jobactivity' => $jobactivity, 'jobs' => $jobs, 'client' => $client, 'department' => $department]);
    }

    public function search(Request $request)
    {

        if ($request->ajax()) {
            $output = "";
            $clients = Client::get();
            $jobs = Job::with(['client'])
                ->where('job_no', 'like', '%' . $request->search . '%')
                ->orderBy('job_status', 'DESC')
                ->get();

            if ($jobs) {
                foreach ($jobs as $job) {
                    if ($job->job_status ==  '1') {
                        $output .=
                            '<a href="./jobview/' . $job->id . '">

                            <div class="" id="search-results">
                                <div class="card-body ps-4 pe-4 pb-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card border-dark mb-3 " style="width: 25rem; background: rgba(0, 128, 0, 0.1);">
                                            <div class="card-header">Job No:' . $job->job_no . '</div>
                                            <div class="card-body text-dark">
                                                <h5 class="card-title">Customer:</h5>
                                                <p class="card-text">' . $job['client']['first_name'] . '</p>
                                                <h5 class="card-title">Delivery Date:</h5>
                                                <p class="card-text">' . $job['deliver_date'] . '</p>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">
                                                     Active
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
                            '<a href="./jobview/' . $job->id . '">
                            <div class="" id="search-results">
                                <div class="card-body ps-4 pe-4 pb-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card border-dark mb-3 " style="width: 25rem;">
                                            <div class="card-header">Job No:' . $job->job_no . '</div>
                                            <div class="card-body text-dark">
                                                <h5 class="card-title">Customer:</h5>
                                                <p class="card-text">' . $job['client']['first_name'] . '</p>
                                                <h5 class="card-title">Delivery Date:</h5>
                                                <p class="card-text">' . $job['deliver_date'] . '</p>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">
                                                    Pending
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
    public function jobview($id)
    {
        $jobactivity = JobActivity::with(['job', 'user', 'department'])->find($id);
        $jobs = Job::get();
        $clients = Client::get();
        $department = Department::get();

        return view('jobview')->with(['jobs' => $jobs, 'clients' => $clients, 'jobactivity' => $jobactivity, 'department' => $department]);
    }

    // public function jobview($id)
    // {
    //     $jobactivity = JobActivity::with(['job','user','department',])->get();
    //     $job = Job::find($id);
    //     $clients = Client::get();
    //     $department = Department::get();


    //     return view('jobview')->with(['jobs' => $job, 'clients' => $clients, 'jobactivity' => $jobactivity, 'department' => $department]);
    // }


}
