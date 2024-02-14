<?php

namespace App\Http\Controllers;

use App\Events\JobInserted;
use App\Events\JobStatusChanged;
use App\Events\JobUpdated;
use App\Models\Client;
use App\Models\Department;
use App\Models\Job;
use App\Models\JobActivity;
use App\Models\JobDepartment;
use App\Models\JobDetail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Spatie\Browsershot\Browsershot;


class JobController extends Controller
{
   

    // return job view
    public function index()
    {

        // removed the active filter for inactive job visibility

        // joined with styles
        $jobs = Job::leftJoin('job_detail', 'job.id', '=', 'job_detail.job_id')
            ->select('job.id', 'job.job_no', 'job.client_id', 'job.job_title', 'job.job_status', 'job.record_status', 'job.order_date', 'job.deliver_date', 'job.invoice', DB::raw('sum(job_detail.qty) as total_styles_qty'))
            ->groupBy('job.id', 'job.job_no', 'job.client_id', 'job.job_title', 'job.job_status', 'job.order_date', 'job.deliver_date', 'job.invoice')
            ->get();

        return view('job')->with(['jobs' => $jobs]);
    }

    // return job details view
    public function details()
    {

        $jobId = request('job');
        $job = Job::find($jobId);
        $user = User::get();

        $styleDetailRecords = JobDetail::where('job_id', $jobId)->where('record_status', 1)->get();
        $styleSubTotal = $styleDetailRecords->sum('qty');
        $departmentDetailRecords = JobDepartment::where('job_id', $jobId)->where('record_status', 1)->get();
        $summaryOfStyle = JobDetail::where('job_id', $jobId)->where('record_status', 1)->get()
            ->groupBy(['category', 'design', 'sleeve', 'neck_type',]);


        $summaryOfStylesum = JobDetail::select('category', 'design', 'sleeve', 'neck_type', DB::raw('SUM(qty) as qty_sum'))
            ->where('job_id', $jobId)
            ->groupBy('category', 'design', 'sleeve', 'neck_type')
            ->get();

        // dd($summaryOfStylesum);

        // Load the assigned designer relationship
        $job->load('assignedDesigner');

        return view('job-details')->with(['job' => $job, 'styleDetailRecords' => $styleDetailRecords, 'styleSubTotal' => $styleSubTotal, 'departmentDetailRecords' => $departmentDetailRecords, 'summaryOfStyle' => $summaryOfStyle, 'summaryOfStylesum' => $summaryOfStylesum]);
    }


    // generate detailed job view report
    public function generateJobDetailReport()
    {
        $jobId = request('job');
        $job = Job::find($jobId);        
        $user = User::get();

        $styleDetailRecords = JobDetail::where('job_id', $jobId)->where('record_status', 1)->get();
        $styleSubTotal = $styleDetailRecords->sum('qty');
        $departmentDetailRecords = JobDepartment::where('job_id', $jobId)->where('record_status', 1)->get();
        $summaryOfStyle = JobDetail::where('job_id', $jobId)->where('record_status', 1)->get()
            ->groupBy(['category', 'design', 'sleeve', 'neck_type',]);
        

        // $summaryOfStylesum = JobDetail::select('category', 'design', 'sleeve', 'neck_type', DB::raw('SUM(qty) as qty_sum'))
        //     ->where('job_id', $jobId)
        //     ->groupBy('category', 'design', 'sleeve', 'neck_type')
        //     ->get();

        // Load the assigned designer relationship

        //$job->load('assignedDesigner');
        
        // data to pass to the view
        //$data = ['job' => $job, 'styleDetailRecords' => $styleDetailRecords, 'styleSubTotal' => $styleSubTotal, 'departmentDetailRecords' => $departmentDetailRecords, 'summaryOfStyle' => $summaryOfStyle, 'summaryOfStylesum' => $summaryOfStylesum];

        //$html = view('job_pdf', $data)->render();
        //$imagePath = public_path('page-snapshots/'. $job->job_title . '-'. $job->job_no .'.png');

        // $pdfPath = public_path('page-pdfs/test.pdf');

        // Generate a snapshot
        //Browsershot::html($html)->fullPage()->save($imagePath);

        // Generate a pdf
        // Browsershot::html($html)->fullPage()->savePdf($pdfPath);

        // pass the pdf download back, and delete after sending the file
       // return response()->download($imagePath)->deleteFileAfterSend();
      

       return view('job_pdf')->with(['job' => $job, 'styleDetailRecords' => $styleDetailRecords, 'styleSubTotal' => $styleSubTotal, 'departmentDetailRecords' => $departmentDetailRecords, 'summaryOfStyle' => $summaryOfStyle]);
 
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

            // unique job no: server side validator
            $validator = Validator::make($request->all(), [
                'job_no' => [
                    'required',
                    Rule::unique('job')->where(function ($query) {
                        $query->where('record_status', 1);
                    }),
                ],
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            // Job insert :
            $job = Job::create([
                'job_no' => $request->input('job_no'),
                'job_title' => $request->input('job_title'),
                'client_id' => $request->input('job_client'),
                'client_reference_no' => $request->input('job_client_ref'),
                'material_option' => $request->input('job_material_option'),
                'sleeve_details' => $request->input('job_sleeve_details'),
                'sleeve_remarks' => $request->input('job_sleeve_remarks'),
                'order_date' => $request->input('job_order_date'),
                'deliver_date' => $request->input('job_deliver_date'),
                'tshirt_details' => $request->input('job_tshirt_details'),
                'short_details' => $request->input('job_short_details'),
                'special_note' => $request->input('job_special_note'),
                'logo_and_number' => $request->input('job_logo_and_number'),
                'size_label_details' => $request->input('job_size_label_details'),
                'pattern' => $request->input('job_pattern'),
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

            // Job reference document insert

            if ($request->hasFile('job_reference_document')) {

                $file = $request->file('job_reference_document');
                $extention = $file->getClientOriginalExtension();
                $filename = time() . '-1' . '.' . $extention;
                $file->move('uploads/jobs/', $filename);
                $job->job_reference_document = $filename;

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
            $remarks = explode(",", $request->input('style_remarks'));

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
                    'remarks' => $remarks[$i],
                ]);
            }

            // Job department insert : insert in department information related to the job

            $markedDepartments = explode(",", $request->input('marked_departments'));
            $markedStartDates = explode(",", $request->input('marked_start_dates'));
            $markedEndDates = explode(",", $request->input('marked_end_dates'));

            for ($i = 0; $i < count($markedDepartments); $i++) {

                $latestJobDepartmentRecord = JobDepartment::where('department_id', $markedDepartments[$i])->where('start_date', $markedStartDates[$i])->orderBy('token', 'desc')->first();
                $token = 10;

                if ($latestJobDepartmentRecord != null) {
                    $token = (floor($latestJobDepartmentRecord->token / 10) * 10) + 10;
                }

                JobDepartment::create([
                    'job_id' => $jobId,
                    'department_id' => $markedDepartments[$i],
                    'department_status' => 0,
                    'token' => $token,
                    'start_date' => $markedStartDates[$i],
                    'end_date' => $markedEndDates[$i],
                ]);
            }

            // broadcasted on the job-broadcast channel
            event(new JobInserted);

            return response()->json(['status' => 200, 'message' => 'Job ticket submitted successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => 'Job ticket submission failed !', 'error' => $e->getMessage()]);
        }
    }


    // returns the update page
    public function edit()
    {
        $jobId = request('job');
        $job = Job::find($jobId);

        $clients = Client::get();
        $styleDetailRecords = JobDetail::where('job_id', $jobId)->where('record_status', 1)->get();
        $departmentDetailRecords = JobDepartment::where('job_id', $jobId)->where('record_status', 1)->get();

        return view('job-edit')->with(['job' => $job, 'clients' => $clients, 'styleDetailRecords' => $styleDetailRecords, 'departmentDetailRecords' => $departmentDetailRecords]);
    }

    // update the job
    public function update(Request $request)
    {

        // Set up the core information update first, test it out and move onto the next parts

        try {

            $jobId = $request->input('job_id');

            // find the record
            $job = Job::find($jobId);


            // unique job no: server side validator (added ignore for the current record)
            $validator = Validator::make($request->all(), [
                'job_no' => [
                    'required',
                    Rule::unique('job')->where(function ($query) {
                        $query->where('record_status', 1);
                    })->ignore($jobId),
                ],
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }


            // update model information
            $job->job_title = $request->input('job_title');
            $job->job_no = $request->input('job_no');
            $job->client_id = $request->input('job_client');
            $job->client_reference_no = $request->input('job_client_ref');
            $job->material_option = $request->input('job_material_option');
            $job->sleeve_details = $request->input('job_sleeve_details');
            $job->sleeve_remarks = $request->input('job_sleeve_remarks');
            $job->order_date = $request->input('job_order_date');
            $job->deliver_date = $request->input('job_deliver_date');
            $job->tshirt_details = $request->input('job_tshirt_details');
            $job->short_details = $request->input('job_short_details');
            $job->special_note = $request->input('job_special_note');
            $job->logo_and_number = $request->input('job_logo_and_number');
            $job->size_label_details = $request->input('job_size_label_details');
            $job->pattern = $request->input('job_pattern');
            $job->packing = $request->input('job_packing');
            $job->comment = $request->input('job_comment');

            // save model details to database
            $job->save();

            // job styles update
            // -----------------

            if ($request->input('job_style_update_check') != 0) {

                // store old styles
                $initialPreviousStyleIds = explode(",", $request->input('initial_previous_style_ids'));
                $previousStyleIds = explode(",", $request->input('previous_style_ids'));

                $previousCategories = explode(",", $request->input('previous_style_categories'));
                $previousDesigns = explode(",", $request->input('previous_style_designs'));
                $previousSleeves = explode(",", $request->input('previous_style_sleeves'));
                $previousSizes = explode(",", $request->input('previous_style_sizes'));
                $previousNecks = explode(",", $request->input('previous_style_necks'));
                $previousQtys = explode(",", $request->input('previous_style_qtys'));
                $previousRemarks = explode(",", $request->input('previous_style_remarks'));

                // store new styles
                $categories = explode(",", $request->input('style_categories'));
                $designs = explode(",", $request->input('style_designs'));
                $sleeves = explode(",", $request->input('style_sleeves'));
                $sizes = explode(",", $request->input('style_sizes'));
                $necks = explode(",", $request->input('style_necks'));
                $qtys = explode(",", $request->input('style_qtys'));
                $remarks = explode(",", $request->input('style_remarks'));

                // index to keep track of the style detail increments
                $styleDetailIndex = 0;

                // looping through old styles with their ids and updating them

                if ($initialPreviousStyleIds[0] != "") {
                    for ($i = 0; $i < count($initialPreviousStyleIds); $i++) {

                        $style = JobDetail::find($initialPreviousStyleIds[$i]);

                        if (in_array($initialPreviousStyleIds[$i], $previousStyleIds)) {

                            $style->category = $previousCategories[$styleDetailIndex];
                            $style->design = $previousDesigns[$styleDetailIndex];
                            $style->sleeve = $previousSleeves[$styleDetailIndex];
                            $style->neck_type = $previousNecks[$styleDetailIndex];
                            $style->size = $previousSizes[$styleDetailIndex];
                            $style->qty = $previousQtys[$styleDetailIndex];
                            $style->remarks = $previousRemarks[$styleDetailIndex];

                            $style->save();

                            $styleDetailIndex++;
                        } else {
                            $style->record_status = 0;
                            $style->save();
                        }
                    }
                }

                // if there are new styles :
                if ($designs[0] != "") {
                    // looping through new styles and inserting them
                    for ($i = 0; $i < count($designs); $i++) {
                        JobDetail::create([
                            'job_id' => $jobId,
                            'category' => $categories[$i],
                            'design' => $designs[$i],
                            'sleeve' => $sleeves[$i],
                            'neck_type' => $necks[$i],
                            'size' => $sizes[$i],
                            'qty' => $qtys[$i],
                            'remarks' => $remarks[$i],
                        ]);
                    }
                }
            }


            // job design update
            // -----------------

            if ($request->input('job_design_update_check') != 0) {

                // Job design image update : image 1

                if ($request->hasFile('job_design_image_1')) {

                    $file = $request->file('job_design_image_1');
                    $extention = $file->getClientOriginalExtension();
                    $filename = time() . '-1' . '.' . $extention;
                    $file->move('uploads/jobs/', $filename);
                    $job->job_design_image_1 = $filename;

                    $job->save();
                }


                // Job design image update : image 2

                if ($request->hasFile('job_design_image_2')) {

                    $file = $request->file('job_design_image_2');
                    $extention = $file->getClientOriginalExtension();
                    $filename = time() . '-2' . '.' . $extention;
                    $file->move('uploads/jobs/', $filename);
                    $job->job_design_image_2 = $filename;

                    $job->save();
                }
            }

            // job document update
            // -------------------

            if ($request->input('job_document_update_check') != 0) {

                if ($request->hasFile('job_reference_document')) {

                    $file = $request->file('job_reference_document');
                    $extention = $file->getClientOriginalExtension();
                    $filename = time() . '-1' . '.' . $extention;
                    $file->move('uploads/jobs/', $filename);
                    $job->job_reference_document = $filename;

                    $job->save();
                }
            }

            // job department update
            // ---------------------

            if ($request->input('job_department_update_check') != 0) {

                // store old departments
                $initialPreviousMarkedDepartmentRecordIds = explode(",", $request->input('initial_previous_marked_department_ids'));
                $previousMarkedDepartmentRecordIds = explode(",", $request->input('previous_marked_department_ids'));

                $previousMarkedDepartments = explode(",", $request->input('previous_marked_departments'));
                $previousMarkedStartDates = explode(",", $request->input('previous_marked_start_dates'));
                $previousMarkedEndDates = explode(",", $request->input('previous_marked_end_dates'));

                // store departments
                $markedDepartments = explode(",", $request->input('marked_departments'));
                $markedStartDates = explode(",", $request->input('marked_start_dates'));
                $markedEndDates = explode(",", $request->input('marked_end_dates'));

                // index to keep track of the date increments
                $dateIndex = 0;

                if ($initialPreviousMarkedDepartmentRecordIds[0] != "") {
                    for ($i = 0; $i < count($initialPreviousMarkedDepartmentRecordIds); $i++) {

                        $department = JobDepartment::find($initialPreviousMarkedDepartmentRecordIds[$i]);

                        if (in_array($initialPreviousMarkedDepartmentRecordIds[$i], $previousMarkedDepartmentRecordIds)) {

                            $latestJobDepartmentRecord = JobDepartment::where('department_id', $department->department_id)->where('start_date', $previousMarkedStartDates[$dateIndex])->orderBy('token', 'desc')->first();
                            $token = 10;

                            if ($latestJobDepartmentRecord != null) {
                                $token = (floor($latestJobDepartmentRecord->token / 10) * 10) + 10;

                                // if the updating date is the same as the one in the record, it means it haven't really changed
                                // So don't update the token when that happens

                                if ($department->start_date->toDateString() == $previousMarkedStartDates[$dateIndex]) {
                                    $token = $department->token;
                                }
                            }

                            $department->token = $token;
                            $department->start_date = $previousMarkedStartDates[$dateIndex];
                            $department->end_date = $previousMarkedEndDates[$dateIndex];

                            $department->save();

                            $dateIndex++;
                        } else {
                            $department->record_status = 0;
                            $department->save();
                        }
                    }
                }

                // if there are new departments :
                if ($markedDepartments[0] != "") {
                    // looping through new departments and inserting them

                    for ($i = 0; $i < count($markedDepartments); $i++) {

                        $latestJobDepartmentRecord = JobDepartment::where('department_id', $markedDepartments[$i])->where('start_date', $markedStartDates[$i])->orderBy('token', 'desc')->first();
                        $token = 10;

                        if ($latestJobDepartmentRecord != null) {
                            $token = (floor($latestJobDepartmentRecord->token / 10) * 10) + 10;
                        }

                        JobDepartment::create([
                            'job_id' => $jobId,
                            'department_id' => $markedDepartments[$i],
                            'token' => $token,
                            'start_date' => $markedStartDates[$i],
                            'end_date' => $markedEndDates[$i]
                        ]);
                    }
                }
            }

            // broadcasted on the job-broadcast channel
            event(new JobUpdated);

            return response()->json(['status' => 200, 'message' => 'Job ticket updated successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => 'Job ticket update failed !', 'error' => $e->getMessage()]);
        }
    }

    // display job department token page

    public function job_department_token()
    {
        $departments = Department::get();

        return view('job-department-token')->with(['departments' => $departments]);
    }


    public function job_department_records()
    {
        $selectedDepartmentId = request('departmentId');

        $departmentDetailRecords = JobDepartment::where('department_id', $selectedDepartmentId)->where('record_status', 1)->orderBy('start_date')->orderBy('token')->get();
        $departments = Department::get();

        return view('job-department-records')->with(['departmentDetailRecords' => $departmentDetailRecords, 'departments' => $departments]);
    }


    public function edit_token($id)
    {
        $departmentDetailRecord = JobDepartment::find($id);

        return response()->json(['status' => 200, 'departmentDetailRecord' => $departmentDetailRecord]);
    }

    public function update_token(Request $request)
    {
        $departmentDetailRecord = JobDepartment::find($request->input('job_department_record_id'));

        // validations
        $request->validate([
            'new_token' => [
                Rule::unique('job_department', 'token')->where(function ($query) use ($departmentDetailRecord) {
                    $query->where('start_date', '=', $departmentDetailRecord->start_date)
                        ->where('department_id', '=', $departmentDetailRecord->department_id);
                })
            ]
        ]);

        $departmentDetailRecord->token = $request->input('new_token');
        $departmentDetailRecord->save();

        // broadcasted on the job-broadcast channel
        event(new JobUpdated);

        return back()->with('success', 'Token updated successfully !');
    }

    public function check_invoice(Request $request)
    {
        try {

            $job = Job::find($request->input('job_id'));
            $job->invoice = 1;
            $job->save();

            return response()->json(['status' => 200, 'message' => 'Job invoice checked successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => 'Job invoice check failed !', 'error' => $e->getMessage()]);
        }
    }

    public function deactivate_job(Request $request)
    {
        try {

            $job_id = $request->input('job_id');

            DB::beginTransaction();

            // deactivate the job, styles, and department records

            Job::find($job_id)->update(['record_status' => 0]);
            JobDetail::where('job_id', $job_id)->update(['record_status' => 0]);
            JobDepartment::where('job_id', $job_id)->update(['record_status' => 0]);

            DB::commit();

            return response()->json(['status' => 200, 'message' => 'Job deactivated successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => 'Job deactivation failed !', 'error' => $e->getMessage()]);
        }
    }


    public function list_activity()

    {
        $client = Client::get();
        $department = Department::get();
        $user = Auth::user();
        $department_id = $user->department_id;


        $jobs = Job::select('job.*', 'job_department.department_status')
            ->join('job_department', 'job_department.job_id', '=', 'job.id')
            ->where('job.record_status', '<>', 0)
            ->where('job_department.department_id', '=', $department_id)
            ->orderBy(DB::raw('(CASE WHEN job_department.department_status = 2 THEN 0 WHEN job_department.department_status = 0 THEN 1 WHEN job_department.department_status IN (3, 4) THEN 2 WHEN job_department.department_status = 1 THEN 3 ELSE 4 END)'), 'asc')
            ->orderBy('job_department.department_status', 'asc')
            ->get();

        // $jobactivity = JobActivity::with(['job', 'user', 'department'])
        //     ->get();


        return view('job-list')
            ->with([
                // 'jobactivity' => $jobactivity,
                'jobs' => $jobs,
                'client' => $client,
                'department' => $department
            ]);
    }

    public function search(Request $request)
    {

        // if ($request->ajax()) {
        //     $output = "";
        //     $clients = Client::get();
        //     $user = Auth::user();
        //     $department_id = $user->department_id;
        //     $jobs = Job::select('job.*', 'job_department.department_status')
        //         ->join('job_department', 'job_department.job_id', '=', 'job.id')
        //         ->where('job_department.department_id', '=', $department_id)
        //         ->where('job_no', 'like', '%' . $request->search . '%')
        //         ->orderBy(DB::raw('(CASE WHEN job_department.department_status = 2 THEN 0 WHEN job_department.department_status = 0 THEN 1 WHEN job_department.department_status IN (3, 4) THEN 2 WHEN job_department.department_status = 1 THEN 3 ELSE 4 END)'), 'asc')
        //         ->orderBy('job_department.department_status', 'asc')
        //         ->get();

        if ($request->ajax()) {
            $output = "";
            $clients = Client::get();
            $user = Auth::user();
            $department_id = $user->department_id;
            $searchTerm = $request->search; // Store the search term in a variable
            $jobs = Job::select('job.*', 'job_department.department_status')
                ->join('job_department', 'job_department.job_id', '=', 'job.id')
                ->leftJoin('client', 'job.client_id', '=', 'client.id') // Left join with client table
                ->where('job.record_status', '<>', 0)
                ->where('job_department.department_id', '=', $department_id)
                ->where(function ($query) use ($searchTerm) {
                    $query->where('job_no', 'like', '%' . $searchTerm . '%')
                        ->orWhere('client.first_name', 'like', '%' . $searchTerm . '%') // Search in client first name
                        ->orWhere('client.last_name', 'like', '%' . $searchTerm . '%')  // Search in client last name
                        ->orWhere(DB::raw("CONCAT(client.first_name, ' ', client.last_name)"), 'like', '%' . $searchTerm . '%'); // Search in combined full name
                })
                ->orderBy(DB::raw('(CASE WHEN job_department.department_status = 2 THEN 0 WHEN job_department.department_status = 0 THEN 1 WHEN job_department.department_status IN (3, 4) THEN 2 WHEN job_department.department_status = 1 THEN 3 ELSE 4 END)'), 'asc')
                ->orderBy('job_department.department_status', 'asc')
                ->get();

            if ($jobs) {
                foreach ($jobs as $job) {
                    if ($job->department_status ==  '0') {
                        $output .=
                            '<a href="jobview?job=' . $job->id . '" style="text-decoration:none">
                            <div class="" id="search-results">
                                <div class="card-body ps-4 pe-4 pb-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card mb-3 " style="width: 25rem;">
                                            <div class="card-header">Job No: ' . $job->job_no . '</div>
                                            <div class="card-body text-dark">
                                                <h5 class="card-title">Customer:</h5>
                                                <p class="card-text">' . $job['client']['first_name'] . '</p>
                                                <h5 class="card-title">Delivery Date:</h5>
                                                <p class="card-text">' . $job['deliver_date'] . '</p>
                                            </div>

                                            <div class="card-header">
                                                <div class="d-flex justify-content-between align-items-center">

                                                        <span class="badge badge-info">PENDING</span>

                                                    <button type="button" class="btn btn-primary bg-gr-blue border-0" onclick="window.location=\'' . route('jobview', ['job' => $job]) . '\'"> View Job
                                                    </button>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                        </div>
                        </a>
                    ';
                    } elseif ($job->department_status ==  '1') {
                        $output .=
                            '<a href="jobview?job=' . $job->id . '" style="text-decoration:none">
                            <div class="" id="search-results">
                                <div class="card-body ps-4 pe-4 pb-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="card mb-3 bg-gr-mint-light" style="width: 25rem;">
                                            <div class="card-header">Job No: ' . $job->job_no . '</div>
                                            <div class="card-body text-dark">
                                                <h5 class="card-title">Customer:</h5>
                                                <p class="card-text">' . $job['client']['first_name'] . '</p>
                                                <h5 class="card-title">Delivery Date:</h5>
                                                <p class="card-text">' . $job['deliver_date'] . '</p>
                                            </div>

                                            <div class="card-header">
                                                <div class="d-flex justify-content-between align-items-center">

                                                        <span class="badge badge-success">COMPLETE</span>

                                                    <button type="button" class="btn btn-primary bg-gr-blue border-0" onclick="window.location=\'' . route('jobview', ['job' => $job]) . '\'"> View Job
                                                    </button>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                        </div>
                        </a>
                    ';
                    } elseif ($job->department_status ==  '2') {
                        $output .=
                            '<a href="jobview?job=' . $job->id . '" style="text-decoration:none">
                        <div class="" id="search-results">
                            <div class="card-body ps-4 pe-4 pb-4">
                                <div class="d-flex justify-content-center">
                                    <div class="card mb-3 " style="width: 25rem;">
                                        <div class="card-header">Job No: ' . $job->job_no . '</div>
                                        <div class="card-body text-dark">
                                            <h5 class="card-title">Customer:</h5>
                                            <p class="card-text">' . $job['client']['first_name'] . '</p>
                                            <h5 class="card-title">Delivery Date:</h5>
                                            <p class="card-text">' . $job['deliver_date'] . '</p>
                                        </div>

                                        <div class="card-header">
                                            <div class="d-flex justify-content-between align-items-center">

                                                    <span class="badge badge-warning">ONGOING</span>

                                                <button type="button" class="btn btn-primary bg-gr-blue border-0" onclick="window.location=\'' . route('jobview', ['job' => $job]) . '\'"> View Job
                                                </button>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    </div>
                    </a>
                ';
                    } elseif ($job->department_status ==  '3') {
                        $output .=
                            '<a href="jobview?job=' . $job->id . '" style="text-decoration:none">
                        <div class="" id="search-results">
                            <div class="card-body ps-4 pe-4 pb-4">
                                <div class="d-flex justify-content-center">
                                    <div class="card mb-3 " style="width: 25rem;">
                                        <div class="card-header">Job No: ' . $job->job_no . '</div>
                                        <div class="card-body text-dark">
                                            <h5 class="card-title">Customer:</h5>
                                            <p class="card-text">' . $job['client']['first_name'] . '</p>
                                            <h5 class="card-title">Delivery Date:</h5>
                                            <p class="card-text">' . $job['deliver_date'] . '</p>
                                        </div>

                                        <div class="card-header">
                                            <div class="d-flex justify-content-between align-items-center">

                                                    <span class="badge badge-secondary">HOLD</span>

                                                <button type="button" class="btn btn-primary bg-gr-blue border-0" onclick="window.location=\'' . route('jobview', ['job' => $job]) . '\'"> View Job
                                                </button>

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
                            '<a href="jobview?job=' . $job->id . '" style="text-decoration:none">
                        <div class="" id="search-results">
                            <div class="card-body ps-4 pe-4 pb-4">
                                <div class="d-flex justify-content-center">
                                    <div class="card mb-3 " style="width: 25rem;">
                                        <div class="card-header">Job No: ' . $job->job_no . '</div>
                                        <div class="card-body text-dark">
                                            <h5 class="card-title">Customer:</h5>
                                            <p class="card-text">' . $job['client']['first_name'] . '</p>
                                            <h5 class="card-title">Delivery Date:</h5>
                                            <p class="card-text">' . $job['deliver_date'] . '</p>
                                        </div>

                                        <div class="card-header">
                                            <div class="d-flex justify-content-between align-items-center">

                                                    <span class="badge badge-secondary">NOT READY</span>

                                                <button type="button" class="btn btn-primary bg-gr-blue border-0" onclick="window.location=\'' . route('jobview', ['job' => $job]) . '\'"> View Job
                                                </button>

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
        $user = Auth::user();
        $department_id = $user->department_id;

        // $jobs = Job::select('job.*', 'job_department.department_status')
        // ->join('job_department', 'job_department.job_id', '=', 'job.id')
        // ->where('job_department.department_id', '=', $department_id)
        // ->where('job_id', $jobId)->first();

        //     $jobs = Job::select('job.*', 'job_department.department_status', 'users.*')
        // ->join('job_department', 'job_department.job_id', '=', 'job.id')
        // ->join('users', 'users.department_id', '=', 'job_department.department_id')
        // ->where('job_department.department_id', $department_id)
        // ->where('job.id', $jobId)
        // ->first();

        $jobs = Job::select('job.id as job_id', 'job.*', 'job_department.department_status', 'job_department.id as jobDep_id', 'users.*', 'department.*')
            ->join('job_department', 'job_department.job_id', '=', 'job.id')
            ->join('users', 'users.department_id', '=', 'job_department.department_id')
            ->join('department', 'department.id', '=', 'users.department_id')
            ->where('job_department.department_id', $department_id)
            ->where('job.id', $jobId)
            ->first();

        $clients = Client::get();
        $department = Department::get();
        // $job_department = JobDepartment::get();

        return view('jobview')->with([
            'jobs' => $jobs, 'clients' => $clients,
            'jobactivity' => $jobactivity,
            'department' => $department,
            'user' => $user
        ]);
    }

    public function startJob($jobDepId)
    {

        $department = JobDepartment::where('id', $jobDepId)->firstOrFail();
        $department->department_status = 2;

        // Set the actual_start_date to the current date and time
        $indianTimezone = 'Asia/Kolkata';
        $nowInIST = now()->setTimezone($indianTimezone);

        // Set the actual_start_date to the current Indian time
        $department->actual_start_date = $nowInIST;

        $department->save();

        // broadcasted on the job-broadcast channel
        event(new JobStatusChanged);

        return redirect()->route('job-list');
    }

    public function completeJob($jobDepId)
    {

        // $job = Job::findOrFail($id);
        // $job->job_status = 1;
        // $job->save();
        $department = JobDepartment::where('id', $jobDepId)->firstOrFail();
        $department->department_status = 1;

        $indianTimezone = 'Asia/Kolkata';
        $nowInIST = now()->setTimezone($indianTimezone);

        // Set the actual_end_date to the current Indian time
        $department->actual_end_date = $nowInIST;

        $department->save();

        // broadcasted on the job-broadcast channel
        event(new JobStatusChanged);

        return redirect()->route('job-list');
    }

    public function completeFinalJob($jobDepId, $jobId)
    {

        $job = Job::findOrFail($jobId);
        $job->job_status = 1;
        $job->save();

        $department = JobDepartment::where('id', $jobDepId)->firstOrFail();
        $department->department_status = 1;

        $indianTimezone = 'Asia/Kolkata';
        $nowInIST = now()->setTimezone($indianTimezone);

        // Set the actual_end_date to the current Indian time
        $department->actual_end_date = $nowInIST;

        $department->save();

        // broadcasted on the job-broadcast channel
        event(new JobStatusChanged);

        return redirect()->route('job-list');
    }

    public function beginJob($jobDepId, $jobId)
    {
        $job = Job::findOrFail($jobId);
        $job->job_status = 2;
        $job->save();

        $department = JobDepartment::where('id', $jobDepId)->firstOrFail();
        $department->department_status = 2;

        $indianTimezone = 'Asia/Kolkata';
        $nowInIST = now()->setTimezone($indianTimezone);

        // Set the actual_start_date to the current Indian time
        $department->actual_start_date = $nowInIST;

        // Get the currently logged-in user
        $user = Auth::user();

        // Assign the user's ID to the assigned_designer column
        $job->assigned_designer = $user->id;

        $department->save();
        $job->save();

        // broadcasted on the job-broadcast channel
        event(new JobStatusChanged);

        return redirect()->route('job-list');
    }
}
