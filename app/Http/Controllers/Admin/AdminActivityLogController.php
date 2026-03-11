<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class AdminActivityLogController extends Controller
{
    protected $activityLog;

    public function __construct()
    {
        $this->activityLog = new ActivityLog();
    }


    public function index(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');

        if ($from && $to) {
            $logs = $this->activityLog->filterByDate($from, $to);
        } else {
            $logs = $this->activityLog->getAllPaginated(20);
        }

        return view('admin.logs.index', compact('logs', 'from', 'to'));
    }



}
