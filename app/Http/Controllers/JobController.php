<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Job;
use App\Models\JobDepartment;
use App\Models\JobDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JobController extends Controller
{
    // return job view
    public function index()
    {
        $jobs = Job::get();

        return view('job')->with(['jobs' => $jobs]);
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
                'order_date' => $request->input('job_order_date'),
                'deliver_date' => $request->input('job_deliver_date'),
                'job_status' => 0,
            ]);

            // Job design image insert : inserts the customer document image data

            if ($request->hasFile('job_customer_doc')) {

                $file = $request->file('job_customer_doc');
                $extention = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extention;
                $file->move('uploads/jobs/', $filename);
                $job->job_design_image = $filename;

                $job->save();
            }

            // Job detail insert : insert styles information related to the job
            $jobId = $job->id;

            $designs = explode(",", $request->input('style_designs'));
            $types = explode(",", $request->input('style_types'));
            $sizes = explode(",", $request->input('style_sizes'));
            $qtys = explode(",", $request->input('style_qtys'));

            for ($i = 0; $i < count($designs); $i++) {
                JobDetail::create([
                    'job_id' => $jobId,
                    'design' => $designs[$i],
                    'type' => $types[$i],
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
}
