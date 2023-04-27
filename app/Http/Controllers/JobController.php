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
}
