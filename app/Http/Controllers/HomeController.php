<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobDepartment;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();


        if ($user->role_id == 1 || $user->role_id == 2) {
            // To ongoin oders

            $ongoing = JobDepartment::where('department_status', '2')->count();

            // To completed oders

            $complete = JobDepartment::where('department_status', '1')->count();

            //to Waiting Orders
            $waiting = JobDepartment::where('department_status', '3')->count();

            //to Pending Orders
            $pending = JobDepartment::where('department_status', '0')->count();

            //tody ongoing jobs
            $designCount = Job::join('job_department', 'job_department.job_id', '=', 'job.id')
                ->where('job_department.department_id', '=', '1')
                ->where('job_department.department_status', '=', '2')
                ->count();
            // return

            $printingCount = Job::join('job_department', 'job_department.job_id', '=', 'job.id')
                ->where('job_department.department_id', '=', '2')
                ->where('job_department.department_status', '=', '2')
                ->count();

            $pressingCount = Job::join('job_department', 'job_department.job_id', '=', 'job.id')
                ->where('job_department.department_id', '=', '3')
                ->where('job_department.department_status', '=', '2')
                ->count();

            $cuttingCount = Job::join('job_department', 'job_department.job_id', '=', 'job.id')
                ->where('job_department.department_id', '=', '4')
                ->where('job_department.department_status', '=', '2')
                ->count();

            $sewingCount = Job::join('job_department', 'job_department.job_id', '=', 'job.id')
                ->where('job_department.department_id', '=', '5')
                ->where('job_department.department_status', '=', '2')
                ->count();



            $designPercentage = 'width: ' . $designCount . '%;';

            $printingPercentage = 'width: ' . $printingCount . '%;';

            $cuttingPercentage = 'width: ' . $cuttingCount . '%;';

            $pressingPercentage = 'width: ' . $pressingCount . '%;';

            $sewingPercentage = 'width: ' . $sewingCount . '%;';


            return view('home')->with([
                'complete' => $complete,
                'waiting' => $waiting,
                'pending' => $pending,
                'ongoing' => $ongoing,
                'designCount' => $designCount,
                'printingCount' => $printingCount,
                'pressingCount' => $pressingCount,
                'cuttingCount' => $cuttingCount,
                'sewingCount' => $sewingCount,
                'designPercentage' => $designPercentage,
                'printingPercentage' => $printingPercentage,
                'cuttingPercentage' => $cuttingPercentage,
                'pressingPercentage' => $pressingPercentage,
                'sewingPercentage' => $sewingPercentage
            ]);
        } else {
            return app(JobController::class)->list_activity();
        }
    }
}
